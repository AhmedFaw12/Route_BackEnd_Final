/*
Select(read) records:
    Example:
        -select all records(since we didn't write where) with all columns
        SELECT * FROM users
    
    Example2:
        -select some columns
        SELECT name, age FROM users;

    Example3(SELECT DISTINCT):
        
        SELECT type from users;   ---> o/p : user
                                             user
                                             user
                                             user
                                             user

        -SELECT DISTINCT
        -if i want to select column without repitition

        SELECT DISTINCT type from users;  ---> o/p: user 
    
    Example4(SELECT DISTINCT):
        SELECT DISTINCT age from users;  ---> o/p: 21
                                                   26
                                                   24
    

    Example5(SELECT DISTINCT with two or more columns):
        SELELCT DISTINCT contactFirstName, contactLastName FROM customers
        
        first   last
        ahmed   hasan -->appear
        ahmed   hamdy -->appear
        mohamed hamdy -->appear
        ahmed   hasan -->don't appear

        -it will work such that first and last names(combined) will not be repeated
        -ahmed hasan will not be repeated

*/