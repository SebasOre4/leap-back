<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use App\Http\Resources\TreatmentResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;

class TreatmentController extends BaseController
{
    public function currentTreatment(Patient $patient)
    {
        try {
            $currentTreatment = Treatment::where('patient_id', $patient->id)->where('current', true)->firstOrFail();
            return $this->sendResponse(new TreatmentResource($currentTreatment), 'Tratamiento actual creado exitosamente.');
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde', 'msg' => $th], 500);
        }
    }

    public function updateTreatment(UpdateTreatmentRequest $request, Treatment $treatment)
    {
        $treatment->update($request->validated());

        return $this->sendResponse(new TreatmentResource($treatment), 'Datos de tratamiento actualizados.');
    }

    public function activeTreatments(Request $request)
    {
        $fullname = $request->get('fullname');
        $nhc = $request->get('nhc');
        return TreatmentResource::collection(Treatment::where('current', true)->where('final_diagnoses_id', null)->whereHas('patient', function ($q) use ($fullname, $nhc) {
            $q->where('user_id', Auth::user()->id)->fullname($fullname)->nhc($nhc);
        })->with('patient')->orderBy('created_at', 'DESC')->paginate(10));
    }

    public function treatmentHistory(Patient $patient)
    {
        try {
            return TreatmentResource::collection(Treatment::where('patient_id', $patient->id)->where('current', false)->orderBy('created_at', 'DESC')->paginate(10));
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde', 'msg' => $th], 500);
        }
    }
}
