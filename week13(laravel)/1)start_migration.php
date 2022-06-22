<?php

/*
Eloquent Model:

    -each database table has a corresponding "Model" that is used to interact with that table. In addition to retrieving records from the database table, Eloquent models allow you to insert, update, and delete records from the table as well.

    How Models know the table name and how queries are written , .... ?
        -Model is An Abstract class that has set of properties : 
            - $table;
            - $primaryKey = 'id';
            - $keyType = 'int';
            - $incrementing = true;
            - CREATED_AT = 'created_at';
            - UPDATED_AT = 'updated_at';
        -if i made model named Categories , laravel will know that my table is named categories 
        -because laravel has specific class for grammer : laravel knows that model name will be singular while my table name is plural .

        -if I changed model name to Cats , laravel won't understand so i must change table property name
        example :
            class Cat extends Model
            {
                use HasFactory;

                protected $table = "categories";
            }
        
        -also if primary_key is not name id , go and change the property , and so on with all default properties in model
        -------------------------------------------------------------------------------------------------

        -we will not write sql in Model , we are working oop --> model->create(.....)
        -query builder : builds the query and executes it like DB class we made
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


Migration:
    -Laravel made a good feature/option to (create table, database, ...) without writing sql called migration
    -migration is not mandatory to makes 

    -migration is important when we start a project from zero

    -there is important privilage is that the whole project with database is in the same project
    

    .........................................................................................

    -we are starting a new project change in .env : 
            - app_name = hospital
            - APP_URL=http://localhost:8000
            - DB_DATABASE=hospital

    -the only thing , that we will do that we create database by ourselves using phpmyadmin and close it 
    -later when we rent host , we will do it on cpanel (create db , create user&pass, add user to db, give privilages)
    
    database Folder/migrations:
        - laravel has created 4 tables by default (users, password_resets, failed_jobs, personal_token)
        - so don't make table users, we will make other tables
   
    Example :
        -we will Create table departments
        -migration responsiblites is structure of table (create, modify, delete)
        -after migrations are finished, i can work on mysql , oracle sql , server sql, .... because laravel creates the script not me
    ...........................................................................................................
    -How to Create Table?
        -Command : php  artisan make:migration create_tableName_table
        
        -it will create class that extends migration  in database/migrations folder
        -migration class has 2 methods , I must override (up(), down())

        -up() method :
            -when i say run/execute migration , it will use up() method
            -has class named Schema which has method called create to create table
            -Blueprint is the design of the table

            -$table->id(): make column named id , autoIncrement, primary_key , big_unsigned_int
            -$table->timestamps(): make 2 columns (created_at, updated_at) with timestamps datatype
            -$table->string("name", optional_length)  : create name column of type string , default length is 255 characters
            -$table->string("name", optional_length)->nullable() :my records can be null/empty
            -$table->text("comment")->nullable : created comment column with larger string length
            -$table->foreignId("manager_id")->nullable()->constrained("users"): 
                -created manager_id column which can be null
                -make foreign key on "manager_id" to reference id of "users" table
            
            

            -example :
                Schema::create('departments', function (Blueprint $table) {
                    $table->id(); 
                    $table->string("name", 190);
                    $table->text("comment")->nullable();
                    $table->foreignId("manager_id")->nullable()->constrained("users");
                    $table->timestamps();
                    $table->timestamps();
                });

        -down() method :when i say cancel migration , it will use down() method
                -delete table
                -can do things other that deleting tables
                example:
                    public function down()
                    {
                        Schema::dropIfExists('departments');
                    }
        ---------------------------------------------------------------------------------------------
        Migrate_Commands:
            -we want to run  migrations departments,users, ..... :  php artisan migrate
            -if we want to cancel migrations i made : php artisan migrate:rollback
            -we can rollback with multiple batches and if there is only one batch , it will rollback the last two(no. of steps) in this batch : php artisan migrate:rollback --step=MyNumber

            -if we want to rollback(call all down()) then run migrate(call all up()) : php artisan migrate:refresh
            -if we want to drop/delete all tables(not calling down() ) then run migrate : php artisan migrate:fresh

        -when to roll back ? --> if i made wrong/mistakes in a table 
        

        -when we run migration , migration table is created that contain batch column
        -batch column gives each group of migrationn a number
        -so that when we rollback : the last migrate command only will be deleted
        -we can manually from phpmyadmin give certain table batch number , so that when we roll back it will be deleted
    
        example :
            -if we make tests table/migrate 
            -if we rollback , tests table only will be deleted

*/