/*
Inner Join:
    -means that we bind tables together
    -Example:
        -Kareem database:
            Customers , Orders tables: 
                -customers table contains customer number and rest of customer data
                -orders table contains order number , customer number(foreign key) and rest of order data

                -sometime we want to get order number with rest of order data and customer number for this order and rest of customer data 

                SELECT * from orders JOIN customers
                ON orders.customerNumber = customers.customerNumber
                ORDER BY orderNumber

    -Example2:
        -Kareem database:
            Customers , Orders tables: 
                -we want to get every thing from orders table , and customer country that made order

                SELECT orders.*, customers.country from orders JOIN customers
                ON orders.customerNumber = customers.customerNumber
                ORDER BY orderNumber

    -Example3:
        -we want to select 2003 January orders with all order details
        -we have foreign key(orderNumber) in orderdetails

        SELECT * from orders JOIN orderdetails
        ON orders.orderNumber = orderdetails.orderNumber
        WHERE YEAR(orderDate) = 2003 AND MONTH(orderDate) = 01
        ORDER BY orders.orderNumber

    -Example4:
        -we want to join customers with orders and orderdetails
        -foreign key between customers and orders is customerNumber
        -foreign key between orders and orderdetails is orderNumber

        SELECT * from customers JOIN orders JOIN orderdetails
        ON customers.customerNumber = orders.customerNumber
        AND orders.orderNumber = orderdetails.orderNumber;
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



        





*/