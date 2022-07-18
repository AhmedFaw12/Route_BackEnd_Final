<?php
/*
Start exam:
    steps:
        -when user enter exam
        -we will send post request then get request then post request
        Explanation:
            -start Exam button is submit button of form
            -when user clicks on start Exam button
            -we will send post request that will fill user_id , exam_id in exam_user table
            -then redirect by get request to show questions page
            -after user finishes exam and press submit, 
            -we will send post request that will fill score , time_mins in exam_user table

            -any thing that will be added to database will be made post request

    
    web.php:
        Route::get('/exams/questions/{id}',[ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);

        Route::post('/exams/start/{id}',[ExamController::class, 'start'])->middleware(['auth', 'verified', 'student']);
        
        Route::post('/exams/submit/{id}',[ExamController::class, 'submit'])->middleware(['auth', 'verified', 'student']);

        -since we will make post then get then post , so we will make 3 routes
        -we will apply (auth, verified, student) middlewares on these routes , so only authenticated , verified , student user can enter these routes
        -post route when click on start exam button
        -get route to show questions page 
        -post route when click on submit answers button

    
    Models/Exam.php:
        public function users(){
            return $this->belongsToMany(User::class)
            ->withPivot('score', 'time_mins', 'status')
            ->withTimestamps();
        }
    Models/User.php:
        public function exams(){
            return $this->belongsToMany(Exam::class)
            ->withPivot('score', 'time_mins', 'status')
            ->withTimestamps();
        }

        -By default, only the model keys will be present on the pivot model. If your intermediate table contains extra attributes, you must specify them when defining the relationship

        If you would like your intermediate table to have created_at and updated_at timestamps that are automatically maintained by Eloquent, call the withTimestamps method when defining the relationship:

        -we must do this in both models relations

    exams/show.blade.php:
        <form action="{{url("exams/start/{$exam->id}")}}" method="POST">
            @csrf
            <button type="submit" class="main-button icon-button pull-left">{{__('web.startExamBtn')}}</button>
        </form>

        -we made post form to start exam

    ExamController.php:
        public function start($examId){
            $user = Auth::user();
            $user->exams()->attach($examId);

            return redirect(url("exams/questions/{$examId}"));
        }

        -Eloquent also provides methods to make working with many-to-many relationships more convenient. For example, let's imagine a user can have many roles and a role can have many users. You may use the attach method to attach a role to a user by inserting a record in the relationship's intermediate table:

        -after inserting user_id and examId in exam_user table , we will redirect to questions page
--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


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


*/