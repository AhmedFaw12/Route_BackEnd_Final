<?php
/*
Students Module:
    Idea:
        -we want to display all students and show their scores and exams they have entered
        -if status is closed , we can open it
        -if status is opened , we can close it

    Display students:
        web.php:
            Route::get("/students", [StudentController::class, 'index']);

            -we made a route to display students

        Admin/StudentController.php:
            public function index(){
                $studentRole = Role::where('name', 'student')->first();
                $data["students"] = User::where("role_id", $studentRole->id)
                ->orderBy("id", "DESC")
                ->paginate(10);

                return view("admin.students.index")->with($data);
            }

            -we got all users who have role (student)
            -go to students index view

        Admin/layout.blade.php:
            {{-- students link --}}
            <li class="nav-item">
                <a href="{{url("/dashboard/students")}}" class="nav-link">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Students
                    </p>
                </a>
            </li>

            -we made a link that go to student index view

        admin/students/index.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Students</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Students</li>
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
                                        <div class="card-header">
                                            <h3 class="card-title">All Students</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">

                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Verified</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($students as $student)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$student->name}}</td>
                                                            <td>{{$student->email}}</td>

                                                            @if ($student->email_verified_at !== null)
                                                                <td><span class="badge bg-success">yes</span></td>
                                                            @else
                                                                <td><span class="badge  bg-danger">no</span></td>
                                                            @endif

                                                            <td>
                                                                <a href="{{url("/dashboard/students/show-scores/{$student->id}")}}" class="btn btn-sm btn-success">
                                                                    <i class="fas fa-percent"></i>
                                                                </a>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="d-flex my-3 justify-content-center">
                                                {{ $students->links() }}
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

            -we copied cat module view but changed names
            -we displayed name, email, verified or not , actions using foreach
            -we also displayed pagination view

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Show Scores Student:   
        web.php:
            Route::get("/students/show-scores/{id}", [StudentController::class, 'showScores']);
            
            -we made a route to show scores

        Admin/StudentController.php:
            public function showScores($id){
                $student = User::findOrFail($id);
                if($student->role->name !== 'student'){
                    return back();
                }
                $data['student'] = $student;
                $data['exams'] = $student->exams()->paginate(10);

                return view('admin.students.show-scores')->with($data);
            }

            -we will get student from id and make sure it is a student
            -we will get all exams for this student paginated
            -go to show-scores view

        admin/students/index.blade.php:
            <td>
                <a href="{{url("/dashboard/students/show-scores/{$student->id}")}}" class="btn btn-sm btn-success">
                    <i class="fas fa-percent"></i>
                </a>
            </td>

            -we made a link to show-scores view

        admin/students/show-scores.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Show Scores {{$student->name}}</h1>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Show Scores {{$student->name}}</li>
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
                                        <div class="card-header">
                                            <h3 class="card-title">Scores</h3>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Exam</th>
                                                        <th>Score</th>
                                                        <th>Time (mins)</th>
                                                        <th>At</th>
                                                        <th>status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($exams as $exam)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$exam->name('en')}}</td>
                                                            <td>{{$exam->pivot->score}}</td>
                                                            <td>{{$exam->pivot->time_mins}}</td>
                                                            <td>{{Carbon\Carbon::parse($exam->pivot->created_at)->format('Y M d/ h:i:s A')}}</td>

                                                            @if ($exam->pivot->status === 'opened')
                                                                <td><span class="badge bg-success">opened</span></td>
                                                            @else
                                                                <td><span class="badge  bg-danger">closed</span></td>
                                                            @endif

                                                            <td>
                                                                @if($exam->pivot->status === "closed")
                                                                    <a href="{{url("/dashboard/students/open-exam/{$student->id}/{$exam->id}")}}" class="btn btn-sm btn-success">
                                                                        <i class="fas fa-lock-open"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{url("/dashboard/students/close-exam/{$student->id}/{$exam->id}")}}" class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-lock"></i>
                                                                    </a>
                                                                @endif
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

            
            -we copied index.blade.php to show-scores.blade.php
            -we changed names
            -we displayed exam name, score, submitted at, time mins, status using foreach
            -we displayed exams paginated

    -----------------------------------------------------------------------------------------------------------------
    -----------------------------------------------------------------------------------------------------------------


    open/close Exam:
        admin/students/show-scores.blade.php:
            <td>
                @if($exam->pivot->status === "closed")
                    <a href="{{url("/dashboard/students/open-exam/{$student->id}/{$exam->id}")}}" class="btn btn-sm btn-success">
                        <i class="fas fa-lock-open"></i>
                    </a>
                @else
                    <a href="{{url("/dashboard/students/close-exam/{$student->id}/{$exam->id}")}}" class="btn btn-sm btn-danger">
                        <i class="fas fa-lock"></i>
                    </a>
                @endif
            </td>

            -we made a link to open exam and appear only if exam is closed
            -we made a link to close exam and appear only if exam is opened
        
        web.php:
            Route::get("/students/open-exam/{studentId}/{ExamId}", [StudentController::class, 'openExam']);
            Route::get("/students/close-exam/{studentId}/{ExamId}", [StudentController::class, 'closeExam']);
            
            -we made 2 routes to open/close exam
            -we could have made toggle route to open/close , but we wanted to try another idea


        Admin/StudentController.php:
                public function openExam($studentId, $examId){
                    $student = User::findOrFail($studentId);

                    if($student->role->name !== 'student' && !$student->exams->contains($examId)){
                        return back();
                    }

                    $student->exams()->updateExistingPivot($examId, [
                        'status' =>"opened"
                    ]);

                    return back();
                }

                -we get student and make sure that user is student
                -also make sure that student has taken exam with examId
                -change status to opened

                public function closeExam($studentId, $examId){
                    $student = User::findOrFail($studentId);

                    if($student->role->name !== 'student' && !$student->exams->contains($examId)){
                        return back();
                    }

                    $student->exams()->updateExistingPivot($examId, [
                        'status' =>"closed"
                    ]);

                    return back();
                }
    
                -we get student and make sure that user is student
                -also make sure that student has taken exam with examId
                -change status to closed
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Admin Module:
    Idea:
        -any admins(admin/superadmin) can enter dashboard
        -super admin can see admins module to add/delete admins
        -so we need to protect super admin in UI(show) and backend using middleware
    
   
    display admins:
        web.php:
            Route::middleware('superadmin')->group(function(){
                Route::get("/admins", [AdminController::class, 'index']);
            }
            
            -we made a route to show admins and superadmins
            -only superadmins can enter this route , so we applied superadmin middleware

        Admin/AdminController.php:
            public function index(){
                $superAdminRole = Role::where('name', 'superadmin')->first();
                $adminRole = Role::where('name', 'admin')->first();

                $data["admins"] = User::whereIn("role_id", [$superAdminRole->id, $adminRole->id])
                ->orderBy("id", "DESC")
                ->paginate(10);

                return view("admin.admins.index")->with($data);
            }

            -we will get all admins and superadmins
            -we used whereIn :to choose between multiple options (admin or superadmin)
            -we paginated admins
            -go to admins/index view

        admin/layout.blade.php:
            {{-- admins link --}}
            @if(Auth::user()->role->name == "superadmin")
                <li class="nav-item">
                    <a href="{{url("/dashboard/admins")}}" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Admins
                        </p>
                    </a>
                </li>
            @endif

            -we added a link to the admins index view in the layout
            
        admin/admins/index.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Admins</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Admins</li>
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
                                        <div class="card-header">
                                            <h3 class="card-title">All Admins</h3>

                                            <div class="card-tools">
                                                <a href="{{url("/dashboard/admins/create")}}" class="btn btn-sm btn-primary" >Add New Admin</a>
                                            </div>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">

                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th>Verified</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($admins as $admin)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$admin->name}}</td>
                                                            <td>{{$admin->email}}</td>
                                                            <td>{{$admin->role->name}}</td>

                                                            @if ($admin->email_verified_at !== null)
                                                                <td><span class="badge bg-success">yes</span></td>
                                                            @else
                                                                <td><span class="badge  bg-danger">no</span></td>
                                                            @endif

                                                            <td>
                                                                <a href="{{url("dashboard/admins/delete/{$admin->id}")}}"  class = "btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>


                                                                @if($admin->role->name === "admin")
                                                                    <a href="{{url("/dashboard/admins/promote/{$admin->id}")}}" class="btn btn-sm btn-success">
                                                                        <i class="fas fa-level-up-alt"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{url("/dashboard/admins/demote/{$admin->id}")}}" class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-level-down-alt"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="d-flex my-3 justify-content-center">
                                                {{ $admins->links() }}
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

            -we made a view to display admins and superadmins
            -we displayed admins name, email , verified or not, role, actions using foreach

            -we displayed pagination

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    Create/Add admins:
        web.php:
            Route::middleware('superadmin')->group(function(){
                Route::get("/admins/create", [AdminController::class, 'create']);
                Route::post("/admins/store", [AdminController::class, 'store']);
            });

            -we added 2 route to create new admin:
                -one to get create new admin form view(get request)
                -the other one what to do after we submit form(post request)

        Admin/AdminController.php:
            use Illuminate\Auth\Events\Registered;
            
            public function create(){
                $data["roles"] = Role::select('name', 'id')
                ->whereIn('name', ['admin', 'superadmin'])
                ->get();

                return view("admin.admins.create")->with($data);
            }

            -we return add new admin view.
            -and we send roles(admin , superadmin) to it, so that we can choose the role of the new admin from the form

            public function store(Request $request){
                $request->validate([
                    'name' => "required|string|max:255",
                    'email' => "required|email|max:255",
                    'password' => "required|string|min:5|max:25|confirmed",
                    'role_id' =>"required|exists:roles,id",
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' =>$request->role_id,
                ]);

                event(new Registered($user));

                return redirect(url("/dashboard/admins"));
            }

            -we validated inputs
            -we created user in database
            -we must send verification email to the new user
            -when we were using fortify register, it sends verification email automatically
            -but since we are here not using fortify register and we are manually register, we must fire an event to send verification email
            
            -If you are manually implementing registration within your application instead of using a starter kit, you should ensure that you are dispatching the Illuminate\Auth\Events\Registered event after a user's registration is successful:
                use Illuminate\Auth\Events\Registered;
 
                event(new Registered($user));

            
        admin/admins/index.blade.php:
            <div class="card-tools">
                <a href="{{url("/dashboard/admins/create")}}" class="btn btn-sm btn-primary" >Add New Admin</a>
            </div>

            -we added a link to go to create new admin form view

    
        admin/admins/create.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Admins</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Admins</li>
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
                                        @include("admin.inc.errors")

                                        <form  method="POST" action="{{url('dashboard/admins/store')}}">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label >Name</label>
                                                            <input type="text" name="name" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label >Email</label>
                                                            <input type="email" name="email" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label >Password</label>
                                                            <input type="password" name="password" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label >Confirm Password</label>
                                                            <input type="password" name="password_confirmation" class="form-control" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        {{-- select options/dropdown menu of roles --}}
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select class="form-control" name="role_id">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-success">submit</button>
                                                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                                </div>
                                            </div>
                                        </form>

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

            -we made a post form to add/register new admin
            -inputs are :name, email, password, role , password_confirmation
            -@include("admin.inc.errors"): to display errors of validations
            url()->previous():Get the full URL for the previous request

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Delete admins:
        web.php:
            Route::middleware('superadmin')->group(function(){
                Route::get("/admins/delete/{id}", [AdminController::class, 'delete']);
            });
            -we made a route for delete

        admin/admins/index.blade.php:
            <a href="{{url("dashboard/admins/delete/{$admin->id}")}}"  class = "btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
            
            -we made a link for delete

        Admin/AdminController.php:
            public function delete($id){
                $admin = User::findOrFail($id);
                $admin->delete();
                return back();
            }

            -we delete from database

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Promote and Demote admins:
        web.php:
            Route::middleware('superadmin')->group(function(){
                Route::get("/admins/promote/{id}", [AdminController::class, 'promote']);
                Route::get("/admins/demote/{id}", [AdminController::class, 'demote']);
            });
            
            -we added 2 route for promote and demote

        Admin/AdminController.php:
            //admin to superadmin
            public function promote($id){
                $admin = User::findOrFail($id);
                $superAdminRole = Role::select('id')->where('name', 'superadmin')->first();
                $admin->update([
                    'role_id' =>$superAdminRole->id,
                ]);

                return back();
            }

            -we promote admin to superadmin

            //superadmin to admin
            public function demote($id){
                $admin = User::findOrFail($id);
                $adminRole = Role::select('id')->where('name', 'admin')->first();
                $admin->update([
                    'role_id' =>$adminRole->id,
                ]);

                return back();
            }

            -we demote superadmin to admin

        admin/admins/index.blade.php:
            @if($admin->role->name === "admin")
                <a href="{{url("/dashboard/admins/promote/{$admin->id}")}}" class="btn btn-sm btn-success">
                    <i class="fas fa-level-up-alt"></i>
                </a>
            @else
                <a href="{{url("/dashboard/admins/demote/{$admin->id}")}}" class="btn btn-sm btn-danger">
                    <i class="fas fa-level-down-alt"></i>
                </a>
            @endif


            -we addded promote adn demote links 
            -promote will appear incase we have admins
            -demote will appear incase we have superadmins

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
Verification Email when Registering Manually:

    -we must send verification email to the new user , so new user/admin can access some pages



    -we are using fortify verification email

    -user model must implements mustVerifyEmail interface

    -while we were using fortify register, it sends verification email automatically
    -but since we are here not using fortify register and we are manually register, we must fire an event to send verification email
    
    -If you are manually implementing registration within your application instead of using a starter kit(like :fortify), you should ensure that you are dispatching the Illuminate\Auth\Events\Registered event after a user's registration is successful:

    use Illuminate\Auth\Events\Registered;
    
    event(new Registered($user));
--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

url()->previous(): get full url of previous request


*/