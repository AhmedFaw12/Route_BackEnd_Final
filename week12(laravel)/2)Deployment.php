<?php
/*
-Web hosting service:طبقا لتعريف الإنترنت فإن مواقع الإنترنت ما هي الا اسم نطاق أو دومين وهو اسم أو عنوان الموقع الذي ينقل المتصفح الي الموقع المطلوب وهذا الموقع يحتوي على صور وكتابات ومواد هي الأخرى بدورها ينبغي ان تكون على خادوم او سيرفر

-Several hosting sites: Bluehost, HostGator, ....

-There are 4 categories of  packages that each site sell :
    -SharedHost : 
        -device has several operating systems(os) and each operating system has several users, and i take one of the users so I will not have root account(admin) ... Limited
        - It gives me CPanel( لوحة تحكم صغيرة ) :
        -some shared hosts offer terminal

        - for native(with only php, mysql) projects
    
    -virtual private server(VPS): 
        -device has several operating systems(os) and I take one of the os(usually LINUX) for me only  so i have the root account(admin) for the os but device is not mine

        -It gives me WHM(لوحة تحكم ) : like start/stop service , download software , gives me terminal

        - It is good for laravel medium projects 

    -dedicated server:
        -I own the device with all os (rent the device from host site)

        -It gives me WHM(لوحة تحكم ) : like start/stop service , download software , gives me terminal

        - It is good for laravel high performance projects 

    -Cloud Host such as google or amazon: 
        -I own part of the device like VPS but customized which means that i Can increase/decrease my part as much as i want with money. for example (increase or decrease storage according to my monthly consumption)

        - It is good for laravel high performance projects 
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

-CPanel:
    -contain multiple sections :
        -File Manager: 
            -where i will upload my project files
            -I will upload files in (public Html) folder which is like Htdocs in xampp
            -I should compress my project files , i should compress my files as (.zip) because LINUX don't know (.rar)

        -MySQL Databases:
            -create database of my project
            -give it a name

            -then i should create user, also make any password for user
            -then I should add  the created user to database that has permissions on this database  , give user all privileges

        -phpMyAdmin : 
            -import project script to project database

        -MultiPHP Manager: To adjust php version

        -Email Accounts: 
            -to make email account
            -select the domain name
            -we will use this email with PHPMailer(from/to) , also for configurations SMTP server from connection_devices
            for Email Configuration:
                -Instead of using mailtrap.io
    
    -I should change config file of the project (db_name, user_name, password)
    -Email Configuration:
        -Instead of using mailtrap.io
        -we will make email account on my domain , then use the SMTP server on my domain to send or receive emails by(PHPMailer)

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Sub-domain:
        - if i want to make another project/ application , i can upload it by making sub-domain from main domain
        - we can put unlimited sub-Domains on the main Domain (like : drive.google, font.google)
        - from left bar : select domains --> then Manage --> SubDomains--> add Subdomain -->enter name , main domain name
        - then enter public html/folder name to put your project in

        - wait some time untill the new subdomain is published


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    WHM :
        - we can upload project faster from github by using terminal in WHM
        - cd /home/acmewsmy/public_html
        - git clone https://github.com/doaaAbdelfatah/blog.git blog 
        - it will clone the project to the blog folder

        -then change config file , phpMailer config also


        

*/