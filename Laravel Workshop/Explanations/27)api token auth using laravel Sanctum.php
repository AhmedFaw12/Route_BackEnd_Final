<?php
/*
Api Token auth using Laravel Sanctum:
    Sanctum Installation:
        -composer require laravel/sanctum  :
            -install Laravel Sanctum via the Composer package manager:   
        -php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"  :

            -Next, you should publish the Sanctum configuration and migration files using the vendor:publish Artisan command. The sanctum configuration file will be placed in your application's config directory

        -php artisan migrate:
            Finally, you should run your database migrations. Sanctum will create one database table(called :personal_access_token) in which to store API tokens:

    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    API Token Authentication:
        Sanctum allows you to issue API tokens / personal access tokens that may be used to authenticate API requests to your application. When making requests using API tokens, the token should be included in the (Authorization header as a Bearer token).

        To begin issuing tokens for users, your User model should use the Laravel\Sanctum\HasApiTokens trait:

            use Laravel\Sanctum\HasApiTokens;
 
            class User extends Authenticatable
            {
                use HasApiTokens, HasFactory, Notifiable;
            }
            
        -To issue a token, you may use the createToken method. The createToken method returns a Laravel\Sanctum\NewAccessToken instance. API tokens are hashed using SHA-256 hashing before being stored in your database, but you may access the plain-text value of the token using the plainTextToken property of the NewAccessToken instance. You should display this value to the user immediately after the token has been created:
            simple Example:
                use Illuminate\Http\Request;
 
                Route::post('/tokens/create', function (Request $request) {
                    $token = $request->user()->createToken($request->token_name);
                
                    return ['token' => $token->plainTextToken];
                }); 

    Note:all of Sanctum installation steps are done automatically in laravel project , also User uses HasApiToken trait automatically
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    Project Example:
        idea:
            -when we register/login using api , server will create token and send to the user
            
            -then we protect some routes with middleware auth:sanctum
            -then in order to enter these routes , we must send api token in the header of the request

            -then we receive json response
        
        api.php:
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/login', [AuthController::class, 'login']);

            -we made routes for register and login inorder to create token and send it to the user
            

            Route::middleware('auth:sanctum')->group(function(){
                Route::get("exams/show-questions/{id}", [ExamController::class, 'showQuestions']);
                Route::post("exams/start/{id}", [ExamController::class, 'start']);
                Route::post("exams/submit/{id}", [ExamController::class, 'submit']);
            });

            -we protected start, submit, show-questions route with middleware auth and passed sanctum parameter to it

        Api/AuthController.php:
            public function register(Request $request){
                $validator = Validator::make($request->all(), [
                    'name' => "required|string|max:255",
                    'email' => "required|email|max:255",
                    'password' => "required|string|min:5|max:25|confirmed",
                ]);

                if($validator->fails()){
                    return response()->json($validator->errors());
                }

                $studentRole = Role::where('name', 'student')->first();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' =>$studentRole->id,
                ]);

                $token = $user->createToken("auth-token");

                return ['token'  => $token->plainTextToken];
            }

            -we validated inputs
            -send json response in case of failed validations
            -create user and save in database
            -take this user as object and create token for it:
                $token = $user->createToken("auth-token")

                -token is hashed and saved  in personal_access_tokens table
                -createToken  because we used HasApiToken trait in users model 

            -return token unhashed using plainTextToken property in an array and it will be converted automatically to json:
                return ['token'  => $token->plainTextToken];

            
            public function login(Request $request){
                $validator = Validator::make($request->all(), [
                    'email' => "required|email|max:255",
                    'password' => "required|string|min:5|max:25",
                ]);

                if($validator->fails()){
                    return response()->json($validator->errors());
                }

                $credentials = $request->only('email', "password");
                if(Auth::attempt($credentials)){
                    $user = Auth::user();
                    $token = $user->createToken("auth-token");

                    return ["token", $token->plainTextToken];
                }else{
                    return response()->json(['invalid' =>"Invalid Email or Password"]);
                }
            }

            -validate inputs
            -return json incase of failure validations
            -search for user in users table and save it in sessions using Auth::attempt():
                Auth::attempt($credentials)
            
            -create api token for user and name it auth-token :
                $token = $user->createToken("auth-token");
            
            return token to user

        Api/ExamController.php:
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

            -laravel can get data of user  that sent request(whether he authenticated using session or using api token) :
                -we use $request->user()
                
                -it get name, password, email , ... of password

            -after starting exam , return success json response to user



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
        
        
        Postman:
            Testing Register:
                method:Post     url: http://localhost:8000/api/register
                
                Header:
                    Accept   application/json
            
                body:
                    name            fawzy
                    email           fawzy@student.com   
                    password        123456789
                    password_confirmation   123456789
            
            Testing Login:
                method:Post     url: http://localhost:8000/api/login
                
                Header:
                    Accept   application/json
            
                body:
                    email           fawzy@student.com   
                    password        123456789

                response:
                    {
                        "token": "1|Nj0oRbwipbZT5DdWxAdCLt5RxjCfjMvxhLhujD9S"
                    }

            Testing Start Exam:
                method:Post     url: http://localhost:8000/api/exams/start/81
                
                Header:
                    Accept   application/json
                    Authorization   Bearer 1|Nj0oRbwipbZT5DdWxAdCLt5RxjCfjMvxhLhujD9S
                body:
                
                Response:
                    {
                        "message": "you starated Exam"
                    }
                
                Note:
                    -sometimes when middleware(when we don't send api token)/validation check fails ,it will send me html view not json response
                    -solution is to send :  Accept   application/json   to tell laravel to only send me json
            Testing Submit Exam:
                method:Post     url: http://localhost:8000/api/exams/submit/81
                
                Header:
                    Accept   application/json
                    Authorization   Bearer 1|Nj0oRbwipbZT5DdWxAdCLt5RxjCfjMvxhLhujD9S
                body:
                    answers[1201]   2
                    answers[1202]   2
                    answers[1203]   2
                    answers[1204]   2
                    answers[1205]   2
                Response:
                    {
                        "message": "you submitted exam successfully, your score is 60"
                    }


*/  

