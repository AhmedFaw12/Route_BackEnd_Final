<?php
/*
Database Schema:
    -Create database:
        CREATE DATABASE techstore COLLATE 'utf8_unicode_ci';
        -go to phpMyadmin , sql , paste code and go
            
            OR
        -go to PhpMyAdmin, new , name your database and give it collation:utf8_unicode_ci
        and go
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Tables structure and content:
        cats(id, name, created_at)

        -products table(id, name, desc, price, pieces_no, img, cat_id, created_at)
            -desc is reserved keyword in sql (ASC, DESC)
            -so inorder to use it as a column name, we will put it in a backtick (`desc`)

        -orders table(id, name of user(name), email, phone, address, status, created_at)
            -status: status of order (pending, approved, canceled)

        -order_details(id(pk), order_id(fk), product_id(fk), qty)
            -we can make primary key composite(order_id and product_id)
            -but for simplicitly , we will made id column and make it primary key and auto increment


        -admins(id(pk), name, email, password, is_super, created_at)    

    Relations:
        -cats and products:
            -each cat can have many products
            -here product belong to one cat
            -(1 - many)
            -products table will have foreign key(cat_id) that refers to cats table

            example:
                cats : pc , laptop, mobile 
        
        -orders and products:
            -order can contain many products
            -one product can be ordered in many orders
            -(many-many)

            -so we need pivot table that contain 2foreign keys (order_id, product_id)
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    Create Tables:
        cats table:
            db/schema.sql:
                CREATE TABLE cats(
                    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    created_at DATETIME NOT NULL DEFAULT NOW(),
                    PRIMARY KEY(id)
                ); 
                
        products table:
            db/schema.sql:
                CREATE TABLE products(
                    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    `desc` TEXT NOT NULL,
                    price DECIMAL(8,2) NOT NULL,
                    pieces_no SMALLINT NOT NULL,
                    img VARCHAR(255) NOT NULL,
                    cat_id INT UNSIGNED,
                    created_at DATETIME NOT NULL DEFAULT NOW(),

                    PRIMARY KEY(id),
                    FOREIGN KEY(cat_id) REFERENCES cats(id) ON DELETE SET NULL
                );
                
                
                -desc is reserved keyword in sql (ASC, DESC)
                -so inorder to use it as a column name, we will put it in a backtick (`desc`)
                
                -price decimal(8,2) , so max price can be +999999.99
                -pieces_no SMALLINT , as pieces no won't be big
                
                -img , we will save img path, not img itself

                -foreign key:
                    -foreign key should have the same type of column it references
                    cat_id INT UNSIGNED

                    -cat_id can be null , so when we delete cat , its products cat_id can be null

                    -but we need to tell sql ,that when we delete cat ,set its products cat_id  null:
                        FOREIGN KEY(cat_id) REFERENCES cats(id) ON DELETE SET NULL
                    
        orders table:
            db/schema.sql:    
                CREATE TABLE orders(
                    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255),
                    phone VARCHAR(255) NOT NULL,
                    `address` VARCHAR(255),
                    `status` ENUM('pending', 'approved', 'canceled') NOT NULL DEFAULT 'pending',
                    created_at DATETIME NOT NULL DEFAULT NOW(),

                    PRIMARY KEY(id)
                );


            -name is name of user who ordered
            -user don't have to enter all of email, address, phone, we only need one way to contact user is his phone(so it is not null), 
            -while email, address are excessive  ,so they may be null

            -status :is status of order (pending, approved, canceled)
                
            -status and address may be reserved ,so we backtick just in case

        order_details table:
            db/schema.sql:
                CREATE TABLE order_details(
                    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    order_id INT UNSIGNED,
                    product_id INT UNSIGNED,
                    qty INT NOT NULL,
                    
                    PRIMARY KEY(id),
                    FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE SET NULL,
                    FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE SET NULL
                );

                -we made order_id, product_id can be null ,when we delete oder or product
                -and we told sql that:
                    order_id INT UNSIGNED,
                    product_id INT UNSIGNED,
                    FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE SET NULL,
                    FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE SET NULL,

                -we don't need here created_at as orderdetails is added at the same time order is added

        admins table:
            db/schema.sql:
                CREATE TABLE admins(
                    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    `password` VARCHAR(255) NOT NULL,
                    is_super ENUM('yes', 'no') NOT NULL DEFAULT 'no',
                    created_at DATETIME NOT NULL DEFAULT NOW(),

                    PRIMARY KEY(id)
                );

                -password is reserved in sql , so we put it inside backtick (`password`)
                -email is unique
    ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    Import SQL code:
        -go to techstore database 
        -import
        -choose your schema.sql file
        -go
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Seeding:
    -filling our tables with some data at first
    db/seed.sql:
        --cats table
        INSERT INTO cats (name)
        VALUES
        ('Laptops'),
        ('PCs'),
        ('Mobiles');

        --products table
        INSERT INTO products(name, `desc`, price, pieces_no, img, cat_id)
        VALUES
        ('lenovo laptop', 'this is dummy description for product', 15000, 10, '1.jpg', 1),
        ('dell laptop', 'this is dummy description for product', 10000, 10, '2.jpg', 1),
        ('hp laptop', 'this is dummy description for product', 8000, 8, '3.jpg', 1),
        ('lenovo thinkpad', 'this is dummy description for product', 13000, 5, '4.jpg', 1),
        ('pc 123', 'this is dummy description for product', 5000, 3, '5.jpg', 2),
        ('pc 456', 'this is dummy description for product', 6000, 4, '6.jpg', 2),
        ('pc 789', 'this is dummy description for product', 7000, 2, '7.jpg', 2),
        ('samsung ay 7aga', 'this is dummy description for product', 5000, 100, '8.jpg', 3),
        ('oppo ay 7aga', 'this is dummy description for product', 5500, 50, '9.jpg', 3),
        ('hwawei ay 7aga', 'this is dummy description for product', 5200, 30, '10.jpg', 3);

        --admins table
        INSERT INTO admins (name, email, `password`)
        VALUES
        ('Ahmed Fawzy', 'ahmed@admin.com', '$2y$10$oH2WrwvTWpZFfm3YiQmprODNFhd/cu3SJ2RR4OsAV9lmmMIcFh5vG');
        

    -then go to techstore database and import seed.sql into it
*/