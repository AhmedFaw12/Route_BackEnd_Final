--Comments in mysql:
    -- for single line comment
    /*for multi line comment*/
--------------------------------------------------------------------------------------------
/*
Operations:
    concatenation and arithmatic operations can be done on columns

    Example on * multiplication:
        Kareem Foaud database:
            orderdetails table:
                select orderNumber, quantityOrdered, priceEach ,
                quantityOrdered*priceEach AS totalForProduct
                from orderdetails;
            
                -we want to get total price = priceEach * quantityOrdered
    ----------------------------------------------------------------------------------------
    Example on CONCAT
        Kareem Foaud database:
            customers table:
                select customerNumber, 
                CONCAT(contactFirstName,' ' , contactLastName) AS contactFullName
                FROM customers; 
            
            -we want to get fullname = firstname + lastname
*/