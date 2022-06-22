<?php 

/*
-modified posts table in blog_offline db : changed not null to null , as when user creates the post at the beginning ,no one takes an action 
**************************************************************
1)File_Upload:
    1.1)-use form tags with method ="POST" and enctype = "multipart/form-data"

    - enctype = "multipart/form-data":normally when submitting form, the form is sent to the server (على مرة واحدة),
    but when the form contain file , it is not normaly sent(على مرة واحدة), also i want the file to be sent to a superglobal array called $_FILES

    - multipart : the file is uploaded on multiple times/parts, also files needs a special type of encoding
    , also because upload speed is slower than download speed
    
    1.2)use <input type="file" name="anyName"> :
        - type = "file" : is important to upload file


2)Reciving Uploaded_file:

-$_FILES[] :associative superGlobal array , its key is input name ,its contents is another array that contains:
    - name : name of the file at the client
    - type : type of the file ( img or file or ...)

    -tmp_name : 
        - The temporary filename of the file in which the uploaded file was stored on the server.
        
        -it means that the file is indeed uploaded on the server and is placed in a temporary location in the server ,  I can't leave the file in this temp location because as soon as i close and reopen i can't access it, so i must move it to another location where i can have an access on the files

    -error :where there are errors or not
    -size : size of the file

functions :
    1)move_uploaded_file(filetmpName ,dist) :
        - moves an uploaded file to a new destination.
        - file	: Required. Specifies the filename of the uploaded file
        - dest:	Required. Specifies the new location for the file

    - we should also change the filename to a new unique name : to avoid if multi users uploaded files with the same name , so we avoid files being overriden by eachother 

    -unique name can be : current_timestamp + post_id or(+) user_id + img_name or generate random string 

    2)pathinfo(path, options) : returns information about a file path.

    -path	:Required. Specifies the path to be checked
    -options :Optional. Specifies which array element to return. If not specified, it returns all elements.
        Possible values:
            PATHINFO_DIRNAME :return only dirname
            PATHINFO_BASENAME : return only basename(name + extension)
            PATHINFO_EXTENSION : return only extension of file
            PATHINFO_FILENAME : return only filename without extension

    - return type :	If the option parameter is omitted, it returns an associative array with dirname, basename, extension, and filename. If the option parameter is specified, it returns a string with the requested element. FALSE on failure


3)create_post_with_image:

    home.php:
    - we need to insert title , body, image 
    - status = "pending" by default, also created_at = current_timestamp by default, id = auto_increment

    - make form to send data of post to  "post_create.php"
    - inside form :make input for post_title, textarea post_body, input for image, input for button to submit the form

    post_create.php:
    -move the received uploaded file to another location using move_uploaded_File() function

    -we want the new unique name of post : "images/posts/" + current timestamp + user_id +  extension 

    -we can get user_id  from the session that we created before for the user , we also must check if user_id exists

    - save post in database:
        notes:
            -in database any text must be surrounded by single quotes '$title'.
            - but associative array can't be surrounded by ' ' for database or " " for php
            $user = ["id"=>1,2,3];
            echo '$user["id"]'; //correct // o/p : $user["id"]
            echo $user['id'];//correct also
            echo "$user['id']"; //error 
    
4)displaying user posts:
-home.php we will display user posts

5)Delete a post:
-in home.php , create a link btn to delete a post (go to post_delete.php , send post_id through url)
-create post_delete.php
-in post_delete.php : 
    -check if there is a session for user
    -connect to the database
    -delete post from posts table in database
    -we deleted the post but we did not delete the image from the posts folder
    -unlink(filename): to delete image or file 
        - filename :Required. Specifies the path to the file to delete
    
    -if the user logout , and another user logged in , he can delete the other users' posts 

    -to prevent deleting posts of users by other users ,we will make the delete button appear only on the logged in user's posts , but the delete button will disappear for other posts:
        -in home.php : we will make an if condition to check user['id'] == post['id'], then appear the delete btn
    
    -if anyone(user) write any post_id through url , he can delete the posts,we need to check if post['created_by']== user['id'] in post_delete.php
************************************************************* *************************************************************
6)make_some_role_permissions:
        -in home.php : we will put a condition in the query , so if user role = admin display all posts that have status = "pending or approved" , and if user role =user display all posts that have status ='approved'

        -there must be an admin at the beginning , so we will make a user at database and give it a role =  admin 

        -in home.php : if user role = "admin" show buttons (approve , reject) for the admin, 
        else if user role = "user" or admin show buttons delete for the user or admin so that they can delete

        -create post_action.php to deal with approve or reject
        /////////////////////////////////////////////////
        post_action.php:
            -check if there is user session(someone logged in) and check if user role = admin

            -connect with db 
            -update post status, action_by in posts table according to the received action
            -then go to home.php
        
            -in home.php if admin already approved or rejected , then make (approve, reject) buttons disappear and make delete button appear:
                we will put condition :if (role==admin && post_status == "pending") make approve , reject buttons appear else  make delete button appear
        
        post_delete.php: 
            - if admin want to delete a post , he can not because we made a condition before said that only the user who created the post can delete it, so we want to modify a condition

            -modification : we will only add the condition if user role != admin

        in post_create.php :
            -check if user is admin ,then make status approved else pending , so that if user admin , he won't approve or reject his post , it will be directly approved
        
        - I want to make only admins or editors the ones who can create posts and role = "user" be able to see the posts only , we will do that on two levels:
        1)UI level : in home.php , make form of creating post appear only to admins , editors

        2)2nd level php level: in post_create.php , we put condition to check if role = "admin" or "editor" to be able to create posts
        ************************************************************************************************************
7)add users_by_admin:
        -in home.php : add link for users to go to users_create.php
        -put navbar in a seperate page (header.php) because it will be repeated in multiple pages
        -put footer in a seperate page (footer.php) because it will be repeated in multiple pages

        -we want links in the navbar to be dynamically active(highlighted) according to page name , there are 2 Solutions:

            Solution 1: 
                    -using $_SERVER[] associative global_array which holds information about headers, paths, and script locations.
                    -  some of the elements in $_SERVER:
                        -$_SERVER['PHP_SELF']	:Returns the filename of the currently executing script(home.php, ...)

                        -$_SERVER['SERVER_ADDR'] : Returns the IP address of the host server  

                        -'REQUEST_URI' : The URI which was given in order to access this page; for instance, '/index.html'.
                                        - page where i am standing
                        
                        - 'HTTP_REFERER' : the page where I came from 

                        
                    
                -add if condition in link to check if request_uri has ("home.php") then add active in its link , if request_uri has ("users_create.php") then add active in its link 
        
            Solution 2(better solution):
                    - in home.php make $active_link = "home" before require the header.php
                    - in users_create.php make $active_link = "users" before require the header.php

                    - then add if condition to check  check if active_link = "home" then add active in its link , if active_link = "users" then add active in its link 
        
        /////////////////////////////////////////////////////
        -in users_create.php :we want admin to be able to add other admins , editors , so we will copy register.php form to users.php

        - in users.php : added 2 radio buttons for admin, editor

        - make users_store.php : go to it

        -in users_store.php : copy content of register_action.php 

        -in users_store.php : check if user session not empty and user role = "admin" else go back to users.php
        
        -in users_store.php : check if email already exists in database 

        -in header.php : we want to add dropdown menu  :includes add user (go to users_create.php), users list(go to users.php) instead of users link(from boostrap)
        
        -in header.php : we want dropdown menu to appear to the admin only , so we will put condition to check if user role = "admin"
        
        -if any user not admin (user , editor) wrote "users_create.php" in the url , he will go to it , so we want to prevent this:
            -in users_create.php :check if (user role != "admin") go to home.php
            - but sometimes this gives error because we are heading to home.php after very very short time of require("header.php") , so the best this is to write this condition in header.php itself
        
            HomeWork:
        -create users.php , show all users , delete user
        *****************************************************************************************************************

8)Updating Post :
        -create two pages :
            1)post_edit.php : ui to view edit itself (will be like home.php in creating post only)
            2)post_update.php : to update post itself in the database(will be post_create.php)

        -in post_edit.php : -only admin and editor(who created the post) can edit the post
                            -check if post_id not empty
                            -query over posts table to get old post data so that we can put it in the old inputs
                            -add img element to display old image 
                            -add input hidden to send post_id to post_update.php

        -in post_update.php : -check if post_id , title , body not empty
                              -check if image is empty, if image is empty , query over database to get old image 
                              -if image not empty then delete old image and save the new image
                              - query to update post values
                              -go to edit.php
 ************************************************************************************************************************
9)Localization : 
    -translating a product into different languages or adapting a product to a country or region 
    -index.php : -add links for arabic , english languages that go to change_lang.php 
                 -check the session(lang) to get the language to change page content
                 -if lang == "ar" require messages_ar.php , if lang == "en" require messages_en.php 
                 -put the values of messages array 

                 

    -change_lang.php:- save users language choice in a session , make default is english 
                     - go to the page that called me using $_SERVER['HTTP_REFERER']

    -Create page for each translation that contains associative array (key with its translation)
    -translation pages : messages_ar.php , messages_en.php

    -header.php : -check the session(lang) to get the language to change page content
                 - if lang == "ar" require messages_ar.php , if lang == "en" require messages_en.php 
                 - make dropdown menu that contains :
                    - english or arabic (to change the language)
                    - logout 
    
    -home.php : -put the values of messages array

*/
            
            

//example on date():
echo "Today is " . date("Y/m/d") . "<br>";//Today is 2020/11/03
echo "Today is " . date("Y.m.d") . "<br>";//Today is 2020.11.03
echo "Today is " . date("Y-m-d") . "<br>";//Today is 2020-11-03
echo "Today is " . date("l");//Today is Tuesday

//example on file upload
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "POST" enctype="multipart/form-data">
        <input type="text" name="name">
        <input type="file" name="photo">
    </form>    
</body>
</html>

