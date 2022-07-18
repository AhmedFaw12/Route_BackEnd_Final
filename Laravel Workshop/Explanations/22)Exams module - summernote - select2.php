<?php
/*
Exams Module:
    -Exams module ,when we add exam ,we add exam data with its questions data
    Idea:
        -show all exams with few details
        -show certain exam full details
        -show certain exam questions

        -create Exam  
        -create Questions of Exam
        
        -edit Exam but we can't edit questions_no
        -edit certain question 
        
        -delete Exam with all its questions exception with one condition
        -toggle active under certain condition


    Display all Exams:
        web.php:
            Route::get("/exams", [AdminExamController::class, 'index']);

            -we added route to get all exams 

        Admin/ExamController.php:
            public function index(){
                $data["exams"] = Exam::select("id", "name", "skill_id", "img", "active", "questions_no")
                ->orderBy('id', "DESC")->paginate(10);

                return view("admin.exams.index")->with($data);
            }

            -we get all exams and go to exams/index.blade.php
        
        admin/layout.blade.php:
            <li class="nav-item">
                <a href="{{url("/dashboard/exams")}}" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                        Exams
                    </p>
                </a>
            </li>

            -we added exam link in the sidebar

        admin/exams/index.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Exams</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Exams</li>
                                    </ol>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">

                                        @include("admin.inc.messages")

                                        <div class="card-header">
                                            <h3 class="card-title">All Exams</h3>

                                            <div class="card-tools">

                                                <a href="{{url('dashboard/exams/create')}}" class="btn btn-sm btn-primary" >Add New Exam</a>
                                            </div>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">

                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name (en)</th>
                                                        <th>Name (ar)</th>
                                                        <th>Img</th>
                                                        <th>Skill</th>
                                                        <th>Questions no.</th>
                                                        <th>Active</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($exams as $exam)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$exam->name('en')}}</td>
                                                            <td>{{$exam->name('ar')}}</td>
                                                            <td>
                                                                <img height="50px" src="{{asset("uploads/$exam->img")}}" alt="exam img">
                                                            </td>
                                                            <td>{{$exam->skill->name('en')}}</td>
                                                            <td>{{$exam->questions_no}}</td>
                                                            @if ($exam->active)
                                                                <td><span class="badge bg-success">yes</span></td>
                                                            @else
                                                                <td><span class="badge  bg-danger">no</span></td>
                                                            @endif
                                                            <td>
                                                                <a href="{{url("dashboard/exams/show/{$exam->id}")}}"  class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

                                                                <a href="{{url("dashboard/exams/show-questions/{$exam->id}")}}"  class="btn btn-sm btn-success"><i class="fas fa-question"></i></a>

                                                                <a href="{{url("dashboard/exams/edit/{$exam->id}")}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

                                                                <form method ="POST" action="{{url("dashboard/exams/delete/{$exam->id}")}}" style="display:none"  id="delete-form" >
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>

                                                                <button type="submit" form="delete-form" class="btn btn-sm btn-danger" form="delete-form"><i class="fas fa-trash"></i></button>

                                                                <a href="{{url("dashboard/exams/toggle/{$exam->id}")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="d-flex my-3 justify-content-center">
                                                {{$exams->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -we display exam name, desc, img, questions_no, active using foreach
            -we displayed pagination

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Display certain Exam:
        web.php:
            Route::get("/exams/show/{exam}", [AdminExamController::class, 'show']);
            
            -we added route to get single exam

        Admin/ExamController.php:
            public function show(Exam $exam){
                $data["exam"] = $exam;
                return view("admin.exams.show")->with($data);
            }
            -we get exam data and go to exams/show blade

        admin/exams/index.blade.php: 
            <a href="{{url("dashboard/exams/show/{$exam->id}")}}"  class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

            -we added a link to displat full exam data

        admin/exams/show.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">{{ $exam->name('en') }}</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ url('/dashboard/exams') }}">Exams</a>
                                        </li>
                                        <li class="breadcrumb-item active">{{ $exam->name('en') }}</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-10 offset-md-1 pb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Exam details</h3>
                                        </div>

                                        <div class="card-body p-0">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th>Name (en)</th>
                                                        <td>{{$exam->name("en")}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name (ar)</th>
                                                        <td>{{$exam->name("ar")}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description (en)</th>
                                                        <td>{!! $exam->desc("en") !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description (ar)</th>
                                                        <td>{!! $exam->desc("ar") !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Skill</th>
                                                        <td>{{$exam->skill->name("en")}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Image</th>
                                                        <td><img height="50px" src="{{asset("uploads/$exam->img")}}" alt="exam_img"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Questions_no </th>
                                                        <td>{{$exam->questions_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Difficulty</th>
                                                        <td>{{$exam->difficulty}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Duration (mins)</th>
                                                        <td>{{$exam->duration_mins}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Active</th>
                                                        @if ($exam->active)
                                                            <td><span class="badge bg-success">yes</span></td>
                                                        @else
                                                            <td><span class="badge  bg-danger">no</span></td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <a href="{{url("dashboard/exams/show-questions/{$exam->id}")}}" class="btn btn-sm btn-success">Show Questions</a>

                                    <a href="{{url()->previous()}}" class="btn btn-sm btn-primary">Back</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -we displayed exam name, desc, img, questions_no, duration_mins, active, skill name, difficulty

            -we added back button to go to previous url

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Display questions of certain exam:
        web.php:
            Route::get("/exams/show-questions/{exam}", [AdminExamController::class, 'showQuestions']);

            -we made route to get all questions of certain exam

        Admin/ExamController.php:
            public function showQuestions(Exam $exam){
                $data["exam"] = $exam;

                return view("admin.exams.show-questions")->with($data);
            }
            -we got all exam data included exams and go to exam/show-questiosn blade

        admin/exams/index.blade.php:
            <a href="{{url("dashboard/exams/show-questions/{$exam->id}")}}"  class="btn btn-sm btn-success"><i class="fas fa-question"></i></a>
            
            -we added a link to go to exams/show-questions blade

        admin/exams/show.blade.php:
            <a href="{{url("dashboard/exams/show-questions/{$exam->id}")}}" class="btn btn-sm btn-success">Show Questions</a>          

            -we added a link to go to exams/show-questions blade

        admin/exams/show-questions.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">{{ $exam->name('en') }} Questions</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ url('/dashboard/exams') }}">Exams</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{ url("/dashboard/exams/show/$exam->id") }}">{{ $exam->name('en') }}</a>
                                        </li>
                                        <li class="breadcrumb-item active">Questions</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 pb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Exam details</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>Options</th>
                                                        <th>Right Ans.</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($exam->questions as $ques)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$ques->title}}</td>
                                                            <td>
                                                                {{$ques->option_1}} |<br>
                                                                {{$ques->option_2}} |<br>
                                                                {{$ques->option_3}} |<br>
                                                                {{$ques->option_4}}
                                                            </td>
                                                            <td>{{$ques->right_ans}}</td>
                                                            <td>
                                                                <a href="{{url("dashboard/exams/edit-questions/{$exam->id}/{$ques->id}")}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <a href="{{url()->previous()}}" class="btn btn-sm btn-primary">Back</a>

                                    <a href="{{url("dashboard/exams")}}" class="btn btn-sm btn-primary">Back to all exams</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -we displayed all questions title, options, right_answer
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Create Exam:
        web.php:
            Route::get("/exams/create", [AdminExamController::class, 'create']);
            Route::post("/exams/store", [AdminExamController::class, 'store']);
            
            -we added 2routes:
                -one (get request) to go to create exam form blade
                -the other (post request) to create/store exam in database

        Admin/ExamController.php:
            public function create(){
                $data["skills"] = Skill::select("id", "name")->get();

                return view("admin.exams.create")->with($data);
            }

            -we got skills so that in create form ,we choose skill of the exam from select option

            public function store(Request $request){

                $request->validate([
                    'name_en' => "required|string|max:50",
                    'name_ar' => "required|string|max:50",
                    'desc_en' => "required|string|max:5000",
                    'desc_ar' => "required|string|max:5000",
                    'img' =>"required|image|mimes:png,jpg|max:2048",//2048kB = 2MB
                    'skill_id' => "required|exists:skills,id",
                    'questions_no' => "required|integer|min:1",
                    'difficulty' => "required|integer|min:1|max:5",
                    'duration_mins' => "required|integer|min:1",
                ]);

                $path = Storage::putFile("exams", $request->file('img'));//return path of image

                $exam = Exam::create([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                    'desc' => json_encode([
                        'en' => $request->desc_en,
                        'ar' => $request->desc_ar,
                    ]),
                    'img' =>$path,
                    'skill_id' => $request->skill_id,
                    'questions_no' => $request->questions_no,
                    'difficulty' => $request->difficulty,
                    'duration_mins' => $request->duration_mins,
                    'active' => 0,
                ]);

                $request->session()->flash("prev", "exam/{$exam->id}");

                return redirect(url("dashboard/exams/create-questions/{$exam->id}"));
            }

            -we validate inputs
            -save image in storage
            create exam record in database but made active = 0
            -active will be 0 untill we add all questions ,then we will make active = 1



        admin/layout.blade.php:
            <!-- summernote textarea enhance -->
            <head>
            
                <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

                <!-- select2 selects-->
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

                <style>
                    .select2-selection__rendered {
                        line-height: 31px !important;
                    }
                    .select2-container .select2-selection--single {
                        height: 39px !important;
                    }
                    .select2-selection__arrow {
                        height: 34px !important;
                    }
                </style>
            </head>

            <body>
                //
                <!-- summernote textarea enhance -->
                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

                <!-- select2 select -->
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


                <script>
                    //summernote textarea enhance script
                    $(document).ready(function() {
                        $('.textarea').summernote({
                            height: 100,
                        });
                    });

                    //select2 select script
                    $(document).ready(function() {
                        $('.select').select2();
                    });
                </script>
            </body>
            
            -we added links and scripts used for summernote and select2 plugins
            -summernote : enchance textarea allowing us to write like we are writing in word(bold, italic, header, .....)

            -select2 :enhance select html element

        admin/exams/index.blade.php:
            <a href="{{url('dashboard/exams/create')}}" class="btn btn-sm btn-primary" >Add New Exam</a>

            -we added link to go to create exam form blade
        
        admin/exams/create.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Exam</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                            <li class="breadcrumb-item active">Add new Exam</li>
                            </ol>
                        </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 pb-3">

                                @include("admin.inc.errors")

                                <form  method="POST" action="{{url('dashboard/exams/store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label >Name (en)</label>
                                                <input type="text" name="name_en" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label >Name (ar)</label>
                                                <input type="text" name="name_ar" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label >Description (en)</label>
                                                <textarea rows="5" name="desc_en" class="form-control textarea"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label >Description (ar)</label>
                                                <textarea rows="5" name="desc_ar" class="form-control textarea" ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            {{-- select options/dropdown menu of skills --}}
                                            <div class="form-group">
                                                <label>Skill</label>
                                                <select  class=" form-control select" name="skill_id">
                                                    @foreach ($skills as $skill)
                                                        <option value="{{$skill->id}}">{{$skill->name('en')}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            {{-- upload file --}}
                                            <div class="form-group">
                                                <label >Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="img">
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="form-group">
                                                <label >Questions no.</label>
                                                <input type="number" name="questions_no" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label >Difficulty</label>
                                                <input type="number" name="difficulty" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label >Duration (mins.)</label>
                                                <input type="number" name="duration_mins" class="form-control" >
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -create exam form contains:
                -we enter name, desc, image, questions_no, difficulty, duration_mins, skill of image

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Create Exam Questions:
        web.php:
            Route::get("/exams/create-questions/{exam}", [AdminExamController::class, 'createQuestions']);

            Route::post("/exams/store-questions/{exam}", [AdminExamController::class, 'storeQuestions']);
            
            -we added route to create questions of exam:
                -one to get create-questions view(get request)
                -the other one to store/create questions in database
        Admin/ExamController.php:
                    
            public function store(Request $request){
                $request->session()->flash("prev", "exam/{$exam->id}");
            }

            -we want user to create exam then create questions
            -we don't want user to jump to create questions directly

            -so we will save variable in session and check for it in createQuestions

            public function createQuestions(Exam $exam){
                if(session("prev") !== "exam/{$exam->id}" && session("current") !== "exam/{$exam->id}"){
                    return redirect(url("/dashboard/exams"));
                }

                $data["exam_id"] = $exam->id;
                $data["questions_no"] = $exam->questions_no;

                return view("admin.exams.create-questions")->with($data);
            }

            public function storeQuestions(Exam $exam, Request $request){

                $request->session()->flash("current", "exam/{$exam->id}");

                $request->validate([
                    "titles" => "required|array",
                    "titles.*" => "required|string|max:500",
                    "right_anss" => "required|array",
                    "right_anss.*" => "required|in:1,2,3,4",
                    "option_1s" => "required|array",
                    "option_1s.*" => "required|string|max:255",
                    "option_2s" => "required|array",
                    "option_2s.*" => "required|string|max:255",
                    "option_3s" => "required|array",
                    "option_3s.*" => "required|string|max:255",
                    "option_4s" => "required|array",
                    "option_4s.*" => "required|string|max:255",
                ]);

                for($i = 0; $i < $exam->questions_no; $i++){
                    Question::create([
                        "exam_id" =>$exam->id,
                        "title" =>$request->titles[$i],
                        "option_1" =>$request->option_1s[$i],
                        "option_2" =>$request->option_2s[$i],
                        "option_3" =>$request->option_3s[$i],
                        "option_4" =>$request->option_4s[$i],
                        "right_ans" =>$request->right_anss[$i],
                    ]);

                }

                $exam->update([
                    "active" => 1,
                ]);

                event(new ExamAddedEvent);

                return redirect(url("/dashboard/exams"));
            }

            -when there is error in validation , it will go to the previous url
            -but the previous url goes to createQuestions function , which has only:
                if(session("prev") !== "exam/{$exam->id}"){
                    return redirect(url("/dashboard/exams"));
                }

                -so there is not prev variable in session ,so it goes to show all exams view

            -to solve this issue:
                -$request->session()->flash("current", "exam/{$exam->id}");
                and check for it in createQuestions functions:
                    if(session("prev") !== "exam/{$exam->id}" && session("current") !== "exam/{$exam->id}"){
                        return redirect(url("/dashboard/exams"));
                    }

            -we will validate each array and its elements
            -we will make for loop to store each question data
            -make exam active

        admin/exams/create-questions.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Add new Exam(Step 2)</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                            <li class="breadcrumb-item active">Add new Exam(Step 2)</li>
                            </ol>
                        </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 pb-3">

                                @include("admin.inc.errors")

                                <form  method="POST" action="{{url("dashboard/exams/store-questions/{$exam_id}")}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        @for($i = 1; $i<= $questions_no; $i++)

                                            <h5>Question {{$i}} </h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label >Title</label>
                                                        <input type="text" name="titles[]" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label >Right Ans.</label>
                                                        <input type="number" min="1" max="4" name="right_anss[]" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label >Option 1</label>
                                                        <input type="text" name="option_1s[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label >Option 2</label>
                                                        <input type="text" name="option_2s[]" class="form-control ">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label >Option 3</label>
                                                        <input type="text" name="option_3s[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label >Option 4</label>
                                                        <input type="text" name="option_4s[]" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-success">Submit</button>

                                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -we are making inputs for each question :title, option_1, option_2,option_3,option_4, right_ans

            -so these inputs are entered according to the number of questions 
        
            -so we need to enter multiple titles, option_1s , option_2s,option_3s,option_4s,right_anss 
            -so we need foreach to display inputs
            -so we will send them as array


        
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Edit Exam without questions_no:
        web.php:
            Route::get("/exams/edit/{exam}", [AdminExamController::class, 'edit']);
            Route::put("/exams/update/{exam}", [AdminExamController::class, 'update']);

            -we added 2 routes:
                -one(get request) to get exam edit form blade
                -the other (put request) to edit exam in database
        Admin/ExamController.php:
            public function edit(Exam $exam){
                $data["exam"] = $exam;
                $data["skills"] = Skill::select("id", "name")->get();

                return view("admin.exams.edit")->with($data);
            }

            public function update(Exam $exam, Request $request){
                $request->validate([
                    'name_en' => "required|string|max:50",
                    'name_ar' => "required|string|max:50",
                    'desc_en' => "required|string|max:5000",
                    'desc_ar' => "required|string|max:5000",
                    'img' => "nullable|image|mimes:png,jpg|max:2048",//2048kB = 2MB
                    'skill_id' => "required|exists:skills,id",
                    'difficulty' => "required|integer|min:1|max:5",
                    'duration_mins' => "required|integer|min:1",
                ]);
                $path = $exam->img;

                if($request->hasFile('img')){
                    Storage::delete($path);
                    $path = Storage::putFile("exams", $request->file('img'));//return path of image
                }


                $exam->update([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                    'desc' => json_encode([
                        'en' => $request->desc_en,
                        'ar' => $request->desc_ar,
                    ]),
                    'img' =>$path,
                    'skill_id' => $request->skill_id,
                    'difficulty' => $request->difficulty,
                    'duration_mins' => $request->duration_mins,
                ]);

                $request->session()->flash("msg", "row updated successfully");
                $request->session()->flash("type", true);

                return redirect(url("dashboard/exams/show/{$exam->id}"));
            }

            -same as update in SkillController
            -img is nullabe as user choose to edit the old image or not

        admins/exams/index.blade.php:
            <a href="{{url("dashboard/exams/edit/{$exam->id}")}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>          
            
            -add link to get edit exam form blade

        admins/exams/edit.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Exam</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                            <li class="breadcrumb-item active">Edit Exam</li>
                            </ol>
                        </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 pb-3">

                                @include("admin.inc.errors")

                                <form  method="POST" action="{{url("dashboard/exams/update/{$exam->id}")}}" enctype="multipart/form-data">
                                    @csrf
                                    @method("put")
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label >Name (en)</label>
                                                <input type="text" name="name_en" class="form-control" value="{{$exam->name('en')}}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label >Name (ar)</label>
                                                <input type="text" name="name_ar" class="form-control" value="{{$exam->name('ar')}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label >Description (en)</label>
                                                <textarea rows="5" name="desc_en" class="form-control textarea" >{{$exam->desc('en')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label >Description (ar)</label>
                                                <textarea rows="5" name="desc_ar" class="form-control textarea">{{$exam->desc('ar')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            {{-- select options/dropdown menu of skills --}}
                                            <div class="form-group">
                                                <label>Skill</label>
                                                <select  class=" form-control select" name="skill_id">
                                                    @foreach ($skills as $skill)
                                                        <option value="{{$skill->id}}" @if($exam->skill_id == $skill->id) selected @endif>{{$skill->name('en')}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            {{-- upload file --}}
                                            <div class="form-group">
                                                <label >Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="img">
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label >Difficulty</label>
                                                <input type="number" name="difficulty" class="form-control" value="{{$exam->difficulty}}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label >Duration (mins.)</label>
                                                <input type="number" name="duration_mins" class="form-control" value="{{$exam->duration_mins}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -we made for for edit and filled it with old inputs:
                example:value = '{{$exam->name('ar')}}'
            -for select html , we selected old input like this:
                <select  class=" form-control select" name="skill_id">
                    @foreach ($skills as $skill)
                        <option value="{{$skill->id}}" @if($exam->skill_id == $skill->id) selected @endif>{{$skill->name('en')}} </option>
                    @endforeach
                </select>
            
    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    -Edit Certain exam  certain Question:
        web.php:
            Route::get("/exams/edit-question/{exam}/{question}", [AdminExamController::class, 'editQuestion']);
            
            Route::put("/exams/update-question/{exam}/{question}", [AdminExamController::class, 'updateQuestion']);

            -we added 2 routes:
                -one to get question edit form blade
                -ther other(put request) to update question in database

        Admin/ExamController.php:
            public function editQuestion(Exam $exam, Question $question){
                $data['exam'] = $exam;
                $data['question'] = $question;

                return view("admin.exams.edit-question")->with($data);
            }
            -get exam and question details

            public function updateQuestion(Exam $exam, Question $question, Request $request){
                $data = $request->validate([
                    "title" => "required|string|max:500",
                    "right_ans" => "required|in:1,2,3,4",
                    "option_1" => "required|string|max:255",
                    "option_2" => "required|string|max:255",
                    "option_3" => "required|string|max:255",
                    "option_4" => "required|string|max:255",
                ]);


                $question->update($data);

                return redirect(url("dashboard/exams/show-questions/{$exam->id}"));
            }

            -validate inputs and update database

        admin/exams/show-questions.blade.php:
            <a href="{{url("dashboard/exams/edit-questions/{$exam->id}/{$ques->id}")}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
        
        admin/exams/edit-questions.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit Question</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                            <li class="breadcrumb-item"><a href="{{url("/dashboard/exams/show/{$exam->id}")}}">{{$exam->name('en')}}</a></li>
                            <li class="breadcrumb-item active">Edit Question</li>
                            </ol>
                        </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 pb-3">

                                @include("admin.inc.errors")

                                <form  method="POST" action="{{url("dashboard/exams/update-question/{$exam->id}/{$question->id}")}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label >Title</label>
                                                    <input type="text" name="title" value="{{$question->title}}" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label >Right Ans.</label>
                                                    <input type="number" min="1" max="4" name="right_ans" value="{{$question->right_ans}}" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label >Option 1</label>
                                                    <input type="text" name="option_1" value="{{$question->option_1}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label >Option 2</label>
                                                    <input type="text" name="option_2" value="{{$question->option_2}}" class="form-control ">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label >Option 3</label>
                                                    <input type="text" name="option_3" value="{{$question->option_3}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label >Option 4</label>
                                                    <input type="text" name="option_4" value="{{$question->option_4}}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-success">Submit</button>

                                            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection

            -we made for to update question 
            -we got old input values

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Delete Exam with all its questions:
        web.php:
            Route::delete("/exams/delete/{exam}", [AdminExamController::class, 'delete']);


        Admin/ExamController.php:
            public function delete(Exam $exam , Request $request){
                try{
                    $path = $exam->img;
                    $exam->questions()->delete();
                    $exam->delete();
                    Storage::delete($path);
                    $msg = "row deleted successfully";
                    $type = true;
                }catch(Exception $e){
                    $msg = "Can't  delete this row";
                    $type = false;
                }

                $request->session()->flash("msg", $msg);
                $request->session()->flash("type", $type);

                return back();
            }

            -we will delete exam with its image and its questions
            -except if there are student who entered exam , so exam_user pivot table has records , so if we deleted exam it will give error as we made our database on delete null


        admin/exams/index.blade.php:
            <button type="submit" form="delete-form" class="btn btn-sm btn-danger" form="delete-form"><i class="fas fa-trash"></i></button>

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Toggle Exam Activity:
        web.php:
            Route::get("/exams/toggle/{exam}", [AdminExamController::class, 'toggle']);
        Admin/ExamController.php:
            public function toggle(Exam $exam){
                if($exam->questions_no == $exam->questions()->count()){
                    $exam->update([
                        'active' => !$exam->active,
                    ]);
                }

                return back();
            }

            -we will not toggle untill we make sure that:
                -questions_no of exam object sent is the same as the exam questions_no in database

        
        admin/exams/index.blade.php:
            <a href="{{url("dashboard/exams/toggle/{$exam->id}")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>

            -we made link to toggle exam active 

        
*/