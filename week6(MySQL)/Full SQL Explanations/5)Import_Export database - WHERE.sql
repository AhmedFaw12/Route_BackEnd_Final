/*
Export database in PhpMyAdmin:
    -go to required database
    -Export
    -Format:SQL
    -Go
    
    -export means :converting database into .sql file
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Import database in PhpMyAdmin:
    -go to required database
    -Import
    -Upload your (.sql file) 
    -Format:SQL
    -Go

    -import means: converting .sql file into database
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Note:
    -mobile numbers are stored as VARCHAR because:
        -mobile can stared with 0 ex: 01005544432 , if we write 0 at start in INTEGER , it will not be considerated

        -some mobile numbers needs to put special characters : + , (country code)
            example: (+20)
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
WHERE (filtration):

    filteration operators:
        =           Equal
        >           Greater than
        <           Less than
        >=          Greater than or equal
        <=          Less than or equal
        <>          Not equal. Note:In some versions of SQL this operator is written as !=
        BETWEEN     BETWEEN a certain range(Inclusive)
        LIKE        Search for a pattern
        IN          To specify multiple possible values for a column

    

    logical operators:
        NOT
        AND
        OR

    example1:
        -get  customers whose country is USA and creditLimit >=100000

        Kareem database:
            customers table:
                SELECT * FROM customers
                WHERE country = 'USA'
                AND creditLimit >=100000;
    
    example2(BETWEEN):
        get customers of numbers 120 – 130

        Kareem database:
            customers table:
                SELECT * FROM customers
                WHERE customerNumber >= 120
                AND customerNumber <= 130

                //Another Solution 
                SELECT * FROM customers
                WHERE customerNumber BETWEEN 120 AND 130
    example3(IN):
        get customers in France, USA, Australia
            SELECT * FROM customers
            WHERE country = 'USA'
            OR country = 'France'
            OR country = 'Australia

            //Another SOLUTION
            SELECT * FROM customers
            WHERE country IN('USA','France','Australia');
    example4(NOT IN):
        get customers in all countries except France, USA, Australia

        SELECT * FROM customers
        WHERE country NOT IN('USA','France','Australia');
    example5(IS NULL):
        get customers whose state is null
        SELECT * FROM customers
        WHERE state IS NULL

    example6(IS NOT NULL):
        get customers whose state not null
        SELECT * FROM customers
        WHERE state IS NOT NULL

    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    LIKE:
        -is used to search for pattern
        -some symbols used with like:
            %   :
                -any number of characters  
                'a%' :search for word start with a followed by any number of characters
                '%a' :search for word start with any number of characters and end with a 
                '%a%': any number of characters - a -any number of characters (a can be at start , or end , or at any place)
            
            _  :
                -means one character
                '_a' :word consists of 2 characters that has a as second character
                '_a%'search for word that has a as second character
                
        -Example1:
            -get customers whose first name that starts with 'a'

            SELECT * FROM customers
            WHERE contactFirstName LIKE "a%"

            -it doesn't matter a or A , because our collation is case insensitive(ci)
        -Example2:
            -get customers whose first name that ends with 'er'

            SELECT * FROM customers
            WHERE contactFirstName LIKE "%er"

        -Example3:
            -get customers whose phone contains '20' at any place

            SELECT * FROM customers
            WHERE phone LIKE "%20%"

        -Example4:
            -get customers who are from USA and state start with c or ends with a

            SELECT * FROM customers
            WHERE country = 'USA'
            AND (state LIKE 'c%' OR state LIKE '%a');
        
        -Example5:
            -get all orders that requiredDate is on month 3
            
            SELECT * FROM orders
            WHERE requiredDate LIKE '%-03-%';

            Another SOLUTION:
                SELECT * FROM orders
                WHERE MONTH(requiredDate) = 3 ;
        
        -Example6:
            -in websites ,there is search bar to search for something
            -suppose user search for posts that has word php in title or body or  tags

            SELECT * FROM posts 
            WHERE title like "%php%"
            OR body like "%php%"
            OR tags like "%php%"
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

*/