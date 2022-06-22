<?php
/*
CRUD operations continue in Department Controller:
    -Create() : will be used to show Create form 
    -Update(), edit():update record/operation
    -Crud operations are called resources functions
///////////////////////////////////////////////////////////////////////////////////////////////////

Route Resource:
    -instead of making/writing Route for every crud/resource operation 
    -There is line of Code that create 7 Routes for the 7 crud operations:
        Example:
            Route::resource('department', DepartmentController::class);
    
    -There is a Command to show what routes are created:
        php artisan route:list
    
    -what routes are created:
        GET|HEAD      deptartment ...................... deptartment.index › DepartmentController@index
        POST          deptartment .................... deptartment.store › DepartmentController@store
        GET|HEAD      deptartment/create ............. deptartment.create › DepartmentController@create
        GET|HEAD      deptartment/{deptartment} ...... deptartment.show › DepartmentController@show
        PUT|PATCH     deptartment/{deptartment} ...... deptartment.update › DepartmentController@update
        DELETE        deptartment/{deptartment} ...... deptartment.destroy › DepartmentController@destroy
        GET|HEAD      deptartment/{deptartment}/edit . deptartment.edit › DepartmentController@edit
        GET|HEAD      sanctum/csrf-cookie ............ Laravel\Sanctum › CsrfCookieController@show
    
    -Partial Resource Routes:
        When declaring a resource route, you may specify a subset of actions the controller should handle instead of the full set of default actions:

            Example1 using only(what routes will be created):
                Route::resource('photos', PhotoController::class)->only(['index', 'show']);
            
            Example 2 using except(What routes will not be created):
                Route::resource('photos', PhotoController::class)->except(['create', 'store', 'update']);

    -You may even register many resource controllers at once by passing an array to the resources method:
        Example:
            Route::resources([
                'photos' => PhotoController::class,
                'posts' => PostController::class,
            ]);

------------------------------------------------------------------------------------------------------------
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
-Blades:
    -what are blade templates?
           - Blade is the simple, yet powerful templating engine that is included with Laravel. Unlike some PHP templating engines, Blade does not restrict you from using plain PHP code in your templates. In fact, all Blade templates are compiled into plain PHP code and cached until they are modified, meaning Blade adds essentially zero overhead to your application. Blade template files use the .blade.php file extension and are typically stored in the resources/views directory.

           -no need to write <?php ?>
           -easy display variable
           -easy directives
    
    -we want to send to view named departments all departments in a depts variable:
        example:
            DepartmentController:
                public function index()
                {
                    return view("departments", ["depts"=>Department::all()]);
                }
        
        how to take a template and where to put it?
            -we need to create view, so we will create view  for example called (master.blade.php)


            -since we will create multiple views and they will have common parts like :navbar ,....
            -we will search for a template in bootstrap examples
            -we will take dashboard example , we also needs its assets folder
            -dashboard folder contain some resources files , we will put them in the assets
            -we will take the assets folder and put it temporarily in our project in folder called (public)
            -any external resources i want to refer to , put them in the (public) folder because it contains the index.php
            
            -we will copy dashboard index.html code into master.blade.php
            -to echo 
        --------------------------------------------------------------------------------------------------
        Displaying Data in Blades:
                You may display data that is passed to your Blade views by wrapping the variable in curly braces. For example, given the following route:
                    <h1>Hello, {{ $name }}</h1>
        
        --------------------------------------------------------------------------------------------------
        Commenting in Blades:
            {{-- my comment --}}
        ------------------------------------------------------------------------------------------------
        asset() function:
            -function refer to anyting in public folder from views folder
            example:
                master.blade.php:
                    <link href="{{asset('assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">

            -this is not the best way to refer , there is another way
            -the other way is that we can combine all js files in one file , all css files in one file
            -so we will only refer to 1 file js, 1 file css
        ----------------------------------------------------------------------------------------------------
        
        Continue Example departments.blade.php:
            master.blade.php:
                -navbar, sidebar are repeated so we left them
                -main section is variable 
                
                -blades have inheritance concept , we can say that master.blade.php is parent , and other blades can inherit from it
                -we want to tell that we can override main section
                -Laravel has directives to be used in blade templates
                -@yield("anyname") directive : tell that main section can be overriden

                example :
                     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        @yield("content")
                    </main>
            ********************************************************************************
            -depts.blade.php:
                -we will create depts.blade.php
                -we want to say that depts blade inherits from master blade 
                -@extends("parentName") :
                    for example : @extends("master")
                -now we have everything that master blade has

                -we want to override the yield("content"):
                --------------------------------------------------------------------------------------------
                @section and endsection directives:
                    -so we will use directives called (@section('content'), @endsection) and put our code between them:
                        example :
                            @section('content')
                                //My Code
                            @endsection
                -------------------------------------------------------------------------------------------
                @foreach and @endforeach directives : same as foreach
                example: 
                     @foreach($depts as $dept)
                        <tr>
                            <td>{{$dept->id}}</td>
                            <td>{{$dept->name}}</td>
                            <td>{{$dept->manager_id}}</td>
                            <td>{{$dept->department_id}}</td>
                            <td>{{$dept->created_at}}</td>
                            <td>{{$dept->updated_at}}</td>
                        </tr>
                    @endforeach

                    -depts are called collection of eloquent objects, dept is called eloquent object
                    -collections is similar to arrays
                --------------------------------------------------------------------------------------------
                @forelse , @empty, @endforelse directives : 
                    -what to do when there is empty collection/array
                    -we want to print empty result under @empty directive 
                    -Example:
                           @forelse($depts as $dept)
                                <tr>
                                    <td>{{$dept->id}}</td>
                                    <td>{{$dept->name}}</td>
                                    <td>{{$dept->manager_id}}</td>
                                    <td>{{$dept->department_id}}</td>
                                    <td>{{$dept->created_at}}</td>
                                    <td>{{$dept->updated_at}}</td>
                                </tr>
                            @empty
                                  <tr>
                                    <td colspan="6">Empty Result</td>
                                </tr>
                            @endforelse
                ---------------------------------------------------------------------------------------------
                -$loop Collection:

                    -The $loop variable is a Collection object and it provides access to useful meta information about your current loop. $loop variable exposes eight useful properties.

                    -It can be used with @foreach, @forelse
                    
                    -$loop->index Returns a 0-based current loop iteration; 0 would mean the first iteration
                    
                    -$loop->iteration Returns a 1-based current loop iteration; 1 would mean the first iteration
                    
                    -$loop->remaining Number of iterations remaining in the loop; if there are a total of 10 iterations and the current iteration is 3, it would return 7
                    
                    -$loop->count Returns the total number of iterations or the total number of items in the array
                    -$loop->first Returns true if it is the first iteration or item in the loop else returns false.
                    -$loop->last Returns true if it is the last iteration or item in the loop else return false.
                    -$loop->depth Returns the depth or nesting level of the current loop; returns 2 if it is a loop within a loop and 3 if it is nested one level more
                    
                    -$loop->parentIf this loop is nested within another @foreach loop, parent returns the parent’s loop variable; If it is not tested, returns null
                    
                    Example :
                        @forelse($depts as $dept)
                            <tr>
                                <td>{{$loop->iteration}}</td>{{--starting from 1--}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Empty Result</td>
                            </tr>
                        @endforelse
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

Insert New Record:
    -Depts blade:
        -we will make a button/link to call /department/create  route which will call create function in department controller
            Example :
                //using url
                <a class="btn btn-sm btn-primary m-1" href="/department/create" >Add Department</a>
                or
                //we will use named route of create by using route function, which is made my route resource 
                <a class="btn btn-sm btn-primary m-1" href="{{route('department.create')}}" >Add Department</a>

    -DepartmentController:
        -we will make folder depts , inside it make a view (create)
        example:
        public function create()
        {
            return view("depts.create");
        } 
    
    --we will make folder depts , inside it make a view (create)
    -we will change depts blade to index blade 
    -we will also change path in index function in department controller
        public function index()
        {
            return view("depts.index", ["depts" => Department::all()]);
        }
    
    -create blade:
        -we will make a button to refer to index blade:
            <a class="btn btn-sm btn-primary m-1" href="{{route('department.index')}}" >List Departments</a>
        
        -we want to make Form to insert record
        -in laravel , Form method must be POST
        -we will call route of store , which will call store function in department Controller to insert record in Database

        example :
            <div class="container">
                <div class="row">
                    <div class="col">
                        {{-- <form method="POST" action="/department/store"> --}}
                        <form action="{{route('department.store')}}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter dept Name" aria-describedby="helpId">
                            </div>
                            <input type="submut" class="btn btn-sm btn-primary m-1" value="Save">
                        </form>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        -----------------------------------------------------------------------------------------------------
        CSRF Token:
            -when we press save button , it will get Page Expired
            -we want to make sure that the one who opens the page(create blade) and the one who requested request(saving/send data from button ) are the same
            -laravel make Csrf token to cancel/avoid csrf attacks
            -the one who opens the page will take a token , and when he press save , token will be send with data to be verified
            -This way is done to prevent sending forms from postman , and other programs outside form

        how to make CSRF token:
            -make input hidden inside form
            -put token string in it using token function

            or 
           -just put directive called @csrf inside form
            <form action="{{route('department.store')}}">
                @csrf
                //
            </form>
                    
    .......................................................................................................
    
    store function in department Controller:
        -$request->all() : get all data in request
        -we want after insert record , route to index function which will go to index blade to show all records
        -return redirect()->to("/department");//route to specific url 
        -return redirect()->route("department.index");//route using route name
        example:
            public function store(StoreDepartmentRequest $request)
            {
                //validate request coming from form

                //create model object
                // dump($request->all());//
                $dept = new Department();
                $dept->name =$request->name;
                $dept->save();//to insert record into table
                return redirect()->to("/department");//url
                return redirect()->route("department.index");//route name
            }
    ---------------------------------------------------------------------------------------------

*/