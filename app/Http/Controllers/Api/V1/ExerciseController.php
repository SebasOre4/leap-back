<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Models\Treatment;

class ExerciseController extends BaseController
{

    public function getByTreatment(Treatment $treatment)
    {
        try {
            return ExerciseResource::collection(Exercise::where('treatment_id', $treatment->id)->orderBy('created_at', 'DESC')->get());
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde', 'msg' => $th], 500);
        }
    }

    public function saveGameTreatments(StoreExerciseRequest $request, Treatment $treatment)
    {
        Exercise::where('treatment_id', $treatment->id)->delete();

        try {
            foreach ($request->game_treatments as $key => $value) {
                Exercise::create([
                    "treatment_id" => $treatment->id,
                    "game_id" => $value['game_id'],
                    "game_config" => $value['config']
                ]);
            }

            return ExerciseResource::collection(Exercise::where('treatment_id', $treatment->id)->orderBy('created_at', 'DESC')->get());
        } catch (\Throwable $th) {
            return $this->sendError('Ups :/', ['error' => 'Algo salio mal, intentalo más tarde', 'msg' => $th], 500);
        }
    }
}
