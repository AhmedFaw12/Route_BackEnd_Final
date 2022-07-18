<?php
/*
Profile scoreboard:
    -we will make score page for user to get his scores
    -the user must login, student, verified to enter this page
    -we will make controller, route for this page
    -we will make a view for profile score and display scores of user
    
    web.php:
        Route::get('/profile',[ProfileController::class, 'index'])->middleware(['auth', 'verified', 'student']);
    
    Web/ProfileController.php:
        public function index(){
            return view("web.profile.index");
        }
        
    views/web/profile/index.blade.php:
        @extends('web.layout')

        @section('title')
            Profile
        @endsection

        @section('main')
            <!-- Hero-area -->
            <div class="hero-area section">

                <!-- Backgound Image -->
                <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/home-background.jpg')}})"></div>
                <!-- /Backgound Image -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 text-center">
                            <ul class="hero-area-tree">
                                <li><a href="{{url("/")}}">{{__('web.home')}}</a></li>
                                <li>{{__('web.profile')}}</li>
                            </ul>
                            <h1 class="white-text">{{__('web.profile')}} </h1>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /Hero-area -->

            <!-- Contact -->
            <div id="contact" class="section">

                <!-- container -->
                <div class="container">

                    <!-- row -->
                    <div class="row">

                        <!-- profile -->
                        <div class="col-md-6 col-md-offset-3">
                            <table class="table">
                                <thead>
                                    <th>Exam name</th>
                                    <th>Score</th>
                                    <th>Time (mins.)</th>
                                </thead>

                                <tbody>
                                    @foreach (Auth::user()->exams as $exam)
                                        <tr>
                                            <td>{{$exam->name()}}</td>
                                            <td>{{$exam->pivot->score}}%</td>
                                            <td>{{$exam->pivot->time_mins}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- profile -->

                    </div>
                    <!-- /row -->

                </div>
                <!-- /container -->

            </div>
            <!-- /Contact -->
        @endsection

        -we copied the layout of login form to profile view 
        -we removed the form and added a table
        -in the table ,we displayed exams name, scores , time_mins that student entered
        -we added some translations
    
    navbar.blade.php:
        @auth
            @if(Auth::user()->role->name == "student")
                <li><a href="{{url('/profile')}}">{{__("web.profile")}}</a></li>
            @endif
            <li><a id="logout-link"  href="#">{{__("web.signout")}}</a></li>
        @endauth

        -we added link for profile
        -user can see profile link if he is log in and he is student
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

active scope:
    -some tables like(cats, skills, exams) have active column ,in which active = 0 means don't display/get this exam/cat/skill

    -so we want to put where("active", 1) when we get any of them:
        $data['allCats'] = Cat::select('id','name')->where("active", 1)->get();
    
    -but we will repeat same where condition in many query 
    -laravel made something called local scope :
        -Local scopes allow you to define common sets of query constraints that you may easily re-use throughout your application

        -for example, you may need to frequently retrieve all users that are considered "popular". To define a scope, prefix an Eloquent model method with scope.

        -how to use:
            -Once the scope has been defined, you may call the scope methods when querying the model. However, you should not include the scope prefix when calling the method. You can even chain calls to various scopes:
    
    Example:
        Cat model:
            public function scopeActive($query){
                return $query->where("active", 1);
            }
        Exam model:
            public function scopeActive($query){
                return $query->where("active", 1);
            }
        
        Skill model:
            public function scopeActive($query){
                return $query->where("active", 1);
            }
        
        CatController.php:
            public function show($id){
                $data['cat'] = Cat::findOrFail($id);
                $data['allCats'] = Cat::select('id','name')->active()->get();
                $data['skills'] = $data["cat"]->skills()->active()->paginate(6);

                return view("web.cats.show")->with($data);
            }

        SkillController.php:
            public function show($id){
                $data["skill"] = Skill::findOrFail($id);
                $data['exams'] = $data['skill']->exams()->active()->get();
                return view("web.skills.show")->with($data);
            }


        Navbar.php:
            public function render()
            {
                $data['cats'] = Cat::select("id", "name")->active()->get();
                return view('components.navbar')->with("data",$data);
            }
--------------------------------------------------------------------------------------------------------------------------------------------------------------------


Laravel Local Scope:
     -some tables like(cats, skills, exams) have active column ,in which active = 0 means don't display/get this exam/cat/skill

    -so we want to put where("active", 1) when we get any of them:
        $data['allCats'] = Cat::select('id','name')->where("active", 1)->get();
    
    -but we will repeat same where condition in many query 
    -laravel made something called local scope :
        -Local scopes allow you to define common sets of query constraints that you may easily re-use throughout your application

        -for example, you may need to frequently retrieve all users that are considered "popular". To define a scope, prefix an Eloquent model method with scope.

        -how to use:
            -Once the scope has been defined, you may call the scope methods when querying the model. However, you should not include the scope prefix when calling the method. You can even chain calls to various scopes:
    
    Example:
        Cat model:
            public function scopeActive($query){
                return $query->where("active", 1);
            }
        
        Skill model:
            public function scopeActive($query){
                return $query->where("active", 1);
            }

        CatController.php:
            public function show($id){
                $data['cat'] = Cat::findOrFail($id);
                $data['allCats'] = Cat::select('id','name')->active()->get();
                $data['skills'] = $data["cat"]->skills()->active()->paginate(6);

                return view("web.cats.show")->with($data);
            }
        


*/