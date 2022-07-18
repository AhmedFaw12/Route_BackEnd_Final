<?php
/*
Api:
    -api is for the front End , not for dashboard
    -if someone wants to make mobile application for the website, so he needs apis (to get categories, show ... , get skills, get exams , .get questions, submit answer, ...)

    -Route of apis in laravel are put in api.php
    -instead of returning views , we will return json response

    Show All Categories api:
        routes/api.php:
            Route::get("categories", [CatController::class, 'index']);

            -api routes have have by default prefix called '/api'

        app/http/resources/CatResource.php:
            -php artisan make:resource CatResource
            -name of resource must be ModelName + Resource
            -we want this resource to return data of category 
            
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_en' => $this->name('en'),
                    'name_ar' => $this->name('ar'),
                ];
            }



        Api/CatController.php:
            -we want to return all categories
            -in order to get data and convert it to json, we will make resource
            
            public function index(){
                $cats = Cat::get();
                return CatResource::collection($cats);
            }

            -since we will bring more than one row , we will use CatResource::collection(allData)

            -if we want only one  category , we will make new object from CatResource(oneData) and pass data to it in constructor

            CatResource will return json 

        PostMan:
            -we will use postman to test my apis and what they return
            steps:
                -choose collection (group of requests that we will save)
                -give it name : skillshub
                -create

                -make new request of get method and url:http://localhost:8000/api/categories

                and save it to skillshub collection 

                -then send to send request

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------

    Show single Category:
        api.php:
            Route::get("categories/show/{cat}", [CatController::class, 'show']);
            
            -we used route binding model {cat}

        Api/CatController.php:
            public function show(Cat $cat){
                return new CatResource($cat);
            }
            -if we want only one  category , we will make new object from CatResource(oneData) and pass data to it in constructor


        App/http/Resources/CatResource.php:
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_en' => $this->name('en'),
                    'name_ar' => $this->name('ar'),
                ];
            }

            -we already made the CatResource

        Postman:
            make new get request and url :http://localhost:8000/api/categories/show/1

            -1 can be id variable and save it in collection of skillshub that we created in postman:http://localhost:8000/api/categories/show/{{id}}

            -we can later remove id and write a number:
                http://localhost:8000/api/categories/show/2

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------

    Get a category with all its skills:
        App/http/resources/SkillResource.php:
            -php artisan make:resource SkillResource

            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_ar' => $this->name("ar"),
                    'name_en' => $this->name("en"),
                    'img' => asset("uploads/$this->img") ,
                    'active' => $this->active,
                ];
            }
            -we made resource for skill

        App/http/resources/CatResource.php:
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_en' => $this->name('en'),
                    'name_ar' => $this->name('ar'),
                    'skills' => SkillResource::collection( $this->skills),
                ];
            }

            -we used SkillResource::collection to get all skills
        
        Api/CatController.php:
            public function index(){
                $cats = Cat::orderBy("id", "DESC")->get();
                return CatResource::collection($cats);
            }

            public function show(Cat $cat){
                return new CatResource($cat);
            }
                   
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------
    Get a category with all its skills(and not getting skills incase of getting all categories):
        -we want to get all skills incase we are getting only one category

        -api.php:
            Route::get("categories", [CatController::class, 'index']);
            Route::get("categories/show/{id}", [CatController::class, 'show']);

        -CatResource.php
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_en' => $this->name('en'),
                    'name_ar' => $this->name('ar'),
                    'skills' => SkillResource::collection( $this->whenLoaded("skills")),
                ];
            }

            -don't load skills untill we load it ourselves in the controller:
                'skills' => SkillResource::collection( $this->whenLoaded("skills")),


        SkillResource.php:
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_ar' => $this->name("ar"),
                    'name_en' => $this->name("en"),
                    'img' => asset("uploads/$this->img") ,
                    'active' => $this->active,
                ];
            }
            
        Api/CatController.php:
            public function index(){
                $cats = Cat::orderBy("id", "DESC")->get();
                return CatResource::collection($cats);
            }

            public function show($id){

                $cat = Cat::with("skills")->findOrFail($id);
                return new CatResource($cat);
            }
            

            -we will load skills in show only 
            -we will not load skills in index
        
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------

    -show single skill with its exams:
        api.php:
            Route::get("skills/show/{id}", [SkillController::class, 'show']);

        SkillResource.php:
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_ar' => $this->name("ar"),
                    'name_en' => $this->name("en"),
                    'img' => asset("uploads/$this->img") ,
                    'active' => $this->active,
                    'exams' => ExamResource::collection($this->whenLoaded("exams")),
                ];
            }

            -get exams when loaded (when we tell it)
        ExamResource.php:
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_ar' => $this->name("ar"),
                    'name_en' => $this->name("en"),
                    'desc_en' => $this->desc("en"),
                    'desc_ar' => $this->desc("ar"),
                    'img' => asset("uploads/$this->img") ,
                    'questions_no' => $this->questions_no,
                    'difficulty' => $this->difficulty,
                    'duration_mins' => $this->duration_mins,
                    'active' => $this->active,
                ];
            }
        
        Api/SkillController.php:
            public function show($id){

                $skill = Skill::with("exams")->findOrFail($id);
                return new SkillResource($skill);
            }
            -we told skills resource to get also exams :    
                $skill = Skill::with("exams")->findOrFail($id);
                return new SkillResource($skill);

        Postman:
            -make new get request with url:http://localhost:8000/api/skills/show/{{id}}
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    -show Exam without questions and Show exam with its questions:
        api.php:
            Route::get("exams/show/{id}", [ExamController::class, 'show']);
            
            Route::get("exams/show-questions/{id}", [ExamController::class, 'showQuestions']); 
            
            -we made 2 routes :one to show exam 
            -the other to show exam with questions
            
            -show exam with questions will be protected as no one could enter it unless he was authenticated
            
        app/http/resources/ExamResource.php:
            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'name_ar' => $this->name("ar"),
                    'name_en' => $this->name("en"),
                    'desc_en' => $this->desc("en"),
                    'desc_ar' => $this->desc("ar"),
                    'img' => asset("uploads/$this->img") ,
                    'questions_no' => $this->questions_no,
                    'difficulty' => $this->difficulty,
                    'duration_mins' => $this->duration_mins,
                    'active' => $this->active,
                    'questions' => QuestionResource::collection($this->whenLoaded("questions")),
                ];
            }
            -we will load questions when we need them
        
        app/http/resources/QuestionResource.php:
            -php artisan make:resource QuestionResource

            public function toArray($request)
            {
                return [
                    'id' => $this->id,
                    'title' => $this->title,
                    'option_1' => $this->option_1,
                    'option_2' => $this->option_2,
                    'option_3' => $this->option_3,
                    'option_4' => $this->option_4,
                    'right_ans' => $this->right_ans,
                ];
            }
            

        Api/ExamController.php:
            public function show($id){
                $skill = Exam::findOrFail($id);
                return new ExamResource($skill);
            }
            -show exam alone

            public function showQuestions($id){
                $skill = Exam::with('questions')->findOrFail($id);
                return new ExamResource($skill);
            }

            -show exam with its questions

        Postman:
            -show exam : get request with url : http://localhost:8000/api/exams/show/{{id}}

            -save
            -show exam with questions: get request with url : http://localhost:8000/api/exams/show-questions/{{id}}

            -save
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------

    Submitting answers of exams(post request of submit answers):
        -form request from mobile application will submit answers
        -mobile user will send post request

        -we will receive request and save answers and calculate scores , .....
        -it will be similar to submit function in web/ExamController

        -in the past we were using auth::user() , but submit is coming from mobile application not from the website , so i have no auth user, we will see in Api Authentication section how to get the user id, ...

        -we will fetch user id in the Api Authentication section according to token

        -we will use Validator class to validate because we want to handle response manually in case there is errors
        
        api.php:
            Route::post("exams/submit/{id}", [ExamController::class, 'submit']);
            
        Api/ExamController.php:
              public function submit($examId, Request $request){

                // if(session('prev') !== "questions/$examId"){
                //     return redirect(url("exams/show/$examId"));
                // }

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

                return response()->json($score);

                
                // //Calculating Mins
                // $user = Auth::user();
                // $pivotRow =$user->exams()->where('exam_id', $examId)->first();
                // $startTime = $pivotRow->pivot->created_at;
                // $submitTime = Carbon::now();

                // $timeMins = $submitTime->diffInMinutes($startTime);

                // // submitting after exam duration
                // if($timeMins > $pivotRow->duration_mins){
                //     $score = 0;
                // }

                // // Update pivot row
                // $user->exams()->updateExistingPivot($examId, [
                //     'score' =>$score,
                //     'time_mins' => $timeMins,
                // ]);

                // //sending success message
                // $request->session()->flash("success", "you finished exam successfully with score $score%");

                // return redirect(url("exams/show/{$examId}"));
            }

            -we used validator class because we want to handle response manually
            
            -we can use validate():
                $request->validate([
                    'answers' =>"required|array",
                    'answers.*' =>"required|in:1,2,3,4",
                ]);
                -but we must pass in the header of postman :
                    Accept: application/json



            -we don't need :
                // if(session('prev') !== "questions/$examId"){
                //     return redirect(url("exams/show/$examId"));
                // }
                -because we are not on our website

            in case of errors ,send json response:
                if($validator->fails()){
                    return response()->json($validator->errors());
                }
                -$validator->errors() :return errors as array

            -calculate score and send json respone with result

            -we want to save scores and data in database ,but we need auth:user() and we don't have user because we are not on website

            //To be continued in
            
                
------------------------------------------------------------------------------------------------------------------------------------------------------------------------

WhenLoaded("relationName")
    The whenLoaded method may be used to conditionally load a relationship. In order to avoid unnecessarily loading relationships, this method accepts the name of the relationship instead of the relationship itself:

*/
