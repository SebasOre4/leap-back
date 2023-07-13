<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fullname = $request->get('fullname');
        $nickname = $request->get('nickname');
        $state = $request->get('state');
        $genre = $request->get('genre');
        $nhc = $request->get('nhc');

        return PatientResource::collection(
            Patient::where('user_id', Auth::user()->id)->
            fullname($fullname)->
            nickname($nickname)->
            state($state)->
            genre($genre)->
            nhc($nhc)->
            orderBy('created_at', 'desc')->paginate(12)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create(array_merge($request->validated(), [
            'user_id' => Auth::user()->id
        ]));

        return $this->sendResponse(new PatientResource($patient), 'Paciente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        try {
            return $this->sendResponse(PatientResource::make($patient), 'Paciente encontrado.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return $this->sendResponse(new PatientResource($patient), 'Datos del paciente actualizados.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return $this->sendResponse([], 'Paciente borrado exitosamente.');
    }
}
