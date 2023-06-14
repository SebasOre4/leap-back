<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PatientResource::collection(Patient::where('user_id', Auth::user()->id)->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->validated());

        return PatientResource::make($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return PatientResource::make($patient);
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
