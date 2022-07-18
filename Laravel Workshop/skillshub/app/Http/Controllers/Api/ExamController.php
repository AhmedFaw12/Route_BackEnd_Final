<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id){
        $skill = Exam::findOrFail($id);
        return new ExamResource($skill);
    }
    public function showQuestions($id){
        $skill = Exam::with('questions')->findOrFail($id);
        return new ExamResource($skill);
    }


    public function start($examId, Request $request){
        $user = $request->user();

        //if user entered before and admin opened the status for him to re take exam , then don't make new record
        if(! $user->exams->contains($examId)){//if student did not enter before , then make new record
            $user->exams()->attach($examId);
        }else{
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
                'created_at' => Carbon::now(),
            ]);
        }

        return response()->json([
            "message" => "you starated Exam",
        ]);
    }

    public function submit($examId, Request $request){

        $validator = Validator::make($request->all(), [
            'answers' =>"required|array",
            'answers.*' =>"required|in:1,2,3,4",
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        //calculating score
        $points = 0;
        $exam = Exam::findOrFail($examId);
        $totalQuesNum = $exam->questions()->count();
        foreach ($exam->questions as $question) {
            if(isset($request->answers[$question->id])){
                $userAns = $request->answers[$question->id];
                $rightAns = $question->right_ans;

                if($userAns == $rightAns){
                    $points++;
                }
            }
        }

        $score = ($points / $totalQuesNum) * 100;

        // //Calculating Mins
        $user = $request->user();
        $pivotRow =$user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        // submitting after exam duration
        if($timeMins > $pivotRow->duration_mins){
            $score = 0;
        }

        // Update pivot row
        $user->exams()->updateExistingPivot($examId, [
            'score' =>$score,
            'time_mins' => $timeMins,
        ]);

        //sending success message
        return response()->json([
            'message' => "you submitted exam successfully, your score is $score",
        ]);
    }
}
