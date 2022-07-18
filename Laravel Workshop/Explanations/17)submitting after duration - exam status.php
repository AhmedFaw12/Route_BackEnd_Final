<?php
/*
submitting after exam duration:
    -if submit time - start time > exam duration ,
    -then we will enter score = 0

    -also we want to send success message to user after finished exam
    -we will send this message through session

    
    ExamController.php:
        public function submit($examId, Request $request){
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

    show.blade.php:
        @include('web.inc.messages')

    messages.blade.php:
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif


        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
--------------------------------------------------------------------------------------------------------------------------------------------------------------------


Exam status:
    ExamController.php:
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

        -when someone wants to see exam page to press start exam
        -we want to make sure who can enter the exam 
        -if someone entered the exam before then he can't enter again unless admin made the status opened:
            -we will get user data who log in:
                $user = Auth::user();
            -make sure that there is a user log in:
                if($user !== null){}
            -get pivot row to check if user entered the exam before and check if status is closed:
                $pivotRow = $user->exams()->where("exam_id", $id)->first();
                
                if($pivotRow !== null && $pivotRow->pivot->status == "closed"){
                    $data['canViewStartBtn'] = false;
                }

                -$pivotRow !== null means that user entered exam before
            
            -we already made middlewares verified, auth, isStudent , but we applied these middlewares on questions page, start button, submit button

            -but we didn't apply middlewares on exam page itself, so we wrote the above code in show()
    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    show.blade.php:
        <div>
            @if ($canViewStartBtn)
                <form action="{{url("exams/start/{$exam->id}")}}" method="POST">
                    @csrf
                    <button type="submit" class="main-button icon-button pull-left">{{__('web.startExamBtn')}}</button>
                </form>
            @endif
        </div>

        //we will use canViewStartBtn to view start btn for users or not
    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    Notes:
        ExamController.php:
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

            -if user entered exam before and admin opened the status for him to re-take exam, then don't make new record 
            
            -we used contains() method to check if records/collection contains this examId 

            -if pivot table doen't contain this exam id ,  make new record 
           
           
            -'status' => 'closed',//in case admin opened the status of exam, so after entering exam again , we will turn status to closed
            'created_at' => Carbon::now() : to calculate duration time correctly if admin opened exam again
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

Handling enter Exam Security:
    -although we hide(UI) start exam button for students who entered before
    -there is a way to enter the exam:
        -student goal is to re enter exams/show/81 and press start exam but he can't

        -student can enter another exam page like : exams/show/80
        -right click inspect change start exam url to http://localhost:8000/exams/start/81

        -then he can enter the exam he wanted and re-take its
    
    -also there is another way to see questions without clicking on start Exam btn:
        student can write in url exams/questions/81
            
    
    Solution to the problem:
        -we want to make sure that user follow certain sequence of routes:
            -start -> questions -> submit
        -so when user enter questions page , we want to make sure that the previous page is its start btn by using id:
            exams/start/81
            exams/questions/81

        -also when user submit answers, we want to make sure that the previous page is its questions page by using id:
            exams/submit/81
            exams/questions/81
    
    Example:
        ExamController.php:
            public function start($examId, Request $request){
                $user = Auth::user();

                $pivotRow = $user->exams()->where("exam_id", $examId)->first();//we want to check if student entered the exam before or not

                //if user entered before and admin opened the status for him to re take exam , then don't make new record
                if($pivotRow === null){//if student did not enter before , then make new record
                    $user->exams()->attach($examId);
                }
                
                $request->session()->flash("prev", "start/$examId");

                return redirect(url("exams/questions/{$examId}"));
            }

            -we added $request to the parameters to be able to use session
            -$request->session()->flash("prev", "start/$examId"):
                -we will save current page part url in session
                -so that when student enters the questions page, we make sure that he is comming from start button of that exam




            public function questions($examId, Request $request){
                if(session('prev') !== "start/$examId"){
                    return redirect(url("exams/show/$examId"));
                }

                $data["exam"] = Exam::findOrFail($examId);

                $request->session()->flash("prev", "questions/$examId");

                return view("web.exams.questions")->with($data);

            }

            Explaination:
                if(session('prev') !== "start/$examId"){
                    return redirect(url("exams/show/$examId"));
                }
                - when student enters the questions page, we make sure that he is comming from start button of that exam

                -we will save current page part url in session:
                    $request->session()->flash("prev", "questions/$examId");


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
                    'status' => 'closed',//in case admin opened the status of exam
                ]);

                //sending success message
                $request->session()->flash("success", "you finished exam successfully with score $score%");

                return redirect(url("exams/show/{$examId}"));
            }

            Explanation:
                if(session('prev') !== "questions/$examId"){
                    return redirect(url("exams/show/$examId"));
                }

                when student submit the answers, we make sure that he is comming from questions page of that exam              
        ----------------------------------------------------------------------------------------------------------------------------------------------------

        CanEnterExam middleware:
            -we protected questions page and submit button , but still we didn't protect start exam button

            -student can enter exam using another exam start button by changing url of start button

            -so we will make middleware (CanEnterExam) to prevent this behaviour

            public function handle(Request $request, Closure $next)
            {
                $examId = $request->route()->parameter("id");
                $user = Auth::user();

                $pivotRow = $user->exams()->where("exam_id", $examId)->first();
                if($pivotRow !== null && $pivotRow->pivot->status == "closed"){
                    return redirect(url("/"));
                }

                return $next($request);
            }

            -to read url parameters in middleware :
                $request->route()->parameter("parameters");
            
            -we get examId from url (exams/start/81)

            -get pivotRow and check if it is not null which means that he entered before

            -also check if status is closed

        kernel.php:
            protected $routeMiddleware = [
                //
                'can-enter-exam' => \App\Http\Middleware\CanEnterExam::class,
            ]


        web.php:
            Route::post('/exams/start/{id}',[ExamController::class, 'start'])->middleware(['auth', 'verified', 'student', 'can-enter-exam']);

            -we applied our middleware on start button route

--------------------------------------------------------------------------------------------------------------------------------------------------------------------



-To access url parameter from middleware:
    $request->route()->parameter("parameter_name");

-To access url all parameter from middleware
    $request->route()->parameters();
*/