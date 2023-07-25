<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function index()
    {
        return UserResource::collection(User::where('id', '!=', Auth::user()->id)->paginate(12));
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['superadmin'] =  $user->superadmin;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'No estás autorizado a ingresar']);
        }
    }

    public function me()
    {
        try {
            $user = Auth::user();
            return $this->sendResponse(UserResource::make($user), 'Tus datos.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function docDashInfo()
    {
        // try {
        $pacientesInternados = Patient::where('state', 'Internado')->where('user_id', Auth::user()->id)->count();
        $pacientesEnAlta = Patient::where('state', 'Dado de alta')->where('user_id', Auth::user()->id)->count();
        $pacientesEnTratamientoCJ = Patient::where('state', 'En tratamiento CJ')->where('user_id', Auth::user()->id)->count();
        $pacientesEnTratamientoSJ = Patient::where('state', 'En tratamiento SJ')->where('user_id', Auth::user()->id)->count();
        $treatmentsInYear = Treatment::select(
            DB::raw("(COUNT(id)) as count"),
            DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as month_year")
        )->where('current', false)->whereNotNull('final_diagnoses_id')->whereBetween('created_at', [now()->subYear(), now()])->orderBy('month_year', 'ASC')
            ->groupBy("month_year")
            ->get();
        $malesInYear = Patient::select(
            DB::raw("(COUNT(id)) as count"),
            DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as month_year")
        )->where('genre', 'M')->whereBetween('created_at', [now()->subYear(), now()])->orderBy('month_year', 'ASC')
            ->groupBy("month_year")
            ->get();
        $femalesInYear = Patient::select(
            DB::raw("(COUNT(id)) as count"),
            DB::raw("(DATE_FORMAT(created_at, '%Y-%m')) as month_year")
        )->where('genre', 'F')->whereBetween('created_at', [now()->subYear(), now()])->orderBy('month_year', 'ASC')
            ->groupBy("month_year")
            ->get();

        $initialDiagnosesInYear = Diagnosis::select(
            'diagnoses.result',
            DB::raw("(COUNT(diagnoses.id)) as count"),
            DB::raw("(DATE_FORMAT(diagnoses.created_at, '%Y-%m')) as month_year")
        )->join('treatments', 'treatments.initial_diagnoses_id', '=', 'diagnoses.id')->orderBy('month_year', 'ASC')
            ->groupBy(["diagnoses.result", "month_year"])
            ->get();

        $finalDiagnosesInYear = Diagnosis::select(
            'diagnoses.result',
            DB::raw("(COUNT(diagnoses.id)) as count"),
            DB::raw("(DATE_FORMAT(diagnoses.created_at, '%Y-%m')) as month_year")
        )->join('treatments', 'treatments.final_diagnoses_id', '=', 'diagnoses.id')->orderBy('month_year', 'ASC')
            ->groupBy(["diagnoses.result", "month_year"])
            ->get();

        return $this->sendResponse([
            'patients' => [
                'interned' => $pacientesInternados,
                'discharged' => $pacientesEnAlta,
                'inTreatCJ' => $pacientesEnTratamientoCJ,
                'inTreatSJ' => $pacientesEnTratamientoSJ,
            ],
            'treatmentsInYear' => $treatmentsInYear,
            'patientsInYear' => [
                'males' => $malesInYear,
                'females' => $femalesInYear
            ],
            'diagnosesInYear' => [
                'initial' => $initialDiagnosesInYear,
                'final' => $finalDiagnosesInYear,
            ]
        ], 'Tus datos.');
        // } catch (\Throwable $th) {
        //     return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        // }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return $this->sendResponse([], 'Sesión cerrada exitosamente.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $user = User::create(array_merge($request->validated(), [
                'password' => Hash::make($request->password),
                'email_verified_at' => now()
            ]));

            return $this->sendResponse(UserResource::make($user), 'Nuevo usuario registrado.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            if ($user->id === Auth::user()->id) {
                $user->update(array_merge($request->validated(), [
                    'updated_at' => now()
                ]));
                return $this->sendResponse(UserResource::make($user), 'Perfil actualizado.');
            } else {
                return $this->sendError('Ups :/', ['error' => 'No tienes permiso para editar este usuario'], 403);
            }
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function updatePassword(UpdateUserRequest $request, User $user)
    {
        try {
            if ($user->id === Auth::user()->id) {
                if ($request->password) {
                    $user->update([
                        'password' => Hash::make($request->password),
                        'updated_at' => now()
                    ]);
                    return $this->sendResponse(UserResource::make($user), 'Contraseña Actualizada.');
                } else {
                    return $this->sendResponse([], 'Contraseña Invalida.');
                }
            } else {
                return $this->sendError('Ups :/', ['error' => 'No tienes permiso para editar este usuario'], 403);
            }
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function delete(User $user)
    {
        try {
            if (Auth::user()->superadmin) {
                $user->delete();

                return $this->sendResponse([], 'Usuario eliminado.');
            } else {
                return $this->sendError('Ups :/', ['error' => 'No tienes permisos'], 403);
            }
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }
}
