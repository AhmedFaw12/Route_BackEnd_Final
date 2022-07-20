/*
Aggregate Functions:
    -perform a calculation on a set of values to return a single value
    -Aggregate function:
        -MIN
        -MAX
        -COUNT
        -SUM
        -AVG

    Example on MAX:
        -we want to get customer that has the max credit in USA:
            SELECT * from customers
            WHERE country = 'USA'
            ORDER BY creditLimit DESC
            LIMIT 1
        
        ANOTHER SOLUTION:
            SELECT MAX(creditLimit) from customers
            WHERE country = 'USA'

            -but this will only get the max credit , it will not get the other data of the customer

    -Example on COUNT:
        -count will get the total number of values(number of rows except the rows that has null) 

        SELECT COUNT(country) FROM customers    --> it will get 122 country because country in this table can not be null

         SELECT COUNT(state) FROM customers    --> it will get 49 state because state in this table has some null records


    -MIN, MAX, COUNT can be used on any column Type(integer, string, ...)
    -SUM, AVG are used on numbers only or it will return 0 in case of string, date, ..

    -we can use more than one aggregate function in single query:
        SELECT MIN(creditLimit), MAX(creditLimit), MIN(country) from customers

        -it will return min creditLimit, max creditLimit
        -it will also return country that comes first in the alphabetic order because country is string(Australia)

    
    -query where we select aggregate function, don't select other normal columns with them except uder certain condition , we will know about later:
        example:
            SELECT customerNumber, MIN(creditLimit) FROM customers

            -it will return first customerNumber only 
            -and it will return MIN creditLimit
            


    -we should rename columns(ALIASING) in case we are using aggregate functions using AS:
        SELECT MIN(creditLimit) AS minCredit, 
        MAX(creditLimit) AS maxCredit, 
        MIN(country) AS minCountry 
        from customers


    Conclusion:
        -when we select aggregate functions , don't select normal columns except under certain condition

        -when we select aggregate functions, we should rename(ALIAS) columns



*/