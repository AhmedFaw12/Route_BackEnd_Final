/*
Create database:
    CREATE DATABASE route35 COLLATE 'utf8_general_ci';

    -if we write one sql query ,we don't need to put semicolon(;)
    -if we write more than one sql query, we will put semicolon(;)
    -sql keywords are case insensitive(can be writtin with small or capital letters)
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Drop database:
    DROP DATABASE route35;

    -drop means delete database
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Create table:
    -table names must be plural
    -table names can be written camelCase , snake_case
    
    Example:
        -we will create users table
        1)table has fields:id(pk), name, email, password, age, type(admin, ...), bio, created_at  
        2)table will have primary key(pk) , and sometimes foreign key
        -primary key is unique id for each record
        -we can make primary key auto increment

        
        3)we must define datatypes for each column:
            -Famous Datatypes in sql:
                INTEGER :
                    if we say INTEGER(3) -->this means that column can have integer with max 3digits only
                FLOAT
                DOUBLE (same as float but double size)
                DECIMAL:
                    example: decimal(10,2)
                        -means we can have max 10 digits (2 of 10 are fraction)
                        -8 max before decimal point(.) , 2 after decimal point(.)
                        -max number to be stored : +99999999.99
                        -min number to be stored : -99999999.99
                BOOLEAN (not main datatype, it is 1digit integer)
                VARCHAR (limited string that can have max characters 255)
                TEXT    (very big limit string)
                ENUM (male , famale) (admin, student, editor )
                DATE (day, month, year)
                TIME (hour min sec)
                DATETIME (DATA + TIME)
            -in our example: id (INTEGER), name(VARCHAR(255)), email(VARCHAR(255)), password(VARCHAR(255)), age(INTEGER). type(enum(admin,user)), bio(TEXT) , created_at (DATETIME)

        4)CONSTRAINTS:
            NOT NULL -->required
            UNIQUE -->can't be repeated
            DEFAULT 

        5)useful keywords
            -UNSIGNED : 
                id --> UNSIGNED INTEGER --> id will be positive integer only
                -unsigned must come after datatype not before it or it will give error
            -AUTO_INCREMENT : id -->INTEGER UNSIGNED AUTO_INCREMENT -->when user enter new record id will be auto incremented

        
        SOLUTION for users table:
            id(PK) -->INTEGER UNSIGNED AUTO_INCREMENT NOT NULL
            name -->VARCHAR(255) NOT NULL
            email -->VARCHAR(255) UNIQUE NOT NULL
            passowrd -->VARCHAR(255) NOT NULL
            age -->UNSIGNED INTEGER(3) NOT NULL
            type -->ENUM('user', 'admin') NOT NULL DEFAULT 'user'
            bio -->TEXT
            created_at --> DATETIME NOT NULL DEFAULT NOW()


            CREATE TABLE users(
                id INTEGER UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL ,
                passowrd VARCHAR(255) NOT NULL, 
                age INTEGER(3) UNSIGNED NOT NULL,
                type ENUM('user', 'admin') NOT NULL DEFAULT 'user',
                bio TEXT,
                created_at DATETIME NOT NULL DEFAULT NOW(),
                PRIMARY KEY(id)
            );
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Drop table:
    DROP TABLE users;
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Keys:
    -Primary Key :
        -it is a column in table where each record is unique and never changes
        -primary key is made auto increment

        -primary key can be composite(mix of multiple columns)


    -Composite Primary key:
        A Composite Primary Key (CPK) is a key that uses 2 or more columns to uniquely identify each row in a table. They are typically seen in Associative Entity tables, or Weak Entity tables. I will explain each.

        -Associative Entity Tables(pivot table) (Many-to-Many Relationships): An Associative Entity table is simply a table that is used for a many-to-many relationship between 2 or more other tables.
            Example:
                -products table(id, name, desc, price, piecesNo, img, cat_id, created_at)
                -orders table(id, name of user(name), email, phone, address, status, created_at)

                -order can contain many products
                -one product can be ordered in many orders
                -(many-many)
                
                -so we need pivot table that contain 2foreign keys (order_id, product_id)

                -order_details(order_id(fk), product_id(fk), qty)
                -we we can make primary key composite(order_id and product_id)

                Code :
                    PRIMARY KEY(order_id, product_id)
        
        -Weak Entity Tables (Multivalued Attributes): A Weak Entity table is a table that exists because another table exists, and it needs to be used to store a Multivalued Attribute of that entity. The essence of a Multivalued Attribute is that you don’t know how many values of the attribute each row in the parent table will have. Examples of Multivalued Attributes include customer email addresses, customer phone numbers, the quantity of order lines each order will have, and how many clicks a website visit will have.

            Suppose a business wants to store as many email addresses as the customer provides. An inexperienced database architect may simply start appending columns called Email1, Email2, Email3, Email4, Email5 (and on and on) to the Customers table. This violates first normal form, and this junior architect needs to have his DDL permissions revoked because each subsequent column will be more and more sparse, leading to incredibly inefficient data storage. To correctly implement this Multivalued Attribute, you would want to create a CustomerEmails table, with a Composite Primary Key consisting of CustomerID and EmailNumber, where EmailNumber is simply an auto-increment counter column within each group of recurring CustomerID values.


    -Foreign Key: 
        -it is a column in our table to points to  another table
*/

