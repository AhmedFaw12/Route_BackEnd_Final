<?php
/*
Eloquent Model relationships:
    -we will make some tables in migrations:
        -user :
            -this table is made by default , we will add some columns
        -Ev_manufacturers:
            -this table is about (example : marcedes or BMW)
        -Ev_model:
            -this table is about (electric car models that created by manufacturer)
        -Ev(electrical vehicles):
            -this table is about (electric vehichles)
        -Specification_types:
            -this table is about specification headline like(color , ....)
        -Specification:
            -this table is about specification info(color is red , ...) of (EvModel or PvModel , ....)
    -we used these commands to create migrations , models , factories, seeders, controllers:
        -php artisan make:model EvManufacturer -a
        -php artisan make:model EV -a
        -php artisan make:model Ev -a
        -php artisan make:model SpecificationType -a
        -php artisan make:model Specification -a
    
    -we created columns to tables :
        -user:
            -we created id ,first name , last name , email , mobile, password, role, active, , updated_at, created_at

            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum("role",["super-admin", "admin", "user"])->default("user");
            $table->boolean("active")->nullable()->default("true");
            $table->rememberToken();
            $table->timestamps();
        -Ev_manufacture:
            -we created id , name (bmw , marcedes, ...) , updated_by(who updated the record), updated_at, created_at
            $table->id();
            $table->string("name");
            $table->foreignId("updated_by")->constrained("users");
            $table->timestamps();
        -Ev_model:
            -ev_manufacturer can make many ev models , while ev model is made by one manufacturer
            -we created id , name (name of model) , updated_by(who updated the record), updated_at, created_at

            $table->id();
            $table->string("name");
            $table->foreignId("updated_by")->constrained("users");
            $table->foreignId("ev_manufacturer_id")->constrained("ev_manufacturers");
            $table->timestamps();
        
        -Ev :
            -ev_model can have many ev cars , while ev car belongs to one ev_model
            -ev_manufacturer can make many ev cars , while ev Car is made by one manufacturer
            -user can own many ev cars , but one car belongs to one user
            -we created id ,battery_capacity(in decimals), user_id(who owns the car), lat(latitude) and 
            lng(longitude) to determine car location on map ,updated_at, created_at
            
            $table->id();
            $table->decimal("battery_capacity",12,2)->nullable();
            $table->text("comment")->nullable();
            $table->decimal("lat",12,2)->nullable();
            $table->decimal("lng",12,2)->nullable();
            $table->foreignId("user_id")->constrained("users");//owner
            $table->foreignId("ev_model_id")->constrained("ev_manufacturers");
            $table->timestamps();
        -Specification_types:
            -this table is about specification headline like(color , ....)
            -we created id , name(name of specification like color , ....), (updated_by who updated record), updated_at, created_at
            $table->id();
            $table->string("name");//color , ...
            $table->foreignId("updated_by")->constrained("users");
            $table->timestamps();
        -Specification:
            -this table is about specification info(color is red , ...) of (model of Ev or model of Pv , ....) as we will use this table with multiple tables
            -we created id , body(specification info :red, ....), model_type(name of model), (updated_by who updated record), updated_at, created_at
            $table->id();
            $table->string("body");//red , ....
            $table->string("model_type")->nullable(); //(App/Model/Ev) or (App/Model/Pv) (specification belong to what ?)
            $table->string("model_id")->nullable();  //(1 or 2 or .....) or (1 or 2 or 3 .......)
            $table->foreignId("specification_type_id")->constrained("specification_types");
            $table->foreignId("updated_by")->constrained("users");
            $table->timestamps(); 
    -we  will create database 
    -php artisan migrate

    -Note :
        -be sure that the created database has default storage engine called "InnoDB"
        -to set it as InnoDB , go to phpMyAdmin , then go to variables , search for "default storage engine" , and edit to InnoDB
        
        -Another way , go to migration of table , use engine() function:
            $table->engine("InnoDB");
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Model Class:
        -Attributes:
            -protected $table = "evs"  :
                -it is made by default , since we used right naming convention
                -to give my table a name 
            
            -protected $fillable = [
                'first_name',
                'last_name',
                'email',
                'mobile',
                'password',
                ]   :
                - sets names of columns to be filled, so that when we pass an array to fillable array , only specified columns will be filled
            -protected $guarded = []
                - inverse of fillable array
                - sets names of columns not to be filled
                - if i want all columns to be filled , $guarded = [] , and don't use fillable array
        
        -we can make virtual attribute that will not be used in real database table:
            function getNameAttribute(){
                return $this->first_name . " " . $this->last_name;
            }

            -this function will create "name" attribute , so we will use it as an attribute not a function

                


    Model relationships:
        -hasMany(relatedClass, foreignKey, myPrimaryKey) :if i have many records of another table
        -belongsTo(relatedClass, foreignKey, OwnerPrimaryKey) : if i belongs to another another record

        -hasManyThrough(relatedClass, ThroughClass, 1stforeignkey, 2ndForeignKey, myprimanyKey):if my table connect to another table through a third table (inbetween)

        -Note : i don't have to write foreign , primary key if i am using write naming convention

        Examples:
            -user has many evs 
            -ev belongs to one user
            -ev belongs to one evModel 
            -evModel has many evs
            -evModel belongs to one evManufacturer
            -evManufacturer has many evModels 
            -evManufacturer has many evs

            App/Models/User.php:
                 function evs(){
                    return $this->hasMany(Ev::class, "user_id", "id");
                }

            App/Models/Ev.php:
                function user(){
                    return $this->belongsTo(User::class, "user_id", "id");//we write related class , foreign key , primary key of owner
                }
                function ev_model(){
                    return $this->belongsTo(EvModel::class, "ev_model_id", "id");//we write related class , foreign key , primary key of owner
                }
            App/Models/EvModel.php:
                function evs(){
                    return $this->hasMany(Ev::class, "user_id", "id");
                }

                function ev_model(){
                    return $this->belongsTo(EvManufacturer::class, "ev_manufacturer_id", "id");//we write related class , foreign key , primary key of owner
                }
            App/Models/EvManufacturer.php:
                function ev_models(){
                    return $this->hasMany(EvModel::class, "ev_manufacturer_id", "id");
                }
                function evs(){
                    return $this->hasManyThrough(Ev::class, EvModel::class);//related class , through class
                }        
*/