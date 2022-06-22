<?php
/*
Update:
    PUT|PATCH     deptartment/{deptartment} ...... deptartment.update › DepartmentController@update        
    GET|HEAD      deptartment/{deptartment}/edit . deptartment.edit › DepartmentController@edit

    -we will make edit link (using get/url method not form) :
        index.blade.php
        <td>
            <a href="{{route('department.edit', ["department"=>$dept->id])}}" class="btn btn-success btn-sm">edit</a>
        </td>
    
    -we will create edit blade(which will be similar to create) and go to it from edit function in department Controller
    ---------------------------------------------------------------------------------------------------------
    -With Compact method:
        -instead of making associative array with name same as variable name
        -we just use compact method and give it name
        -compact must be used inside with method
        -Example:
            -DepartmentController:
                public function edit(Department $department)
                {
                    // ["department"=>$department] same as compact("department")
                    return view("depts.edit", ["depts"=>Department::pluck("name", "id")])->with(compact("department"));
                }
                -we also need to send depts(name , ids) of all departments for select box
    -------------------------------------------------------------------------------------------------------------
    -in edit blade , we will route to department.update and give it department->id
    -update require method called PATCH or PUT
    -PATCH is better

    -we want to display old values
    -we want also to display display old option if exists:
        example :
            <select class="form-control" name="department_id">
                <option></option>
                @foreach ($depts as $id=>$name)
                <option
                    @if($department->department_id == $id)
                        selected
                    @endif
                value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
    
    -make update function in department controller
    
    full example :
        department controller:
            public function edit(Department $department)
            {
                // ["department"=>$department] same as compact("department")
                return view("depts.edit", ["depts"=>Department::pluck("name", "id")])->with(compact("department"));
            }

            public function update(UpdateDepartmentRequest $request, Department $department)
            {
                $department->name = $request->name;
                $department->department_id = $request->department_id;
                $department->save();//save do both insert if new record , if exists record update record
                return redirect()->route("department.index");
            }
        edit.blade.php:
            <div class="d-flex justify-content-between mt-2">
                <h5>Edit {{$department->name}} Department</h5>
                <a class="btn btn-sm btn-primary m-1" href="{{route('department.index')}}" >List Departments</a>
            </div>

            <form method="POST" action="{{route('department.update', ["department"=>$department->id])}}">
                @csrf
                @method("PATCH")
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$department->name}}" placeholder="Enter dept Name" aria-describedby="helpId">
                </div>

                <div class="form-group">
                    <label for="name">Main Department</label>
                    {{-- @dump($depts) --}}
                    <select class="form-control" name="department_id">
                        <option></option>
                        @foreach ($depts as $id=>$name)
                        <option
                            @if($department->department_id == $id)
                                selected
                            @endif
                        value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-sm btn-primary m-1" value="Save">
            </form>

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Pagination :
    -to have multiple pages and switch between them
    -in index function instead of showing all departments 
    1)we will use function called paginate and give it number of records to display in each page :
        public function index()
        {
            // return view("depts.index", ["depts" => Department::all()]);
            return view("depts.index", ["depts" => Department::paginate(4)]);
        }

    -but index blade will display the first page only 
    2)to get the rest of pages use links function:
        {{-- this displays 1,2,3, ... --}}
        {{$depts->links()}}

        {{--this displays next/previous  --}}
        {{-- {{$depts->links("pagination::simple-bootstrap-4")}} --}}
    
    -but the page html will be bad because laravel 8 default style is tailwind not bootstrap
    -tailwind is framework like bootstrap 
    -the difference between them is that bootstrap makes components , while tailwind gives us group of classes and we will build the components
    
    3)how to change laravel default style:
        -go to app/providers/AppServiceProvider.php  and tell it that paginator will use bootstrap:
            public function boot()
            {
                Paginator::useBootstrap();
            }
        -we must use paginator class : use Illuminate\Pagination\Paginator;
    
    -----------------------------------------------------------------------------------------------------------

    -if paginator class exists in vendor folder 
    -to change view of anything in vendor 
    -use vendor publish command:php artisan vendor:publish --tag=laravel-pagination

    -However, the easiest way to customize the pagination views is by exporting them to your resources/views/vendor directory using the vendor:publish command:
        php artisan vendor:publish --tag=laravel-pagination


    -go to vendor/pagination/bootstrap-4.blade.php and change what you want:
            

*/