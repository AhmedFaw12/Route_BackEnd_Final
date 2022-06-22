<?php

/*
-Introduction:
    -FrameWork :group of poeple made a large project(product) that has large set of details that are used frequently in most projects and well organized using good design pattern coding, good in structure and good security .
    
    -these people made this project open source and free for everyone

    -we will use Laravel : very easy , famous , very secure, always updated

    -Laravel is good for team work 
    -Laravel framework is built on another framework called symfony

    -any open source project exists on github

    -always open laravel documentation 

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-There are several ways to download/install Laravel:
    -github:
        -laravel/laravel : they have account named laravel , and the project name is also laravel
        -clone the laravel framework/project : git clone https://github.com/laravel/laravel.git  myprojectName
        -but laravel depends on external libraries that are not on github
        
        -there is composer.json file : 
            -composer is a simple software that operates php files for any project
            -for Example : instead of uploading phpMailer library/files on github , we will require phpMailer of certain version

            -I will tell composer which files/libraries that i will need , then to download these external libraries , just tell the composer to download these libraries (composer install)

            How to download composer ?
                -go to getcomposer.org 
                -download -->Composer-Setup.exe (for windows)
                -to download composer , i should have php
            ----------------------------------------------------
            -composer commands:
                - composer -v : command to show composer version
                - composer install : to download all libraries in the composer.json
            
            - all download packages/libraries will be downloaded to vendor folder
        
        -then generate app key using command : php artisan key:generate
        ---------------------------------------------------------------------------------------------
    
    -Laravel Installer commands:
        1)composer global require laravel/installer
        2)laravel new example-app
        3)cd example-app
        4)php artisan serve

        -since we will make multiple laravel projects, then instead of downloading project everytime from github.
        - we will use the composer to download laravel installer : 
            1)composer global require laravel/installer : 
                -we will use this command globally not specific on certain project
                -external main libraries will be cached/downloaded just one time on my operating system 
                - if we run this command again after some time  , it will search updates only and download them 

            2)laravel new my-project-name: it will get the cached files , create .env file , generate app_key automatically
            3) php artisan serve:
                -To operate my project , we should have web server, my web server is apache
                -Even if we turned off apache , laravel project will work
                -people who made laravel project, made test server called (artisan)
                - so we turn on this (artisan) server using this command : php artisan serve
                -then write in browser : http://127.0.0.1:8000

                -we can change port for my project in case we are working on multiple projects:php artisan serve --port=8080
        --------------------------------------------------------------------------------------------------------
        -if we used laravel installer , it will create (.gitignore) file : which contain set of files that will not be pushed to the github like : .env because environment on server not same on local , on server we will create .env file , also vendor because its size is big  and on server we will use composer install so we should have terminal on server/host

        


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
contents(folders/files) of Laravel Project:
    1)composer.json : that contain all external libraries that my project depend on . external libraries to be downloaded 
    2)vendor folder : where external libraries and packages are downloaded
    3).env.example : 
        -example file for the configuration of my project . We have to put our configurations(server , username , password, db_name, .....)

        -we will copy this example file and name the new one (.env) and put my configurations for my project.
        -APP_KEY :
            -we should generate this free key(like product key but free) . people who made laravel wanted people to download the key to measure/count how many have downloaded/using laravel 
            
            -we must write the command to generate key in case we cloned the laravel project from github
            -php artisan key:generate  --> command to  generate new application_key

        
    

*/

// echo 'PHP version: ' . phpversion();