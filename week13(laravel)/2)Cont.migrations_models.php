<?php
/*

/////////////////////////////////////////////////////////////////////////////////////////////////////////

Migrations:
    -Available Column Types:
        1)bigIncrements():
            -The bigIncrements method creates an auto-incrementing UNSIGNED BIGINT (primary key) equivalent column:
            -if we want to primary key with different name other than id
            -example:
                $table->bigIncrements('serial_key');
        2)boolean():
            -The boolean method creates a BOOLEAN equivalent column:
            -makes boolean although mysql has no boolean datatype
            -laravel makes boolean tinyInt
            -example : $table->boolean('confirmed');
        3)decimal()
            -The decimal method creates a DECIMAL equivalent column with the given precision (total digits) and scale (decimal digits):

            -example:$table->decimal('amount', $precision = 8, $scale = 2);
    
        4)enum()
            -The enum method creates a ENUM equivalent column with the given valid values:
            -example:$table->enum('difficulty', ['easy', 'hard']);

        5)foreignId()
            -The foreignId method creates an UNSIGNED BIGINT equivalent column:
            -foreignId() without constrained() just create UNSIGNED BIGINT equivalent column with no foreign key
            -example : $table->foreignId('user_id');

        
    -----------------------------------------------------------------------------------------------------------------
    -----------------------------------------------------------------------------------------------------------------

    -Column Modifiers:
        1)->nullable()  :Allow NULL values to be inserted into the column.
          example:$table->string('email')->nullable();
        
        2)->after('column')	Place the column "after" another column (MySQL).
            example : $table->string('phone_nr')->after('id');
        
        3)->autoIncrement()	Set INTEGER columns as auto-incrementing (primary key).
        4)->default($value)	Specify a "default" value for the column.
        5)->first()	Place the column "first" in the table (MySQL).
        6)->useCurrent()	Set TIMESTAMP columns to use CURRENT_TIMESTAMP as default value.
        7)->unsigned()	Set INTEGER columns as UNSIGNED (MySQL). 
    
    -----------------------------------------------------------------------------------------------------------------
    -----------------------------------------------------------------------------------------------------------------
    -Column Order:
        -instead of writing ->after("certain column") many times
        
        -When using the MySQL database, the after method may be used to add columns after an existing column in the schema:

        $table->after('password', function ($table) {
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('city');
        });
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    -Modifying Migration:
        -run this command: php artisan make:migration alter_tableName_table
        -this will create migration file with empty up() and down() methods

        -write in up() method :  
            -Schema::table() to access table
            -then we can add/remove/modify column

            example :
                public function up()
                {
                    Schema::table('departments', function (Blueprint $table) {
                        $table->string("test")->nullable()->after("name");
                    });
                }


        -write in down() method :
            -the opposite of up() method
            -Schema::table() to access table
            -then we remove/drop column
            $table->dropColumn("test");
            
            example:
                public function down()
                {
                    Schema::table('departments', function (Blueprint $table) {
                        $table->dropColumn("test");
                    });
                }
        
        -we can do : php artisan migrate

        Updating Existing Columns:
            - ->change() :The change method allows you to modify the type and attributes of existing columns.
            -change() require external library called doctrine/dbal package : composer require doctrine/dbal
            example :
                public function up()
                {
                    Schema::table('departments', function (Blueprint $table) {
                        $table->string("test")->nullable()->after("name");
                        $table->string("name", 255)->change();
                    });
                }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


-Models:
    -Models is better in relations than DB class
    -In Models we can make functions to get relations between tables
    
    -each database table has a corresponding "Model" that is used to interact with that table. In addition to retrieving records from the database table, Eloquent models allow you to insert, update, and delete records from the table as well.

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-Steps to deal with database:
    1)make migrations:build tables
    2)make models : has better relations than db
    3)make Controllers
    
    -there is a command to make 3steps together for each table: php artisan make:model Department -a
    - a :means all 
    - this command will create 7 things for department: model, factory, migration, controller , seeder, resources functions(crud operations), policy

    -controller class created has 7 functions of crud operations(resources functions) :index(), create(), store(), show(), edit(), update(), destroy()
    -create is done through :create(), store()
    -update is done through :edit(), update()
    -find by Id :show()
    -delete : destroy()
    -show all :index()
    -------------------------------------------------------------------------------------------------------
    go to migration : to build table
        -example :
                public function up()
                {
                    Schema::create('departments', function (Blueprint $table) {
                        $table->id();
                        $table->string("name");
                        $table->foreignId("manager_id")->nullable()->constrained("users");
                        $table->foreignId("department_id")->nullable()->constrained("departments");
                        $table->timestamps();
                    });
                }
        -run migrate: php artisan migrate:fresh
    -nothing to do with model now

    -go to controller :
        -use the created model to show all records :
        -to show all records : all() method 
        example : 
                public function index()
                {
                    return Department::all();
                }
        
        -to call controller function go to route:
                example:Route::get("/depts", [Department::class,"index"]);
    -----------------------------------------------------------------------------------------------------------
    -we want to create record
        -example :
                -go to controller
                -created_at , updated_at are set automatically, id is autoincrement
                public function store(StoreDepartmentRequest $request)
                {
                    //validate request coming from form

                    //create model object
                    $dept = new Department();
                    $dept->name ="Main Department";
                    $dept->save();//to insert record into table
                    return $dept;
                }
    --------------------------------------------------------------------------------------------------------------
    -we want to find a record:
        -example :
            go to controller : 
            public function show(Department $department)
            {
                dump($department);
            }
            -we will take department object and in route we will name it with same name , when user enter number, laravel will figure that it is id and convert it into department object 
            
            -There is one condition : name/parameter in route must be the same name as department object function parameter

            go to routes/web.php:
                Route::get("/depts/{department}", [DepartmentController::class,"show"]);
    ----------------------------------------------------------------------------------------------------------------
    -we want to delete a record:
        example:
            go to controller:
                public function destroy(Department $department)
                {
                    $department->delete();//delete from table in database
                    return $department; //can be return as an object

                }
            go to routes/web.php:
                Route::get("/depts/{department}/delete", [DepartmentController::class,"destroy"]);
               
*/