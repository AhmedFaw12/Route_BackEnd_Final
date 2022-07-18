<?php
/*
Categories Module:
    -we want to make crud for categories (display, create, delete, update)
    
    Display Categories:
        -web.php:
            Route::get("/categories", [AdminCatController::class, 'index']);

            -we added route to go to CatController to display view

        admin/layout.blade.php:
            <li class="nav-item">
                <a href="{{url("/dashboard/categories")}}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Categories
                    </p>
                </a>
            </li>

            -we added Categories link to display admin/categories page/view
            -we made list icon from font awesome  for our link:
                <i class="nav-icon fas fa-list"></i>

        Admin/CatController.php:
            public function index(){
                // $data["cats"] = Cat::get();
                $data["cats"] = Cat::orderBy('id', "DESC")->paginate(10);
                return view("admin.cats.index")->with($data);
            }
            
            -we get all cats and paginate them
            -and send cats to cats/index.blade.php
            -we ordered cats by id descendingly


        Providers/AppServiceProvider.php:
            public function boot()
            {
                Paginator::useBootstrap();
            }

            -we make laravel pagination use bootstrap
            -as we will use laravel pagination view

        
        admin/cats/index.blade.php:
            @extends('admin.layout')
            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Categories</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Categories</li>
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
                                            <h3 class="card-title">All Categories</h3>
                                            <div class="card-tools">
                                                {{-- <div class="input-group input-group-sm" style="width: 150px;">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div> --}}

                                                <a href="#" class="btn btn-sm btn-primary">Add New Category</a>
                                            </div>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name (en)</th>
                                                        <th>Name (ar)</th>
                                                        <th>Active</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($cats as $cat)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$cat->name('en')}}</td>
                                                            <td>{{$cat->name('ar')}}</td>
                                                            @if ($cat->active)
                                                                <td><span class="badge bg-success">yes</span></td>
                                                            @else
                                                                <td><span class="badge  bg-danger">no</span></td>
                                                            @endif

                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

                                                                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>


                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="d-flex my-3 justify-content-center">
                                                {{$cats->links()}}
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

            -we copied  content-wrapper from admin/home/index.blade.php
            -we will put a table inside wrapper
            -we will search for a good table design
            -go to https://adminlte.io/themes/v3/pages/tables

            -we took simple table with responsive design
            we will display in table name ar, name en, active, action
            
            -we displayed all categories using foreach
            -we made 2 buttons/links for edit and delete:
                <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
            
            -we displayed active as green box with yes and red box with no:
                @if ($cat->active)
                    <td><span class="badge bg-success">yes</span></td>
                @else
                    <td><span class="badge  bg-danger">no</span></td>
                @endif
                -we displayed active as badge component from bootstrap

            -we will display name in en and ar without session:
                <td>{{$cat->name('en')}}</td>
                <td>{{$cat->name('ar')}}</td>

                -since we made function in Cat model with parameter to determine the lang we want:
                    Cat Model:
                        public function name($lang = null){
                            $lang = $lang ?? App::getLocale();
                            return json_decode($this->name)->$lang;
                        }
            -we will display index starting from 1 using laravel loop variable:
                <td>{{$loop->iteration}}</td>
            
            -we displayed pagination:
                <div class="d-flex justify-content-center">
                    {{$cats->links()}}
                </div>

                and centered it at middle of page

    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Create(add new) Category:
        -we want add new button to show modal div(pop up) in the same page which contains the form

        -so this way we will only make one route (post request of submit form)
        -we don't need the get route to get form page 

        -we will search for a modal from https://adminlte.io/themes/v3/pages/UI/modals.html:
            -there is a button that display model when we click on it
            -and there is the modal div (we will copy modal code)
        
        admin/Cats/index.blade.php:

            @include("admin.inc.messages")

            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target = "#add-modal">Add New Category</button>

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
                            <form id="add-form" method="POST" action="{{url('dashboard/categories/store')}}">
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


            -we copied modal div from https://adminlte.io/themes/v3/pages/UI/modals.html

            -we left modal-body for form of create category

            we copied a form from https://adminlte.io/themes/v3/pages/forms/general.html

            -we added 2 inputs name_ar, name_en

            -form will be post request and go to dashboard/categories/store


            -we changed save changes button to submit button and made it submit button and 

            -we gave form an id and made button relate to it using form attribute

            -to make modal div appear , we gave it an id , make add new link a button:
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target = "#add-modal">Add New Category</button>
                
                -we added data-toggle="modal"  data-target = "#add-modal" attributes to tell button to show the modal

            -we displayed session messages:
                @include("admin.inc.messages")

        CatController.php:
            public function store(Request $request){
                $request->validate([
                    'name_ar' => "required|string|max:50",
                    'name_en' => "required|string|max:50",
                ]);

                Cat::create([
                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                ]);
                $request->session()->flash("msg", "row added successfully");
                $type = true;
                $request->session()->flash("type", "$type");


                return back();
            }
            
            -we validated inputs
            -we created record using json_encode
            -then return back to same page
        
        views/admin/inc/messages.blade.php:
            @if(session("msg"))
                @if(session("type"))
                    <div class="alert alert-success">
                        {{session("msg")}}
                    </div>
                @else
                    <div class="alert alert-danger">
                        {{session("msg")}}
                    </div>
                @endif
            @endif

        

        web.php:
            Route::get("/categories/store", [AdminCatController::class, 'store']);
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    Delete Category:
        web.php:
            Route::delete("/categories/store/{cat}", [AdminCatController::class, 'delete']);

            -delete is a delete method 

        views/admin/cats/index.blade.php:
            <form id="delete-form" action="{{url("/dashboard/categories/delete/$cat->id")}}" method="POST" style="display:none">
                @csrf
                @method("delete")
            </form>
            <button  type="submit" form="delete-form" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

        Admin/CatController.php:
            public function delete(Cat $cat, Request $request){

                try {
                    $cat->delete();
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
            -some cats has skills
            -so if we deleted cats ,this will give error
            -because we made tables in database on delete restricted
            -so we will make try catch and flash a session msg to user

    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    Update Category:
        web.php:
            Route::put("/categories/update", [AdminCatController::class, 'update']);

            -we will make one put route for update
            -we don't need to get update page as it is a modal in the same page of edit button
            -we will send id as a hidden input in the edit form


        views/admin/cats/index.blade.php:
            <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-id="{{$cat->id}}" data-name-en = "{{$cat->name('en')}}" data-name-ar = "{{$cat->name('ar')}}" data-target = "#edit-modal"><i class="fas fa-edit"></i></button>    

            -we made a button to type button and data-toggle="modal" and data-target = "#edit-modal" to show edit form modal

            -we also want to send old values  to the form using data attributes (feature in html that allow me to send variables as attributes):
                data-id="{{$cat->id}}" 
                data-name-en = "{{$cat->name('en')}}" 
                data-name-ar = "{{$cat->name('ar')}}"


            <!-- Edit Modal -->
            <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-form" method="POST" action="{{url('dashboard/categories/update')}}">
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

            -we copied form modal(create) div to edit modal
            -form method is put:
                <form id="edit-form" method="POST" action="{{url('dashboard/categories/update')}}">
                    @csrf
                    @method("put")
                </form>

            -we will make id input hidden to send id
            -we gave inputs ids so that we can fill them using script
            

            @section('scripts')
                <script>
                    $('.edit-btn').click(function(){
                        let id = $(this).attr('data-id');
                        let nameEn = $(this).attr('data-name-en');
                        let nameAr = $(this).attr('data-name-ar');

                        $("#edit-form-id").val(id);
                        $("#edit-form-name-en").val(nameEn);
                        $("#edit-form-name-ar").val(nameAr);
                    });
                </script>
            @endsection
            
            -we wrote a script so when we click on edit-btn , script will get old values and fill the edit form with these values so that we can change/edit these values 

        
        Admin/CatController.php:
            public function update(Request $request){

                $request->validate([
                    'id' => "required|exists:cats,id",
                    'name_ar' => "required|string|max:50",
                    'name_en' => "required|string|max:50",
                ]);

                Cat::findOrFail($request->id)->update([

                    'name' => json_encode([
                        'en' => $request->name_en,
                        'ar' => $request->name_ar,
                    ]),
                ]);
                $request->session()->flash("msg", "row updated successfully");
                $type = true;
                $request->session()->flash("type", "$type");
                return back();
            }

            -we will check if id exists in table cats in column id
            -update row
            -flash a msg of success in session



    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Toggle Active:
        Admin/CatController.php:
            public function toggle(Cat $cat){
                $cat->update([
                    'active' => !$cat->active,
                ]);

                return back();
            }
        web.php:
            Route::get("/categories/toggle/{cat}", [AdminCatController::class, 'toggle']);

        index.blade.php:
            <a href="{{url("/dashboard/categories/toggle/$cat->id ")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>


        

        
    
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

Loop Variable in Laravel:
    While iterating through a foreach loop, a $loop variable will be available inside of your loop. This variable provides access to some useful bits of information such as the current loop index and whether this is the first or last iteration through the loop:

    -$loop->index: The index of the current loop iteration (starts at 0).
    -$loop->iteration: The current loop iteration (starts at 1).
    
--------------------------------------------------------------------------------------------------------------------------------------------------------------------

Route Model Binding:
    When injecting a model ID to a route or controller action, you will often query the database to retrieve the model that corresponds to that ID. Laravel route model binding provides a convenient way to automatically inject the model instances directly into your routes. For example, instead of injecting a user's ID, you can inject the entire User model instance that matches the given ID.

    Implicit Binding
        Laravel automatically resolves Eloquent models defined in routes or controller actions whose type-hinted variable names match a route segment name. For example:

        use App\Models\User;
        
        Route::get('/users/{user}', function (User $user) {
            return $user->email;
        });


        Since the $user variable is type-hinted as the App\Models\User Eloquent model and the variable name matches the {user} URI segment, Laravel will automatically inject the model instance that has an ID matching the corresponding value from the request URI. If a matching model instance is not found in the database, a 404 HTTP response will automatically be generated.

        Of course, implicit binding is also possible when using controller methods. Again, note the {user} URI segment matches the $user variable in the controller which contains an App\Models\User type-hint:        
        
        use App\Http\Controllers\UserController;
        use App\Models\User;
        
        // Route definition...
        Route::get('/users/{user}', [UserController::class, 'show']);
        
        // Controller method definition...
        public function show(User $user)
        {
            return view('user.profile', ['user' => $user]);
        }        
--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Html data attribute:    
    HTML5 is designed with extensibility in mind for data that should be associated with a particular element but need not have any defined meaning. data-* attributes allow us to store extra information on standard, semantic HTML elements without other hacks such as non-standard attributes, or extra properties on DOM.

    The syntax is simple. Any attribute on any element whose attribute name starts with data- is a data attribute. Say you have an article and you want to store some extra information that doesn't have any visual representation. Just use data attributes for that:

    example:
        <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-id="{{$cat->id}}" data-name-en = "{{$cat->name('en')}}" data-name-ar = "{{$cat->name('ar')}}" data-target = "#edit-modal"><i class="fas fa-edit"></i></button>    


*/