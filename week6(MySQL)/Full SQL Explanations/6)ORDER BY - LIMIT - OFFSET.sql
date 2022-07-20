/*
ORDER BY:
    -ORDER BY is sorting 
    -tables are sorted ascendingly by default according to primary key

    -to sort table according to another column:
        Kareem database:
            customers table:
                SELECT * from customers ORDER BY creditLimit

                -this will sort table ascendingly

                SELECT * from customers ORDER BY creditLimit DESC
                -this will sort table descendingly

    ORDER BY two or more columns:
        Kareem database:
            customers table:
                SELECT * from customers 
                ORDER BY contactFirstName , contactLastName

                -it will order by first name 
                -if more than one record has has first name , then it will order by last Name

                -since we didn't mention asc or desc it will order firstname asc and last name asc also:
                    SELECT * from customers 
                ORDER BY contactFirstName ASC , contactLastName ASC
    
    -Order By comes after filtration(where):
        SELECT * from customers
        where country = 'USA'
        ORDER BY state 

    -records that have null values will appear first when we sort
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

LIMIT:
    -we want to sort customers from richer to poorer:
        SELECT * from customers 
        ORDER BY creditLimit DESC

        -it will return all records
    -we want to get first 10 or 20 only:
        -we will use LIMIT

        SELECT * from customers 
        ORDER BY creditLimit DESC
        LIMIT 10;

    -Example:
        -we can use LIMIT without order by
        SELECT * from customers
        LIMIT 10

    -Example:
        -we want to get customer that has the most credit in USA:
            SELECT * from customers
            WHERE country = 'USA'
            ORDER BY creditLimit DESC
            LIMIT 1

        -we want to get top 3 customers that have the most credit in USA:
            SELECT * from customers
            WHERE country = 'USA'
            ORDER BY creditLimit DESC
            LIMIT 3
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
LIMIT with OFFSET:
    Example:
        SELECT * from customers
        WHERE country = 'USA'
        ORDER BY creditLimit DESC
        LIMIT 10

        -we will return top 10 customers that have credit

        SELECT * from customers
        WHERE country = 'USA'
        ORDER BY creditLimit DESC
        LIMIT 10
        OFFSET 15

        -return only 10 records, start on record 16 (OFFSET 15)":

        -so offset is used in pagination
        -we can send offset number from php
    
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

*/