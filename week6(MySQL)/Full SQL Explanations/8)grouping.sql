/*
Grouping:
    -It is related to aggregate functions
    -aggregate functions good but have limited usuage as we can't select other normal columns with it

    -Example :
        -we want to get count of people/customers:
            SELECT COUNT(*) from customers

    -Example:
        -we want to get count of customers according to each country
        -according to each country is called grouping 
        -grouping extends functionality of aggregate functions
        -grouping is done by (GROUP BY)

        SELECT COUNT(customerNumber) 
        FROM customers
        GROUP BY country;


        - we want to select country name with the count:
            SELECT country, COUNT(customerNumber) 
            FROM customers
            GROUP BY country;

            -and this is the only condition where we can select normal column while using aggregate function (GROUP BY)


    -Example2:
        -we want to get sum of quantity ordered for each order
        Kareem fouad database:
            orderdetails table:
                SELECT orderNumber, sum(quantityOrdered) AS sumQuantity  
                from orderdetails 
                GROUP BY orderNumber
        
    -Example3:
        -we want to get sum of quantity ordered for each order, but we want orders that has sum > 200
        
        -when we want to make condition while using group by, 
        we will not use where ,
        but we will use HAVING 
        -because we are making condition the result of group by, so we will use HAVING

        -so if we are making condition after group by ,we  will use HAVING instead of where
        -and if we are making condition before group by, we will use where

        Kareem fouad database:
            orderdetails table:
                SELECT orderNumber, sum(quantityOrdered) AS sumQuantity  
                from orderdetails 
                GROUP BY orderNumber
                HAVING sumQuantity > 200


*/