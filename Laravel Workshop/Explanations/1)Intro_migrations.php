<?php
/* 
Intro:
    -go to composer.json and check laravel and php versions
    -laravel 8 and above requires php >= 7.3  

    -to know php version in cmd :php -v

-Migrations:
    -go make database using phpMyAdmin and name it skillshub and collation utf8mb4_unicode_ci

    -this is the collation(not required) , laravel prefers

    .env :
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=skillshub
        DB_USERNAME=root
        DB_PASSWORD=

    -Users Migration table:
        -we have 3 roles:
            -student :can't access dashboard
            -admin : can access dashboard , can do crud , can't add/delete/edit other admins
            -super_admin :can do everything

        -we can make enum("roles", ["s,superadmin, admin"]) in users table , but i can't expand these 3 roles in the middle of the project

        -so we will make a table for roles and make a foreign key in users table to connect with roles table
        
        create Roles model:
            -php artisan make:model Role -m         
            - -m :means If you would like to generate a database migration file when you generate the model, you may use the --migration or -m option

            -laravel executes migration according to their files order

            -Roles Migrations file must be before Users Migration, since users Migration is refrencing roles migration 
            
            -so we will change in Roles Migration name

            2014_09_24_215501_create_roles_table.php
            2014_10_12_000000_create_users_table.php
        
        Example:
            Roles Migrations :
                public function up()
                {
                    Schema::create('roles', function (Blueprint $table) {
                        $table->id();
                        $table->string("name", 20);
                        $table->timestamps();
                    });
                }
            
            Users Migration:
                public function up()
                {
                    Schema::create('users', function (Blueprint $table) {
                        $table->id();
                        $table->string('name');
                        $table->string('email')->unique();
                        $table->timestamp('email_verified_at')->nullable();
                        $table->string('password');
                        $table->foreignId("role_id")->constrained("roles");
                        $table->rememberToken();
                        $table->timestamps();
                    });
                }
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Cats Migration table:
        -we will make categories(cats) table
        -we can make $table->string("name",50) 
        -but we will use language translations for the names(we will enter translations as json so letters will be large) so we will make it text type
        
        -we will also create active column , so if the admin doesn't want to display some categories to the users 

        Example:
            cats_migration.php :
                public function up()
                {
                    Schema::create('cats', function (Blueprint $table) {
                        $table->id();
                        $table->text("name");
                        $table->boolean("active")->default(true);
                        $table->timestamps();
                    });
                }
    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    Skill Migration table:
        -it is branch from cats
        -name column of type text , because we will make translations
        -it will need image url
        -active column
        
        Example: skills_migration:
            public function up()
            {
                Schema::create('skills', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId("cat_id")->constrained("cats");
                    $table->text("name");
                    $table->string("img",50);
                    $table->boolean("active")->default(true);
                    $table->timestamps();
                });
            }
    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    Exam Migration Table:
        -it is a branch of skills
        -name of exam(we will make translations)
        -description(desc) of exam
        -img url of exam
        -number of questions in exam of tinyInteger type(which has max value of 255)
        -difficulty (from 1 to 5) so it will be tinyInteger
        -duration of exam in minutes (can be tinyInteger but we will make it smallInteger which can take max value 65535)
        -active column

        Example: Exam Migration :
            public function up()
            {
                Schema::create('exams', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId("skill_id")->constrained("skills");
                    $table->text("name");
                    $table->text("desc");
                    $table->string("img", 50);
                    $table->tinyInteger("questions_no");
                    $table->tinyInteger("difficulty");
                    $table->smallInteger("duration_mins");
                    $table->boolean("active")->default(true);
                    $table->timestamps();
                });
            }
    
    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    Question Migration Table:
        -it is a branch of Exam
        -we can make active column or not , we will not make it
        -we will make question_title of text type because they will have translations
        -we will make 4 choices columns of string type because choices are letters
        -we can make table of choices but we will make it easy and make it in questions table

        -choices will not have translations

        -we will make right_answer column and make it tiny Integer , in validations we will make sure that it will be (1 or 2 or 3 or 4)

        Example:
            public function up()
            {
                Schema::create('questions', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId("exam_id")->constrained("exams");
                    $table->text("title");
                    $table->string("option_1",255);
                    $table->string("option_2",255);
                    $table->string("option_3",255);
                    $table->string("option_4",255);
                    $table->tinyInteger("right_ans");
                    $table->timestamps();
                });
            }

    ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Pivot Table :
        -working with many-to-many relations requires the presence of an intermediate table(pivot Table). Eloquent provides some very helpful ways of interacting with this table.

        -we will make migration for the pivot table with no model 
        -pivot is just a bridge between two tables
        -pivot table name will be 1stTableNameSingular_2ndTableNameSingular or vice versa

        -the pivot table will contain foreign key to 1st table and foreign key to 2nd table
        exam_user migration pivot table:
            -we will make a pivot between users and exams
            -reference both tables
            -student score column in percentange , so its type will be float 
            -student duration to finish exam and this will be less than or equal exam duration
            -status column of enum type (opened, closed)

        Example :exam_user_table migration
            -php artisan make:migration create_exam_user_table

            public function up()
            {
                Schema::create('exam_user', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId("user_id")->constrained();
                    $table->foreignId("exam_id")->constrained();
                    $table->float("score", 5,2)->nullable();  //100.00
                    $table->smallInteger("time_mins")->nullable();
                    $table->enum("status", ["opened", "closed"])->default('closed');
                    $table->timestamps();
                });
            }

            -score and time_mins are nullable at first
            -they will be determined later untill student finishes exam or exceeded time limit
            
            -also status by default closed as when student enter exam first time exam will be closed 
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    -Messages Migration table:
        -we will make table for messages of contact form
        
        example :
            -php artisan make:model Message -m    

            public function up()
            {
                Schema::create('messages', function (Blueprint $table) {
                    $table->id();
                    $table->string("name",255);
                    $table->string("email",255);
                    $table->string("subject",255)->nullable();
                    $table->text("body");
                    $table->timestamps();
                });
            }
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    Settings Migration table:
        -بيانات التواصل
        -main informations in our project (website main contacts informations email, phone ), social links will be collected in a table and name it settings.
        
        -we will make columns for email, phone, facebook, twitter, instagram, youtube, linkedin.

        -social links can be null

        example:
             public function up()
            {
                Schema::create('settings', function (Blueprint $table) {
                    $table->id();
                    $table->string("email",255);
                    $table->string("phone",30);
                    $table->string("facebook",255)->nullable();
                    $table->string("twitter",255)->nullable();
                    $table->string("instagram",255)->nullable();
                    $table->string("youtube",255)->nullable();
                    $table->string("linkedin",255)->nullable();
                    $table->timestamps();
                });
            }
    ------------------------------------------------------------------------------------------------------------------------------------------------------------

    -after finishing all migrations , run migrations : php artisan migrate

    -to get schema(drawing) of database , go to phpmyadmin ,then more ,then designer , arrange the tables
*/