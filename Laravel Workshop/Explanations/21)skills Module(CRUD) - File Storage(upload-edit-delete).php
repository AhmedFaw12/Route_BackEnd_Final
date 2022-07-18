<?php
/*
Skills Module:
    Display :
        layout.blade.php:
             <li class="nav-item">
                <a href="{{url("/dashboard/skills")}}" class="nav-link">
                    <i class="nav-icon fas fa-brain"></i>
                    <p>
                        Skills
                    </p>
                </a>
            </li>
            -we added link to skills view in side bar
        
        web.php:
            Route::get("/skills", [AdminSkillController::class, 'index']);

            -we added route to display skills

        Admin/SkillController.php:
            public function index(){
                $data["skills"] = Skill::orderBy('id', "DESC")->paginate(10);
                $data["cats"] = Cat::select('id', 'name')->get();
                return view("admin.skills.index")->with($data);
            }

            -we will get all skills paginated and send them to skills index view to be displayed

            -we get all cats to be used later for add & edit skills

        admin/skills/index.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Skills</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Skills</li>
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
                                            <h3 class="card-title">All Skills</h3>

                                            <div class="card-tools">

                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target = "#add-modal">Add New Skill</button>
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
                                                        <th>Category</th>
                                                        <th>Active</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($skills as $skill)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$skill->name('en')}}<td>
                                                            <td>{{$skill->name('ar')}}<td>
                                                            <td>
                                                                <img height="50px" src="{{asset("uploads/$skill->img")}}" alt="skill img">
                                                            </td>  
                                                            <td>{{$skill->cat->name('en')}}</td>
                                                            @if ($skill->active)
                                                                <td><span class="badge bg-success">yes</span></td>
                                                            @else
                                                                <td><span class="badge  bg-danger">no</span></td>
                                                            @endif

                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-id="{{$skill->id}}" data-name-en = "{{$skill->name('en')}}" data-name-ar = "{{$skill->name('ar')}}" data-img="{{$skill->img}}"  data-cat-id = "{{$skill->cat->id}}" data-target = "#edit-modal"><i class="fas fa-edit"></i></button>

                                                                <form id="delete-form" action="{{url("/dashboard/skills/store/$skill->id")}}" method="POST" style="display:none">
                                                                    @csrf
                                                                    @method("delete")
                                                                </form>
                                                                <button  type="submit" form="delete-form" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                                                                <a href="{{url("/dashboard/skills/toggle/$skill->id ")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="d-flex my-3 justify-content-center">
                                                {{$skills->links()}}
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

            -we copied cat index view to skills index view
            -we changed cat words to skill words

            -we displayed in table:
                -id, name en , name ar, img, category name, active as red or greed box, actions buttons(edit, delete, toggle) 
                
                -we displayed them using foreach
                -we display image:
                    <td>
                        <img height="50px" src="{{asset("uploads/$skill->img")}}" alt="skill img">
                    </td>    
            
            -we displayed pagination:
                <div class="d-flex my-3 justify-content-center">
                    {{$skills->links()}}
                </div>
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


    Add New Skill:
        web.php:
            Route::post("/skills/store", [AdminSkillController::class, 'store']);
            
            -we added route to create/store skill

        config/filesystems.php:
            'default' => env('FILESYSTEM_DISK', 'uploads'),
            'disks' => [
                'local' => [
                    'driver' => 'local',
                    'root' => storage_path('app'),
                    'throw' => false,
                ],

                'uploads' => [
                    'driver' => 'local',
                    'root' => public_path('uploads'),
                    'throw' => false,
                ],

                'public' => [
                    'driver' => 'local',
                    'root' => storage_path('app/public'),
                    'url' => env('APP_URL').'/storage',
                    'visibility' => 'public',
                    'throw' => false,
                ],
                //
            ]

            -in add new skill , we are going to upload image/file
            -laravel by default store uploaded images in storage using Storage class
            -storage is a folder inside laravel

            -inside storage/app/public is the public storage
            -outside public but inside storage/app is the local storage

            -if we stored in storage using storage class , we can not use asset() function
            -to use asset function :
                -we have to write : php artisan storage:link 
                -which creates symbolic link/shortcut for storage folder inside public folder , so that we can use asset() function

            
            -we made an uploads folder inside public folder and we want to use it
            -we can make our own storage disk other than public storage or local storage
            -we can write a new disk:
                'uploads' => [
                    'driver' => 'local',
                    'root' => public_path('uploads'),
                    'throw' => false,
                ],

                public_path():return path to public folder
                public_path("uploads"):return path to public/uploads folder
            
            -then we tell that uploads storage is our default storage:
                'default' => env('FILESYSTEM_DISK', 'uploads'),
                -sometimes this line don't work
                -so we have to go to .env and write it manually : FILESYSTEM_DISK=uploads

                -or when we use Storage class we have to determine disk manually:
                    // $path = Storage::disk('uploads')->putFile("skills", $request->file('img'));//return path of image


            -since our storage is uploads folder which is in public folder , we don't need to make a symbolic link for storage folder
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        SkillController.php:
            public function store(Request $request){
                $request->validate([
                    'name_ar' => "required|string|max:50",
                    'name_en' => "required|string|max:50",
                    'img' =>"required|image|mimes:png,jpg|max:2048",//2048kB = 2MB
                    'cat_id' => "required|exists:cats,id",
                ]);

                $path = Storage::putFile("skills", $request->file('img'));//return path of image

                Cat::create([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                    'img' =>$path,
                    'cat_id' => $request->cat_id,
                ]);
                $request->session()->flash("msg", "row added successfully");
                $type = true;
                $request->session()->flash("type", "$type");
                return back();
            }
            
            -we validate inputs
            -we validate img as: 
                image type, 
                mimes:png, jpg  --> image must be (.png or .jpg)
                max:2048",//2048kB = 2MB  -->image size = 2MB

            -we use Storage class with putFile() to store image in uploads folder:

                -$path = Storage::putFile("skills", $request->file('img'));//return path of image

                - putFile takes destination folder and img file
                -putFile name the image and return the path of the image

                -save image , name, cat_id in database
                -save msg in session


        errors.blade.php:
            {{-- these errors will be displayed above forms inside modals --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

            -we made blade for errors to be displayed above forms inside modals
        
        admin/skills/index.blade.php:
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target = "#add-modal">Add New Skill</button>
            
            <!-- Add new Category Modal -->
            <div class="modal fade" id="add-modal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add new</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @include("admin.inc.errors")

                            <form id="add-form" method="POST" action="{{url('dashboard/skills/store')}}" enctype="multipart/form-data">
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
                                            <input type="text" name="name_ar" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        {{-- select options/dropdown menu of categories --}}
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="cat_id">
                                                @foreach ($cats as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
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
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.Add new Category Modal -->
        

            -we copied add modal from cats/index.blade.php to skills/index.blade.php
            -we changed names to skills
            -@include("admin.inc.errors") : to display error above form
            -form contains inputs for name_ar , name_en

            -we will add two new inputs : 
                -select option to choose category for skill
                -input file to upload image
            
            -don't forget form must have :
                enctype="multipart/form-data"
                -so that we can upload image
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------


    Delete Skill:
        web.php:
            Route::delete("/skills/delete/{skill}", [AdminSkillController::class, 'delete']);

            -we added route for delete 
            -delete process takes delete method/request

        admin/skills/index.blade.php:
            <form id="delete-form" action="{{url("/dashboard/skills/delete/$skill->id")}}" method="POST" style="display:none">
                @csrf
                @method("delete")
            </form>
            <button  type="submit" form="delete-form" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            
            -we added a submit button for delete form and related button to the form using form attribute
            
            -we made method delete for delete form

            
        
        Admin/SkillController.php:
            public function delete(Skill $skill, Request $request){
                try {
                    $path = $skill->img;
                    $skill->delete();
                    Storage::delete($path);
                    $msg = "row deleted successfully";
                    $type = true;
                } catch (Exception $e) {
                    $msg = "can't delete this row";
                    $type = false;
                }

                $request->session()->flash("msg", "$msg");
                $request->session()->flash("type", "$type");
                return back();
            }
                
            -some skills can't be delete because they have exams under them 
            -our database is on delete restricted
            -we will try and catch
            
            -if we can delete record from database , we can delete img from uploads folder:
                $path = $skill->img;
                $skill->delete();
                Storage::delete($path);

            if $skill->delete(); didn't execute , then Storage::delete($path); won't be executed

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------


    Update/Edit Skill:
        web.php:
            Route::put("/skills/update", [AdminSkillController::class, 'update']);

        

        SkillController.php:
            public function update(Request $request){
                $request->validate([
                    'id' => "required|exists:skills,id",
                    'name_ar' => "required|string|max:50",
                    'name_en' => "required|string|max:50",
                    'img' => "nullable|image|mimes:png,jpg|max:2048",
                    'cat_id' => "required|exists:cats,id",
                ]);

                $skill =Skill::findOrFail($request->id);
                $path = $skill->img;
                if($request->hasFile('img')){
                    Storage::delete($path);
                    $path = Storage::putFile("skills", $request->file('img'));
                }


                $skill->update([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                    'img' => $path,
                    'cat_id' => $request->cat_id,
                ]);

                $request->session()->flash("msg", "row updated successfully");
                $type = true;
                $request->session()->flash("type", "$type");

                return back();
            }

            -validate inputs
            -image here can be nullable since user don't have to add new/edit image

            -if user enter new image, then we delete old image ,and we save new image in uploads folder:
                $skill =Skill::findOrFail($request->id);
                $path = $skill->img;
                if($request->hasFile('img')){
                    Storage::delete($path);
                    $path = Storage::putFile("skills", $request->file('img'));
                }

            -save inputs in database

    
        admin/skills/index.blade.php:
            <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-id="{{$skill->id}}" data-name-en = "{{$skill->name('en')}}" data-name-ar = "{{$skill->name('ar')}}" data-img="{{$skill->img}}"  data-cat-id = "{{$skill->cat->id}}" data-target = "#edit-modal"><i class="fas fa-edit"></i></button>

            <!-- Edit Modal -->
            <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Skill</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @include("admin.inc.errors")

                            <form id="edit-form" method="POST" action="{{url('dashboard/skills/update')}}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <input type="hidden" name="id" id="edit-form-id">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Name (en)</label>
                                            <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Name (ar)</label>
                                            <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        {{-- select options/dropdown menu of categories --}}
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="cat_id" id="edit-form-cat-id">
                                                @foreach ($cats as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name('en')}}</option>
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

                                        {{-- <img src="" id="edit" alt=""> --}}
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.Edit Modal -->
    
            
            @section('scripts')
                <script>
                    $('.edit-btn').click(function(){
                        let id = $(this).attr('data-id');
                        let nameEn = $(this).attr('data-name-en');
                        let nameAr = $(this).attr('data-name-ar');
                        // let img = $(this).attr('data-img');
                        let catId = $(this).attr('data-cat-id');

                        $("#edit-form-id").val(id);
                        $("#edit-form-name-en").val(nameEn);
                        $("#edit-form-name-ar").val(nameAr);
                        $("#edit-form-cat-id").val(catId);

                    });
                </script>
            @endsection
            

            -we have edit modal div 
            -we have edit button that displays modal when we click on it
            -we passed old inputs values except image as data attributes in the button

            -we will fill form with these old values using script

            -we made edit form inside edit modal
            -method will be put
            -user can enter new image or not


    ----------------------------------------------------------------------------------------------------------------------------------------------------------------

    Toggle Active:
        web.php:
            Route::get("/skills/toggle/{skill}", [AdminSkillController::class, 'toggle']);

        Admin/SkillController.php:
            public function toggle(Skill $skill){
                $skill->update([
                    'active' => !$skill->active,
                ]);

                return back();
            }
        
        admin/skills/index.blade.php:
            <a href="{{url("/dashboard/skills/toggle/$skill->id ")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
*/

