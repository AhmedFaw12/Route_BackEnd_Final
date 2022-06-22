<?php
/*
Delete :
    -when we made route resource for department : Route::resource('department', DepartmentController::class);
    -it made the request of delete from DELETE type :
        - DELETE    deptartment/{deptartment} ...... deptartment.destroy › DepartmentController@destroy
    -html can send requests using only get/post 
    -@method('method_name') directive:
        -if we want to use DELETE method 
        -we will make form of method="POST" , and route (department.destroy)
        -then we will use @method("delete") directive to specify delete method
    
    Example :
        index.blade.php:
            <td>
                <form method="POST" action="{{route('department.destroy', ["department"=>$dept->id])}}">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                </form>
            </td>
        departmentController:
            public function destroy(Department $department)
            {
                $department->delete();//delete from database
                return $department; //can be return as an object

            }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  

Create CRUD Continue:
    -we want to add department (for example :admin and make it under Main department)
    -we want to choose from select box which department will be the parent/head of admin department
    -we will list options of departments to choose from them
    -we will send departments in create function in departmentController
    -we will not send all data of departments , we will only send name , id of all departments
    
    -pluck() function:
        -The pluck method retrieves all of the values for a given key:
            example :
                $collection = collect([
                    ['product_id' => 'prod-100', 'name' => 'Desk'],
                    ['product_id' => 'prod-200', 'name' => 'Chair'],
                ]);
                
                $plucked = $collection->pluck('name');
                
                $plucked->all();
                
                // ['Desk', 'Chair']
        
        -You may also specify how you wish the resulting collection to be keyed:
            -example:

                $plucked = $collection->pluck('name', 'product_id');
                $plucked->all();
                // ['prod-100' => 'Desk', 'prod-200' => 'Chair']
        
        -The pluck method also supports retrieving nested values using "dot" notation:
            -example:
                $collection = collect([
                    [
                        'speakers' => [
                            'first_day' => ['Rosa', 'Judith'],
                            'second_day' => ['Angela', 'Kathleen'],
                        ],
                    ],
                ]);
                
                $plucked = $collection->pluck('speakers.first_day');
                
                $plucked->all();
                
                // ['Rosa', 'Judith']
    --------------------------------------------------------------------------------------------------------------------
    
    -we will not send all data of departments , we will only send name , id of all departments
        example :
            DepartmentController:
                public function create()
                {
                    return view("depts.create", ["depts"=>Department::pluck("name", "id")]);//will return associative array/collection ,where id value will be the key(key is the 2nd parameter) while name value will be the value
                }
    -we will add empty option , when we don't want to choose parent department:
    -department_id is sent to request object :
        Example :
            create.blade.php:
                <form method="POST" action="{{route('department.store')}}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <select class="form-control" name="department_id">
                            <option></option>
                            @foreach ($depts as $id=>$name)
                            <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            
            departmentController:
                public function store(StoreDepartmentRequest $request)
                {
                    $dept = new Department();
                    $dept->name =$request->name;
                    $dept->department_id = $request->department_id;// select option sent (department_id)
                    $dept->save();//to insert record into table
                    return redirect()->route("department.index");//route name
                }
                
                public function create()
                {
                    return view("depts.create", ["depts"=>Department::pluck("name", "id")]);//will return associative array/collection ,where id value will be the key(key is the 2nd parameter) while name value will be the value
                }
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Model Relationships:
    -we don't want to display the parent id of sub department.
    -we want to display the parent name
    -there are multiple methods:
        -first method : 
            -is to write php code easily in index.blade.php using @php @endphp directive 
            -we will find method in Department model class
            -we will use normal if conditions inside php directive 
            -to use Department model class inside blades, we have to write its full name
            -we can't (use namespaces) in views
            example :
                <td>
                    @php
                       $d =  App\Models\Department::find( $dept->department_id)
                       if($d){
                           echo $d->name;
                       }
                    @endphp
                    {{-- {{$dept->department_id}} --}}
                </td>
            
            -this method is not good : because we may use this/same code in multiple views , so there is another method
        ------------------------------------------------------------------------------------------------------------------
        -----------------------------------------------------------------------------------------------------
        
        -Second Method:
            -we will use department model
            -we will make function and name it main_department() inside department model class
            -department can have many sub-departments(1-many)(has many relation) , while sub-department can have only parent department (belongs to relation)
            -so relation is (1 to many) 

            -(1 to many) relation is divided into 2 relations in laravel:
                -(has many) relation
                -(belongs to) relation
            
            -How to implement has Many relation:
                -department model:
                    //hasMany relation
                    function sections(){
                        return $this->hasMany(Department::class, "department_id", "id");
                    }

            -How to implement belongsTo relation:
                -department model:
                    //belongsTo relation
                    function main_department(){
                        return $this->belongsTo(Department::class, "department_id", "id");
                    }
            -this relations can be used in any views, controllers 
            
            -then call this function in index blade
            -but first check if department_id is not empty to avoid (attempt to read property"name" on null)
            example :
                index.blade.php
                <td>
                    {{($dept->department_id)? $dept->main_department->name: ""}}
                </td>
*/