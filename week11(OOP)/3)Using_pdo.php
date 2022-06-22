<pre>
<?php
/*
-->PDO(Php Data Objects):

    -when we use functions of mysqli database , and we want to use another database , then we rewrite different functions names , so we should not use functions, we will use pdo to access multiple database using same code , we will only change the connection code line

    -PHP pdo is a class

    -PHP PDO is a database access layer that provides a 
    uniform interface for working with multiple databases.

    -pdo allow us to deal with 12 different databases.

    -PDO allows you to work with any database that has a PDO driver available. PDO relies on database-specific drivers, e.g., PDO_MYSQL for MySQL, PDO_PGSQL for PostgreSQL, PDO_OCI for Oracle database, etc., to function properly. Here’s the complete list of PDO drivers.

    -PDO simplifies the common database operations including:

        -Creating database connections
        -Executing queries using prepared statements
        -Calling stored procedures
        -Performing transactions
        -And handling errors 

    -PDO has three classes : PDO, PDOStatement, PDOException 
//////////////////////////////////////////////////////////////
-->PDO_constructor(to start connection) parameters:
    1)-DSN(The Data Source Name), contains the information required to connect to the database.
    
    -In general, a DSN consists of the PDO driver name, followed by a colon, followed by the PDO driver-specific connection syntax
    
    -example on mysql:
        mysql:host=localhost;port=3306;dbname=testdb
    -example on MSSQL server:
        sqlsrv:Server=localhost;Database=testdb

    
    2)username 
    3)password

    example on starting connection with mysql:
        $pdo_cn = new PDO("mysql:host=localhost;port=3306;dbname=hr", "root", "");
//////////////////////////////////////////////////////////////
-->pdo close connection:
        -we don't have function to close , we put it as null
        $pdo_cn = null;
//////////////////////////////////////////////////////////////
-->PDO methods :
       1)PDO::query(query_name) : Prepares and executes an SQL statement
            -return : returns boolean (false) or an object from type PDOStatement that contains query string on success 
    
       2)PDO::prepare(query_string):Prepares a statement(query) for execution and returns a statement object
            parameters:
                -query_string
            return :
                -If the database server successfully prepares the statement ,it returns a PDOStatement object
                -If the database server cannot successfully prepare the statement, PDO::prepare() returns false or emits PDOException (depending on error handling)

            -statement should contain parameters to be binded with the values
    
////////////////////////////////////////////////////////
-->PDOStatement class :represents a statement(query string) and the results of the statement.

-->PDOStatement methods:
        1)PDOStatement::fetchObject() :Fetches the next row and returns it as an object from stdClass(similar to generics ,which is created at runtime according to query)
            -The stdClass is the empty class in PHP which is used to cast other types to objects. 

            -stdClass is useful to create dynamic objects with dynamic properties

            -stdClass object structure(properties) is build according to the written query
			
			Note:
				- we can give fetchObject("class_name") : to return object from this class 
        
		
		2)PDOStatement::fetchAll(int mode_optional) — Fetches All rows from a result set
			Description :
				-public PDOStatement::fetchAll(int $mode = PDO::FETCH_DEFAULT): array  -->default mode(return indexed + assoctiative  array)
				
				-public PDOStatement::fetchAll(int $mode = PDO::FETCH_CLASS, string $class): array  (return associative array) (Returns instances of the specified class, mapping the columns of each row to named properties in the class.)
																														
				-public PDOStatement::fetchAll(int $mode = PDO::FETCH_COLUMN, int $column): array																											
																														
				-public PDOStatement::fetchAll(int $mode = PDO::FETCH_FUNC, callable $callback): array
				
				
			paramaters:
			 -mode
				Controls the contents of the returned array as documented in PDOStatement::fetch(). Defaults to value of PDO::ATTR_DEFAULT_FETCH_MODE (which defaults to PDO::FETCH_BOTH)

				To return an array consisting of all values of a single column from the result set, specify PDO::FETCH_COLUMN. You can specify which column you want with the column parameter.

				To fetch only the unique values of a single column from the result set, bitwise-OR PDO::FETCH_COLUMN with PDO::FETCH_UNIQUE.

				To return an associative array grouped by the values of a specified column, bitwise-OR PDO::FETCH_COLUMN with PDO::FETCH_GROUP.
			
        
		3)PDOStatement::bindParam(param, variable_value ,type): Binds a parameter to the specified variable name

            parameters:
                param:
                    -Parameter identifier. For a prepared statement using named placeholders, this will be a parameter name of the form :name. For a prepared statement using question mark placeholders, this will be the 1-indexed   position of the parameter.

                variable_value:
                    Name of the PHP variable to bind to the SQL statement parameter.
                
                type(optional):
                    -Explicit data type for the parameter using the PDO::PARAM_* constants:
                
            PDO::PARAM_* constants:
                -PDO::PARAM_BOOL :Represents a boolean data type.

                -PDO::PARAM_INT:Represents the SQL INTEGER data type.

                -PDO::PARAM_STR :Represents the SQL CHAR, VARCHAR, or other string data type.

                -PDO::PARAM_NULL :Represents the SQL NULL data type.
		
		4)PDOStatement::bindValue(param, variable_value ,type): Binds a parameter to the value or variable
			
			-With bindParam, you can only pass variables ; not values
			-With bindValue, you can pass both (values, obviously, and variables)
			
            parameters:
                param:
                    -Parameter identifier. For a prepared statement using named placeholders, this will be a parameter name of the form :name. For a prepared statement using question mark placeholders, this will be the 1-indexed   position of the parameter.

                variable_value:
                    Name of the PHP variable to bind to the SQL statement parameter.
                
                type(optional):
                    -Explicit data type for the parameter using the PDO::PARAM_* constants:
                
            PDO::PARAM_* constants:
                -PDO::PARAM_BOOL :Represents a boolean data type.

                -PDO::PARAM_INT:Represents the SQL INTEGER data type.

                -PDO::PARAM_STR :Represents the SQL CHAR, VARCHAR, or other string data type.

                -PDO::PARAM_NULL :Represents the SQL NULL data type.
		
        5)PDOStatement::execute() :Executes a prepared statement
            return : Returns true on success or false on failure.
			
	

/////////////////////////////////////////////////////////////
-->SQL Injection:
    -SQL injection is a code injection technique that might destroy your database.

    -SQL injection is one of the most common web hacking techniques.

    -SQL injection usually occurs when you ask a user for input, like their username/userid, and instead of a name/id, the user gives you an SQL statement that you will unknowingly run on your database.

    example :
        txtUserId = getRequestString("UserId");
        
        txtSQL = "SELECT * FROM Users WHERE UserId = " + txtUserId;

        1)SQL Injection Based on 1=1 is Always True:

            -UserId:  105 OR 1=1
            -SELECT * FROM Users WHERE UserId = 105 OR 1=1;

            -The SQL above is valid and will return ALL rows from the "Users" table, since OR 1=1 is always TRUE.
            
            -SELECT UserId, Name, Password FROM Users WHERE UserId = 105 or 1=1;

            -Hacker might get access to all the user names and passwords in a database, by simply inserting 105 OR 1=1 into the input field.
            
        2)SQL Injection Based on ""="" is Always True:

            -sql = 'SELECT * FROM Users WHERE Name ="' + uName + '" AND Pass ="' + uPass + '"';
                        
            -if the user entered name (John Doe) , password (myPass)

            -result will be :SELECT * FROM Users WHERE Name ="John Doe" AND Pass ="myPass"

            -A hacker might get access to user names and passwords in a database by simply inserting " OR ""=" into the user name or password text box:
                    User Name:" or ""="
                    Password: " or ""="

            -result will be : SELECT * FROM Users WHERE Name ="" or ""="" AND Pass ="" or ""="";
            
        3)SQL Injection Based on Batched SQL Statements :
            
            -txtSQL = "SELECT * FROM Users WHERE UserId = " + txtUserId;
            -User id : 105; DROP TABLE Suppliers

            -result will be :SELECT * FROM Users WHERE UserId = 105; DROP TABLE Suppliers;




///////////////////////////////////////////////////////
-->How PDO prepared statements prevent Sql Injections:

    1)Parsing :Syntax error and misspelling checks are performed to ensure the validity of the SQL query.

    2)Semantics Check:Does the specified columns and table exist? Does the user have privileges to execute this query?

    3)Binding:
    -The query is converted into a format understandable by machines: byte code. Next, the query is compiled.
    
    -the database engine detects the placeholders, and the query is compiled with placeholders(no replacement). The user-supplied data will be added later.

    4)cache:The query is stored in cache, so next time when the same query is executed it will skip the first four steps and jump straight to the execution.

    5)Between Cache and Execution:, there is an additional step: Placeholder Replacement. At this point, the placeholders are replaced with the user’s data. However, the query is already pre-compiled (Binding), so the final query will not go through compilation phase again. For this reason, the user-provided data will always be interpreted as a simple string and cannot modify the original query’s logic. Thus, the query will be immune to SQL Injection vulnerabilities for that data.

    6)Execution:The query is executed and the results are returned to the user.
//////////////////////////////////////////////////////////////
-->PDO prepared statements steps:

    1)Prepare an SQL query with empty values as placeholders with either a question mark or a variable name with a colon preceding it for each value
    
    2)Bind values or variables to the placeholders
    
    3)Execute query simultaneously
/////////////////////////////////////////////////////////////

*/

//open connection
$pdo_cn = new PDO("mysql:host=localhost;port=3306;dbname=hr", "root", "");

var_dump($pdo_cn);

// $rslt = $pdo_cn->query("insert into regions values(999,'aaa')");

// var_dump($rslt);

$rslt = $pdo_cn->query("select region_id id, region_name name from regions"); //PDOStatement object
// var_dump($rslt);

//brings every row
while($obj = $rslt->fetchObject()){
    // var_dump($obj);
    // echo "<br>";
    echo $obj->id, " ", $obj->name, "<br>";
}


//close connection
$pdo_cn = null;
?>
</pre>