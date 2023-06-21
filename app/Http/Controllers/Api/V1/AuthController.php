<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function index()
    {
        return UserResource::collection(User::paginate(12));
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

        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    public function delete(User $user)
    {
        try {
            $user->delete();

            return $this->sendResponse([], 'Usuario eliminado.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }
}
