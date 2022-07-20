/*
Important Terms(مصطلحات) in Database:
    column = field
    row = record
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
To see Design of database(Schema)(ERD Diagram) in PhpMyAdmin:
    -go to your database
    -More -->Designer
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
ERD:
    E --> entitiy : our tables/entities
    R --> Relationships between tables
    D --> Diagram (drawings of tables)

    -there are many ways to draw erds
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Foreign Key:
    Example:
        we want to posts table , that will have relations with users table

        -we want to make column that points to id of user in users table
        -this column must be of same datatype of id of user
        -and mark this column as foreign key
        -our column can be NULL or NOT NULL

        -posts table:
            id(pk) --> INTEGER UNSIGNED AUTO_INCREMENT
            title --> VARCHAR(255) NOT NULL
            body --> TEXT NOT NULL
            created_at --> DATETIME DEFAULT NOW()
            user_id(foreign key) --> INTEGER UNSIGNED NOT NULL
            
            SOLUTION:
                CREATE TABLE posts(
                    id INTEGER UNSIGNED AUTO_INCREMENT,
                    title VARCHAR(255) NOT NULL,
                    body TEXT NOT NULL,
                    user_id INTEGER UNSIGNED NOT NULL,
                    created_at DATETIME NOT NULL DEFAULT NOW(),
                    PRIMARY KEY(id),
                    FOREIGN KEY(user_id) REFERENCES users(id)
                );
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Relationships:
    1 to 1
    1 to many
    many to many

    one to one(1-1):
        -if we have users table and want to same their contacts in contacts table
        -lets suppose that each user will have one contact only and each contact belongs to one user

        -where will we put our foreign key ? in users table or contacts table ?
            -user has the contact
            -parent has children, so children takes from parent
            -so in contacts table ,we will put user_id foreign key

            -because we can have user without contact , but we can not have contact without user
            -not all users have contacts 

        users table:
            id
        contacts table:
            user_id

        Example:
            users:
                1 kareem
                2 akram

            contacts
                1 1(user_id)
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    one to many(1-*):
        -if we have users table and posts table
        -one user can have many posts , but each post belongs to only one user

        -where will we put our foreign key ? in users table or posts table ?
            -parent has many children
            -so we will put foreign key in children
            -in posts id we will put user_id

        users table:
            id
        posts table:
            user_id
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    many to many(*-*):
        -if we have products table and orders table
        -one product can be ordered in many orders(many)
        -while one order can have many products(many)

        -where will we put our foreign key ? in products table or orders table ?
            -we will make new table called pivot table
            -we will name this table order_products
            -this pivot table will contain 2 foreign keys:
                product_id : to refer to products table
                order_id : to refer to orders table
        
        products table:
            id
        orders table:
            id
        order_products table(pivot table):
            product_id
            order_id
            
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


ckeditor:
    -js library when applied on text area , it turns it to be like word
    -so we can add styling (bold, italic, ....)
    
    -summernote library is like ckeditor library

*/