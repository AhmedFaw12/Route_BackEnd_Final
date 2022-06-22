<?php
/*
Review:

-public Folder : anything static(like css, js files, web image/logo) are put in it
-while files/images/pdf/... uploaded by users are called storage of project are put inside another location
-they are stored in storage/app/public , and we will make a link to them in the public folder
----------------------------------------------------------------------------------------------------------------
-Blades is converted later to native php and cached in storage/framework/views 
we can clear cached views by :php artisan view:clear
-when we run app , they will be cached again
-when we make a change in code , and we don't see , go and clear views and run app again
----------------------------------------------------------------------------------------------------------------
-env file can also be cached, so sometimes when we change in env file and this change is not done , so go and clear env cache
-to clear env cache: php artisan config:clear

-command :php artisan optimize   
-this command clear config cache, route cache and cache them again

-command : php artisan route:clear
-to clear route cache


*/