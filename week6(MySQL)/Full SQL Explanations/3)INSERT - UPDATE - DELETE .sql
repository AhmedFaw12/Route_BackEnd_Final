/*
INSERT record/row:
    syntax:
        INSERT INTO `tablename` (`col1`, `col2`, …) VALUES (val1, val2)

        -we determine columns to be inserted as there are other columns that have default values and other columns that have auto increment

        -columns name don't need to be in same order as they are in database itself

        -when we enter value of varchar/text(string) column, we put value between single or double quotes ("value" or 'value')

    Example:
        rote35 database:
            users table:
                INSERT INTO users (name, age, email)
                VALUES ('kareem fouad', 26, 'kareem@gmail.com')

                INSERT INTO users (name, age, email, bio, type)
                VALUES ('Ahmed Fawzy', 25, 'Ahmed@gmail.com', 'this is bio', 'admin')
    
    Example2:
        -if we want to insert multiple rows/records using one insert query
        rote35 database:
            users table:
                INSERT INTO users (name, age, email)
                VALUES ('mai hussein', 26, 'mai@gmail.com'),
                ('salma hussein', 22, 'salma@gmail.com'),
                ('sara hussein', 23, 'sara@gmail.com'),
                ('Mohamed Mostafa', 28, 'Mohamed@gmail.com');

    Example3:
        -we can insert some values for users and null for other users
        rote35 database:
            users table:
                INSERT INTO users (name, age, email, bio)
                VALUES ('ali hussein', 26, 'ali@gmail.com', 'this is bio'),
                ('zaki hussein', 22, 'zaki@gmail.com', NULL)
                ;
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Update record:
    Syntax:
        UPDATE `tablename` set `col1` = val1

    Example:
        UPDATE users SET 
        type ='user' 

        -this will change type field in all records

        -so to solve this , we need to specify the user:
            UPDATE users SET 
            type ='user'
            WHERE id = 2; 

    Example2:
        UPDATE users SET 
        bio ='this is new bio'
        WHERE id >= 3;

    Example3:
        -update multiple fields/columns in one update query
        
        UPDATE users SET 
        bio ='this is new bio',
        type = 'user'
        WHERE id >= 3;
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Delete record:
    Syntax:
        DELETE FROM `tablename`
        
        -all rows will be deleted unless you specify a where condition

    Example:
        DELETE FROM users
        WHERE id = 7;
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


*/