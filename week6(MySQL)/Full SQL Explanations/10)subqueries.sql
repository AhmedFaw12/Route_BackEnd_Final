/*
Subqueries:
    -sometimes we want to make query that needs result of another query
    -example:
        -we want customers who have credit_limit above average
        -so we need to get average then get customers who are above than average(2operations)

        Average of credit limit:
            SELECT AVG(creditLimit) AS avgCredit
            from customers; //o/p = 67659.016393
        
        Get customers who have creditLimit above average
            SELECT * from customers where creditLimit > 67659.016393
        
        -this solution will work but not efficient as 67659.016393 not constant , it may change later when more customers are added


        -Efficient Solution in one query(Subquerires):
            SELECT * from customers
            where creditLimit > (SELECT AVG(creditLimit) AS avgCredit
            from customers;)


            -Inner query:
                SELECT AVG(creditLimit) AS avgCredit
                from customers;
            -Outer query:
                SELECT * from customers
            where creditLimit > ....
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    -example2:
        Kareem fouad database:
            Customers table:
                -we want to get ALL customers in the country that has maximum number of customers

                -we will first get country that has maximum number of customers: 
                    SELECT country, COUNT(customerNumber) AS cntCustomers
                    From customers
                    GROUP BY country
                    ORDER BY cntCumtomers DESC
                    LIMIT 1;

                -then we get ALL customers in that country(FULL SOLUTION):
                    SELECT * from customers 
                    WHERE country = ( SELECT country
                    From customers
                    GROUP BY country
                    ORDER BY COUNT(customerNumber) DESC
                    LIMIT 1);    
    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------    
    -example3:
        Kareem fouad database:
            Orders table , Customers table:
                -we want to get Orders made by customers who live in USA
                -we can make subqueries its parts can be done through 2 tables
                -inner query work on a table , outer query works on another table

                -order table don't contain the country of the customer, it only contains customer number

                -so we want to get customers(customer number only) who live in USA from customers table:
                    SELECT customerNumber
                    from customers 
                    where country = 'USA'

                -OuterQuery(get order of those customers) (FULL SOLUTION):
                    SELECT * from orders
                    WHERE customerNumber IN(
                          SELECT customerNumber
                        from customers 
                        where country = 'USA'
                    );

                    -we used IN because inner query return array of data not one record
               
        ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            


*/