<?php
/*
-fillable array:
    -we need to determine fillable columns in fillable array for each column
    -since we have too many fillable columns in each table so we will use guarded array

-guarded array:
    -we need to determine columns not to be filled
    -in all our models we will put (id , created_at, updated_at) in guarded array
    -id is auto_increment, created_at and updated_at are auto_generated

    Example:
        Cat Model ,Skill Model ,Exam Model, Question Model, Role Model, Setting Model, Message Model:
            protected $guarded = ['id', 'created_at', 'updated_at'];

    Example :
        User Model:
            -fillable array is made by default in User Model ,so we will add columns to it

            protected $fillable = [
                'name',
                'email',
                'password',
                'role_id',
            ];
--------------------------------------------------------------------------------------------------------------------------------------------------------------------
Seeders:

    -RoleSeeder:
        -php artisan make:seeder RoleSeeder
        Example:
            public function run()
            {
                Role::create([
                    'name'=>"superadmin"
                ]);
                Role::create([
                    'name'=>"admin"
                ]);
                Role::create([
                    'name'=>"student"
                ]);
            }
        -To run my seeder : php artisan db:seed --class=RoleSeeder
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    -UserSeeder:
        -we need to add 1 user at first(super admin)
        -php artisan make:seeder UserSeeder

        Example:
            User::create([
                'name' => 'Ahmed Fawzy',
                'email' => 'Ahmed@admin.com',
                'password' => Hash::make("123456789"),
                'role_id' => 1
            ]);
        -to run my seeder : php artisan db:seed --class=UserSeeder
    ------------------------------------------------------------------------------------------------------------------------------------------------------------
    -SettingSeeder:
        -we need to add our website main contact informations
        -php artisan make:seeder SettingSeeder

        Example:
            Setting::create([
                'email' => "contact@skillshub.com",
                'phone' => '010123456789',
                'facebook' => 'https://www.facebook.com',
                'twitter' => 'https://www.twitter.com',
                'instagram' => 'https://www.instagram.com',
                'youtube' => 'https://www.youtube.com',
                'linkedin' => 'https://www.linkedin.com',
            ]);
        -to run my seeder : php artisan db:seed --class=SettingSeeder
        
*/