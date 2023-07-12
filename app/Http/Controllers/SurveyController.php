<?php

namespace App\Http\Controllers;

use App\Models\Surveys;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function getSurveys(Request $request): array
    {
        $surveys = Surveys::all();
        if ($surveys->isEmpty()) {
            return [
                "status" => false,
                "message" => "No Surveys found",
                "data" => []
            ];
        } else {
            return [
                "status" => true,
                "message" => $surveys->count() . " surveys found",
                "data" => [
                    "surveys" => $surveys
                ]
            ];
        }

    }

    public function addSurvey (Request $request): array
    {
        $data = $request->all();
        if (!Surveys::where('enteredName', '=', $data['enteredName'])->exists()) {
            $survey = Surveys::create([
                "enteredName" => $data['enteredName'],
                "chosenRating"=> $data['chosenRating']
            ]);
            if (empty($survey->id)) {
                return [
                    "status" => false,
                    "message" => "An unexpected error has occurred",
                    "data" => []
                ];
            } else {
                return [
                    "status" => true,
                    "message" => "Survey " . $data['enteredName'] . " added",
                    "data" => [
                        "survey" => $survey
                    ]
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "The survey already exist",
                "data" => []
            ];
        }
    }

    public function deleteSurvey (Request $request): array
    {
        $data = $request->all();
        if (Surveys::where('id', '=',$data['id'])->exists()) {
            Surveys::where('id',$data['id'])->delete();
            return [
                "status" => true,
                "message" => "Survey deleted",
                "data" => []
            ];
        } else {
            return [
                "status" => false,
                "message" => "No surveys were found with id: ". $data['id'],
                "data" => []
            ];
        }
    }
}
