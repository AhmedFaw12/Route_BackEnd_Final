<?php

/*
Validation:
    -validation is done on 3levels:
        -html/frontend validation
        -backend validation
        -database constraints
    -we have done database constraints only    
    -validations in laravel are very easy

    -we receive request in controllers

    validate () method :
        -request object has function validate , we will give it our validation rules

        Validations rules:
            -required :
                -The field under validation must be present in the input data and not empty. A field is considered "empty" if one of the following conditions are true:

                    The value is null.
                    The value is an empty string.
                    The value is an empty array or empty Countable object.
                    The value is an uploaded file with no path.
            
            -alpha :The field under validation must be entirely alphabetic characters.(contain space)
            -alpha_num : The field under validation must be entirely alpha-numeric characters.
            -size:value    :
                    -The field under validation must have a size matching the given value. For string data, value corresponds to the number of characters. For numeric data, value corresponds to a given integer value (the attribute must also have the numeric or integer rule). For an array, size corresponds to the count of the array. For files, size corresponds to the file size in kilobytes

                    -examples :
                        // Validate that a string is exactly 12 characters long...
                        'title' => 'size:12';
                        
                        // Validate that a provided integer equals 10...
                        'seats' => 'integer|size:10';
                        
                        // Validate that an array has exactly 5 elements...
                        'tags' => 'array|size:5';
                        
                        // Validate that an uploaded file is exactly 512 kilobytes...
                        'image' => 'file|size:512';
            
            -same:field    :
                The given field must match the field under validation.
                -for password and confirm password

            -starts_with:foo,bar,...:
                -The field under validation must start with one of the given values.
            -gt:field:
                -The field under validation must be greater than the given field. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule.
            -gte:field:
                The field under validation must be greater than or equal to the given field. The two fields must be of the same type. Strings, numerics, arrays, and files are evaluated using the same conventions as the size rule
            -lt:field : less than
            -lte:field : less than or equal
            -max:value:
                -The field under validation must be less than or equal to a maximum value. Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
            -min:value:
                -The field under validation must have a minimum value. Strings, numerics, arrays, and files are evaluated in the same fashion as the size rule.
            -digits:value:
                -The field under validation must be numeric and must have an exact length of value.
            -integer :The field under validation must be an integer.
            -unique:table,column
                -The field under validation must not exist within the given database table.

            ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        -example :
            -we want department_id to be integer
            -but if we entered empty department_id , it will tell me it must be integer
            -so we have to add also nullable rule

            department controller:
                public function store(StoreDepartmentRequest $request)
                {
                    //validate request coming from form
                    $request->validate([
                        "name"=>"required",
                        "department_id"=>"nullable|integer"
                    ]);

                    //create model object
                    // dump($request->all());
                    $dept = new Department();
                    $dept->name =$request->name;
                    $dept->department_id = $request->department_id;
                    $dept->save();//to insert record into table

                    return redirect()->to("/department");//url
                    // return redirect()->route("department.index");//route name
                }
        
        $errors:
            -if there were validation errors , it will collect them in a variable , then route to the form view 

            -errors are collected in a variable called $errors
            -it is a collection variable
            ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            -we can display these errors :
                -1st method using foreach (not recommended) display all errors in one place:
                    -use all() function to get all errors messages
                    create.blade:
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach

                2nd method using @error("input_name") @enderror directives and $message variable which contain error message: 
                    create.blade:
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter dept Name" aria-describedby="helpId">
                        @error("name")
                            <small class="text-danger">{{$message}}</small>
                        @enderror

                        <select class="form-control" name="department_id">
                        <option></option>
                        @foreach ($depts as $id=>$name)
                        <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                        </select>
                        @error("department_id")
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                -when refresh page , error will be deleted
                -to get old name , value using old('myName'):
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Enter dept Name" aria-describedby="helpId">
                @error("name")
                    <small class="text-danger">{{$message}}</small>
                @enderror

                -error messages are saved in lang/validation.php 
                how to change error messages :
                    -at the end of lang/validation.php we can change name of attribute :
                        'attributes' => [
                            'department_id'=>'department'
                        ],
                
                - we can change language of error messages , we will take that in localization
                ................................................................................................................................................................................
                -if we don't want to return to same view , and go to another view:
                -there is validator class :
                example :
                    public function store(Request $request)
                    {
                        $validator = Validator::make($request->all(), [
                            'title' => 'required|unique:posts|max:255',
                            'body' => 'required',
                        ]);
                
                        if ($validator->fails()) {
                            return redirect()->to("/department")
                                            ->withErrors($validator)
                                            ->withInput();
                        }
                
                        // Retrieve the validated input...
                        $validated = $validator->validated();
                
                        // Retrieve a portion of the validated input...
                        $validated = $validator->safe()->only(['name', 'email']);
                        $validated = $validator->safe()->except(['name', 'email']);
                
                        // Store the blog post...
                    }
            --------------------------------------------------------------------------------------------
            -Custom rules:
                -command to create rule class : php artisan make:rule NameRule
                -it will create a class in app/rules/NameRule.php
                -class will contain passes function , where we put our rule code
                -also contain message() , error message

                -to apply our rule , go to controller , make new object from our rule class , add it in an array
                example : 
                AhmedRule.php:
                     public function passes($attribute, $value)
                    {
                        return $value == "ahmed";//if value == ahmed it will pass , no error appear
                    }                
                    public function message()
                    {
                        return 'The :attribute is Invalid.';
                    }
                departmentController:
                    public function store(StoreDepartmentRequest $request)
                    {
                        //validate request coming from form
                        $request->validate([
                            "name"=>['required', new AhmedRule()],
                            "department_id"=>"nullable|integer",
                            
                        ]);
                        //code
                    }
                
                ----------------------------------------------------------------------------------------
                -we can make class for rule ,if we will use rule many times
                -if there is a rule that will be used once , do the following:
                    example:
                        departmentController:
                            public function store(StoreDepartmentRequest $request)
                            {
                                //validate request coming from form
                                $request->validate([
                                    "name"=>['required', new AhmedRule()],
                                    "department_id"=>"nullable|integer",
                                    "age" =>["required", function($attribute, $value, $fail){
                                        if($value < 10 || $value > 60){
                                            $fail("$value is Invalid age");
                                        }
                                    }]
                                ]);
                                //code
                            }
                        create.blade:
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" name="age" id="age" class="form-control" value="{{old('age')}}" placeholder="Enter dept Name" aria-describedby="helpId">
                                @error("age")
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                    
*/