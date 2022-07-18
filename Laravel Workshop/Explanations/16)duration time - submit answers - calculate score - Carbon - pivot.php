<?php
/*
Duration Time of Exam:
    -there is a jquery plugin/library that can make countdown timer
    -this jquery plugin called : TimeCircles

    Step1:
        -search for TimeCircles js on google , then go to the github page of the plugin
        -to use this plugin ,we need three files and we need to link on them in our project : jquery , plugin js file, plugin css file

        -jquery file , already is linked in layout page
        -(plugin js file, plugin css file) we will get them and put them in public/web folder and link on them in question.blade.php

        questions.blade.php:
            @section('styles')
                <link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
            @endsection

        
            @section('main')

            @endsection
        
            @section('scripts')
                <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>
            @endsection


    Step2(create stopwatch(countdown timer)):
        -to display countdown timer , we will write this div:
            <div class="ourName" data-timer="time_in_seconds"></div>
        
        -attribute data-timer is used, and the value is the time to count down from (in seconds).

        -to make div appear and work ,we need to write some js script:
            $(".duration-countdown").TimeCircles();

        questions.blade.php:
            
            @section('styles')
                <link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
            @endsection

        
            @section('main')
                //
                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    {{-- timeCircles countdown Timer --}}
                    <div class="duration-countdown" data-timer="10"></div>
                </div>
            @endsection

            @section('scripts')
                <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

                <script>
                    $(".duration-countdown").TimeCircles();
                </script>
            @endsection

    Step3:
        -there is days , hours , mins, seconds
        -we can disable what we want

        -time feature in timeCricles:
            The time option is actually a group of options that allows you to control the options of each time unit independently. As such, within time each unit of time has its own sub-category. These categories are: Days, Hours, Minutes, and Seconds. The options available within each category are as follows:

            show: Determines whether the time unit should be shown at all
            text: Determines the text shown below the time. Useful for use on non-English websites
            color: Determines the color of the foreground circle of the time unit
                $(".example").TimeCircles({ time: {
                    Days: { color: "#C0C8CF" },
                    Hours: { color: "#C0C8CF" },
                    Minutes: { color: "#C0C8CF" },
                    Seconds: { color: "#C0C8CF" }
                }});
        
        -we can disable days

        questions.blade.php:
            
            @section('styles')
                <link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
            @endsection

        
            @section('main')
                //
                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    {{-- timeCircles countdown Timer --}}
                    <div class="duration-countdown" data-timer="10"></div>
                </div>
            @endsection

            @section('scripts')
                <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

                <script>
                    $(".duration-countdown").TimeCircles({
                        time: {
                            Days : {
                                show: false,
                            }
                        },
                    });
                </script>
            @endsection

    Step4:
        -in timeCircles , when the countdown reaches 0 , it will count up
        -so we need to stop the count up

        questions.blade.php:
            @section('styles')
                <link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
            @endsection

        
            @section('main')
                //
                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    {{-- timeCircles countdown Timer --}}
                    <div class="duration-countdown" data-timer="10"></div>
                </div>
            @endsection

            @section('scripts')
                <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

                <script>
                    $(".duration-countdown").TimeCircles({
                        time: {
                            Days : {
                                show: false,
                            }
                        },
                        count_past_zero: false,
                    });
                </script>
            @endsection

    step5:
        -if Countdown timer finished but the student didn't finish exam
        -we want then the countdown time submit automatically if student didn't finish exam
        
        -we will make event/addlistener and the event will trigger automatically when the time is finished , for now we will show alert message when the time is up/finished:
            $(".duration-countdown").TimeCircles().addListener(function(unit, value, total){
                if(total <= 0){
                    alert("time up");
                }
            }); 
      
        -we also want to get the time of exam from exams table in database
        questions.blade.php:
            <div class="duration-countdown" data-timer="{{$exam->duration_mins * 60}}"></div>
            @section('scripts')
                <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

                <script>
                    $(".duration-countdown").TimeCircles({
                        time: {
                            Days : {
                                show: false,
                            }
                        },
                        count_past_zero: false,
                    }).addListener(function(unit, value, total){
                        if(value <= 0){
                            alert("time up");
                        }
                    });
                </script>
            @endsection
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Final Code:
        questions.blade.php:
            @section('styles')
                <link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
            @endsection

        
            @section('main')
                //
                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    {{-- timeCircles countdown Timer --}}
                    <div class="duration-countdown" data-timer="{{$exam->duration_mins * 60}}"></div>
                </div>
            @endsection

            @section('scripts')
                <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

                <script>
                    $(".duration-countdown").TimeCircles({
                        time: {
                            Days : {
                                show: false,
                            }
                        },
                        count_past_zero: false,
                    }).addListener(function(unit, value, total){
                        if(total <= 0){
                            alert("time up");
                        }
                    });
                </script>
            @endsection
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Submit Answers:
Submit answer Form:
    -we need a form to submit answers of the form
    -what we will submit: is the id of the question and the choice no. of the student
    -adding form will corrupt our design , so we will make empty form  give it id = "exam-submit-form" 
    
    -we can tell our submit button belongs to form whose id is exam-submit by using attribute form
    -we can tell our radio inputs belongs to form whose id is exam-submit by using attribute form
    -we want to send radio inputs values as associative array where key is the question-id
    and value is the choice that student made
        -to send an array from form to php:
            -we give inputs name = "anyName["key"]"

    questions.blade.php:
        <!-- row -->
        <div class="row">
            <form id="exam-submit-form" action="{{url("exams/submit/{$exam->id}")}}" method ="POST">
                @csrf
            </form>
            <!-- main blog -->
            <div id="main" class="col-md-9">

                <!-- blog post -->
                <div class="blog-post mb-5">
                    <p>
                    @foreach ($exam->questions as $index => $quest)
                        {{-- single question --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$index + 1 }} {{$quest->title}}</h3>
                            </div>
                            <div class="panel-body">
                                {{-- single option --}}
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answers[{{$quest->id}}]" value="1" form='exam-submit-form'>
                                        {{$quest->option_1}}
                                    </label>
                                </div>
                                {{-- /single option --}}
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answers[{{$quest->id}}]" value="2" form='exam-submit-form'>
                                        {{$quest->option_2}}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answers[{{$quest->id}}]" value="3" form='exam-submit-form'>
                                        {{$quest->option_3}}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="answers[{{$quest->id}}]" value="4" form='exam-submit-form'>
                                        {{$quest->option_4}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- /single question --}}
                    @endforeach
                    </p>
                </div>
                <!-- /blog post -->

                <div>
                    <button type="submit" form="exam-submit-form" class="main-button icon-button pull-left">@lang('web.submitBtn')</button>
                    <button class="main-button icon-button btn-danger pull-left ml-sm">@lang('web.cancelBtn')</button>
                </div>
            </div>
            <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                <!-- exam details widget -->
                <ul class="list-group">
                    <li class="list-group-item">{{__('web.skill')}}: {{$exam->skill->name()}}</li>
                    <li class="list-group-item">{{__('web.questions')}}: {{$exam->questions_no}}</li>
                    <li class="list-group-item">{{__('web.duration')}}: {{$exam->duration_mins}} {{__('web.mins')}}</li>
                    <li class="list-group-item">{{__('web.difficulty')}}:
                        @for ($i = 1; $i <= $exam->difficulty; $i++)
                            {{-- star --}}
                            <i class="fa fa-star"></i>
                        @endfor
                        @for ($i = 1; $i <= 5 - $exam->difficulty; $i++)
                            {{-- empty star --}}
                            <i class="fa fa-star-o"></i>
                        @endfor
                    </li>
                </ul>
                <!-- /exam details widget -->

                {{-- timeCircles countdown Timer --}}
                {{-- <div class="duration-countdown" data-timer="10"></div> --}}
                <div class="duration-countdown" data-timer="{{$exam->duration_mins * 60}}"></div>

            </div>
            <!-- /aside blog -->

        </div>
        <!-- row -->


    ExamController.php:
        public function submit($examId, Request $request){
            dd($request->all());
        }

    
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Calculating Score:
    -after submitting form, we need to validates inputs
    -You may also validate each element of an array using (arrayname.*)
    -we want to validate answers as required and array
    -we want to validate each element of answers to be required and in values(1,2,3,4)
      
    -then we need to calculate score 
    -we will get exam from table using exam id
    -then we will loop over all question of exam

    -sometimes some questions are not submit from user because time has exceeded or user himself submited sime questions only
    
    -so we have to check if Answers[questions_id] is null or not
    
    -then we will check if user answer == right answer , if true , increase points by 1
    -get the points/totalQuesNum , then we will get the score

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
        }

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Calculate Time:
    -we will use carbon class 
    -when user entered exam , we added created_at , so we know the start time when user entered exam

    -we can get submit time using carbon::now():
        $submitTime = Carbon::now();
    
    -to get start time(created_at) from pivot table :
        -we will get all pivot row :
        
            $pivotRow =$user->exams()->where('exam_id', $examId)->first();

        get required field/columnValue using pivot keyword and using exam_id and user_id
            $startTime = $pivotRow->pivot->created_at;
    
    -then get difference in minutes between submit time and start time:
        $timeMins = $submitTime->diffInMinutes($startTime); 

    -after getting score and timeMins ,we need to update pivot row in exam_user pivot table:
        -we will use updateExistingPivot()

        $user->exams()->updateExistingPivot($examId, [
            'score' =>$score,
            'time_mins' => $timeMins,
        ]);

    -then redirect to exam page:
        return redirect(url("exams/show/{$examId}"));

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
            
            // Update pivot row
            $user->exams()->updateExistingPivot($examId, [
                'score' =>$score,
                'time_mins' => $timeMins,
                'status' => 'closed',//in case admin opened the status of exam for student to re-enter the exam
            ]);

            return redirect(url("exams/show/{$examId}"));
        }

    questions.blade.php:
        @section('scripts')
            <script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>

            <script>
                $(".duration-countdown").TimeCircles({
                    time: {
                        Days : {
                            show: false,
                        }
                    },
                    count_past_zero: false,
                }).addListener(function(unit, value, total){
                    if(total <= 0){
                        $('#exam-submit-form').submit();
                    }
                });
            </script>
        @endsection

        -we will submit form when countdown reaches 0

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

-Carbon Class:
    -we used Carbon class to display date in certain format
    -we must write the namespace of Carbon class inorder to use class
    -carbon class inherits from php DateTime class
    -d : Represents the day of the month (01 to 31)
    -m : Represents a month (01 to 12)
    -Y : Represents a year (in four digits)
    -h :12-hour format of an hour with leading zeros	01 through 12
    -i : Minutes with leading zeros	00 to 59
    -s :Seconds with leading zeros	00 through 59
    -A :Uppercase Ante meridiem and Post meridiem	AM or PM

    example:
        Carbon\Carbon::parse($skill->created_at)->format("d M, Y")
    example:
        <td>{{Carbon\Carbon::parse($exam->pivot->created_at)->format('Y M d/ h:i:s A')}}</td>
        o/p: 2022 Jul 14/ 04:37:53 AM

    Carbon::now():
        -carbon class can be also used for getting now time
        Example:
            $submitTime = Carbon::now();

    Carbon::diffInMins():
        -carbon class can be also used for getting difference in min between two time intervals

        -laterTime->diffInMins(StartTime);
        Example:
            get difference in minutes between submit time and start time:
                $timeMins = $submitTime->diffInMinutes($startTime);           


    Carbon Conclusion:
        -It provides some nice functionality to deal with dates in PHP. Specifically things like:
            -Dealing with timezones.
            -Getting current time easily.
            -Converting a datetime into something readable.
            -Parse an English phrase into datetime ("first day of January 2016").
            -Add and Subtract dates ("+ 2 weeks", "-6 months").
            -Semantic way of dealing with dates.
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Pivot Continue:
    -withPivot():
        By default, only the model keys will be present on the pivot model. If your intermediate table contains extra attributes, you must specify them when defining the relationship:

        example:
            Models/User.php:
            public function exams(){
                return $this->belongsToMany(Exam::class)
                ->withPivot('score', 'time_mins', 'status')
                ->withTimestamps();
            }
            
    -withTimestamps():
        If you would like your intermediate table to have created_at and updated_at timestamps that are automatically maintained by Eloquent, call the withTimestamps method when defining the relationship

        Example:
            Models/User.php:
            public function exams(){
                return $this->belongsToMany(Exam::class)
                ->withPivot('score', 'time_mins', 'status')
                ->withTimestamps();
            }
    
    -attach():
        -used to insert a record in Pivot table
        
        -Eloquent also provides methods to make working with many-to-many relationships more convenient. For example, let's imagine a user can have many roles and a role can have many users. You may use the attach method to attach a role to a user by inserting a record in the relationship's intermediate table:
        
        EXAMPLE:
            ExamController.php:
               public function start($examId){
                    $user = Auth::user();
                    $user->exams()->attach($examId);

                    return redirect(url("exams/questions/{$examId}"));
                }

        Example2:
            $user = User::find(1);
            $user->roles()->attach($roleId);
    
    -To get all pivot row  from pivot table:
        $pivotRow =$user->exams()->where('exam_id', $examId)->first();
    
    -get required field/columnValue using pivot keyword from pivot row
        $startTime = $pivotRow->pivot->created_at;

        Example:
            -to get start time(created_at) from pivot table :
                -we will get all pivot row :
                
                    $pivotRow =$user->exams()->where('exam_id', $examId)->first();

            -get required field/columnValue using pivot keyword from pivot row
                    $startTime = $pivotRow->pivot->created_at;

    -updateExistingPivot():
        -To Update A Record On The Intermediate Table
        
        -This method accepts the intermediate record foreign key and an array of attributes to update

        Example:
            -after getting score and timeMins ,we need to update pivot row in exam_user pivot table:
                -we will use updateExistingPivot()

                $user->exams()->updateExistingPivot($examId, [
                    'score' =>$score,
                    'time_mins' => $timeMins,
                ]);
*/