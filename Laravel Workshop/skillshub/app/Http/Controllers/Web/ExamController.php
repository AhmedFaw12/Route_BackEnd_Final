<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id){
        $data["exam"] = Exam::findOrFail($id);

        $data['canViewStartBtn'] = true;
        $user = Auth::user();
        if($user !== null){
            $pivotRow = $user->exams()->where("exam_id", $id)->first();

            if($pivotRow !== null && $pivotRow->pivot->status == "closed"){
                $data['canViewStartBtn'] = false;
            }
        }
        return view("web.exams.show")->with($data);
    }



    public function start($examId, Request $request){
        $user = Auth::user();

        //if user entered before and admin opened the status for him to re take exam , then don't make new record
        if(! $user->exams->contains($examId)){//if student did not enter before , then make new record
            $user->exams()->attach($examId);
        }else{
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
                'created_at' => Carbon::now(),
            ]);
        }

        $request->session()->flash("prev", "start/$examId");

        return redirect(url("exams/questions/{$examId}"));
    }

    public function questions($examId, Request $request){
        if(session('prev') !== "start/$examId"){
            return redirect(url("exams/show/$examId"));
        }

        $data["exam"] = Exam::findOrFail($examId);

        $request->session()->flash("prev", "questions/$examId");

        return view("web.exams.questions")->with($data);

    }

    public function submit($examId, Request $request){

        if(session('prev') !== "questions/$examId"){
            return redirect(url("exams/show/$examId"));
        }

        $request->validate([
            'answers' =>"required|array",
            'answers.*' =>"required|in:1,2,3,4",
        ]);

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

        //Calculating Mins
        $user = Auth::user();
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
        $request->session()->flash("success", "you finished exam successfully with score $score%");

        return redirect(url("exams/show/{$examId}"));
    }
}
