<?php  

/*
Intro to WordPress:
    -Wordpress is CMS(content management system) build by php and mysql
    -CMS(content management system): allows us to build to build website without knowing any web technologies or even html
    -37% of websites are built by wordpress
    -wordpress made for users who are not developers


    wordpress provides up with customizations features:
        -wordpress themes (view of webpage)
        -wordpress plugins 

    -What is the role of developer in wordpress?
        -developer can make easy website using wordpress that normal people can

        -developer can adjust wordpress code (html, css) as a frontend developer
        -developer can adjust wordpress code in backend , but then we can be wordpress developer, as wordpress backend files and code have different style of coding
        ,we must study wordpress in depth(wordpress.org has documentation)
        
        -developer can add theme/plugin and can sell it:
            -we make html+css+js design/theme and install it as wordpress theme
            -so need to convert our theme to be wordpress theme
            -and this requires to study wordpress in depth
            -we can study wordpress development from Elzero channel on youtube
        
        
    -Wordpress websites:
        -wordpress.org:
            -has most things we need
            -search for themes/plugins
            -learn that contain documentation
            -codex.wordpress.org:
                contain documentation of wordpress functions

            -The website where the wordpress application is hosted
            -Documentation is found here
            -Access to thousands of plugins
            -Ability to have your own domain name
            -Ability to monetize(تحقيق دخل) your website through Ad placements

        -wordpress.com:
            -if we want to make free wordpress website for trial
            -its domain will be myName.wordpress.com
            -it gives us low features 
            -Is a SaaS (software as a service)
            -Can be used to publish your website through the platform
            -Can't upload plugins
            -Limited customizable themes
            -Private domain name not available
            -a correct use of the term would be " i created my first blog using wordpress.com"
        
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Installation And create new Wordpress project:
        -download wordpress from wordpress.org
        -unzip downloaded folder
        -put it inside htdocs
        -rename wordpress folder to our project Name
        -write in url : localhost/ourProjectName
        -we need to make empty database for our project
        -when we write in url: localhost/ourProjectName:
            -it goes to another file :localhost/ourProjectName/wp-admin/setup-config.php
            -this page contain installation/configuration steps for our wordpress website
            -make language English
        -then it asks me to enter these database data:
                Database Name : techblogwordpress	
                Username : root	
                Password :
                Database Host : localhost	
                Table Prefix : wp_

        -Then we enter our site data and create admin account for my website:                
            Site Title: TechBlog
            Username:   Ahmed Fawzy
            Password:   123456
            Confirm Password:	 Confirm use of weak password
            Your Email:	ahmedfawdw12@gmail.com
        -then login with my name and password:
            -Ex:
                username: Ahmed Fawzy
                password: 123456
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Wordpress Dashboard:
    -wordpress website is for blog websites
    -Post is the main building block for wordpress website
    -post may be under certain category, or may have comments

    -Post: 
        -all posts:
            -to show/display all posts that we have
            -it displays author, categories (that our post belongs to), comments, date of publish
            -we can make actions on posts 
            -we can search for posts
            -we can select posts that belongs to certain category
        -Add new:
            -we can add blocks:
                -paragraphs 
                -quotes
                -lists
                -tables
                -images
                -code
                -embed(from ytube, twitter, ....)

            -we can assign new categories from settings icon
            -we can assign new featured image for the post to be displayed before the post and we can add description to it  
            
            -then we publish our post:
                -visibility:
                    -public  
                    -private(visible only to admins)
                    -password protected(post protected with password,only those with passwords can see the post)
                -publish date: immediately or ...
                -suggestion:Add tags  :
                    -if we want to add meta keywords
                    -so when someone search for certain keywords , the post will appear
                
                -then press 

        -Categories:
            -add new categories and can assign them to posts

        -Tags:
            -to add new tags and assign them to posts

    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    -Media:
        -where we keep and upload all images/video (all types of media)
        -we can make operation on these media
        -we can add new media
    -Pages:
        -static pages in website(contact us , about us , privacy and policy)
        -Pages are type of posts
        -it is stored in database

        Note:
            -when we move something to trash ,it is not deleted
            -we need to delete it from trash also
    

        

    

*/

?>
