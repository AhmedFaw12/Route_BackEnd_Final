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
                        -since it is not unsigned , there is a digit for the sign 
                        -1234.22
                        -max number to be stored : +9999999.99
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

        -primary ket can be composite(mix of multiple columns)

    -Foreign Key: 
        -it is a column in our table to points to  another table
*/

