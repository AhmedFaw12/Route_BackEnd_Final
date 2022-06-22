<!-- 
    - The include (or require) statement takes all the text/code/markup that exists in the specified file and copies it into the file that uses the include statement. 

    -include (or require) is good to stop repeating(rewritting) code
    
    -require_once() : will not give error if i write it many times, as it will require the file only once

    require_once() usuage : when the page contains constants, functions , classes

    -include_once() :will not give error if i write it many times, as it will require the file only once

    #The include and require statements are identical, except upon failure:
        
        - require() will produce a fatal error (E_COMPILE_ERROR) and stop the script
        - include() will only produce a warning (E_WARNING) and the script will continue
    
    syntax:
    <?php include 'footer.php';?>



    Notes on project:

    - i want to submit category name in cats.php page , if the submitted name is empty , then category_proc.php page will send me an error message "empty"

    //CRUD: Create
    - i want to insert data in database : so i want to connect to database from category_proc.php page then write insert query

    //CRUD: Display
    -i want to display data : then from cats.php page , connect to database , write select statement , display data in a div


    //CRUD: Delete
    - we will add a link button in cats.php that will direct me to category_delete.php page that will delete the data from database 

    
 -->