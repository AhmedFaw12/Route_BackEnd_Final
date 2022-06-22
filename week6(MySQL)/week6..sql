# select where =
select * 
from employees
where department_id = 50;

# select where =
select *
from employees 
where department_id != 50;


#to select column which is empty , use is null
select *
from employees 
where department_id  is null;

#to get both null and != 50
select * 
from employees
where department_id != 50 or department_id is null;

# >=
select *
from employees 
where salary >= 10000;


#to get a range of salary (6000, 10000) inclusive using and
select * 
from employees
where salary >= 6000 and salary <= 10000
order by salary;

#to get a range of salary (6000, 10000) inclusive using between 
select * 
from employees
where salary BETWEEN  6000 and 10000
order by salary;


# NOT BETWEEN
select * 
from employees
where salary NOT BETWEEN  6000 and 10000
order by salary;


#writing multiple conditions on same column using or
select * 
from employees
where department_id = 30 or department_id = 50 or department_id = 20;

#writing multiple conditions on same column using in(without repeating column name)
select * 
from employees
where department_id in (50, 30, 20);

#NOT IN
select * 
from employees
where department_id not in (50, 30, 20);


#in , not in will not include null values
# if i want to add null values , i have to add extra or condition either with in or not in 
select * 
from employees
where department_id not in (50, 30, 20) or department_id is null;



/*
like 
The percent sign (%) represents zero, one, or multiple characters
The underscore sign (_) represents one, single character
*/


#match whole word using =
select * 
from employees 
where last_name = 'king';

#like 'king' same as = 'king'
select * 
from employees 
where last_name like 'king';

#contain 'ing' at the end preceeded by any number of characters
select * 
from employees 
where last_name like '%ing';

#contain 'ee' with any number of characters before and after it 
select * 
from employees 
where last_name like '%ee%';

#must contain 'ee' after exactly first character and with any number of characters after 'ee'
select * 
from employees 
where last_name  like '_ee%';

#must not contain 'ee' after exactly first character and with any number of characters after 'ee'
select * 
from employees 
where last_name not like '_ee%';

#start with c or end with a 
select * 
from employees
where (last_name like 'c%' or last_name like '%a') 
and department_id = 50;

#get all employees that were hired at month 03 using like
#'1999-03-04' so we will use 5 underscores then 03 then %
select *
from employees
where hire_date like '_____03%';

#get all employees that were hired at month 03 using like
#another solution : month 03 has 1 hash before and 1hash after it 
select *
from employees
where hire_date like '%-03-%';

#get all employees that were hired at month 03 using month function 
#month(date) will extract month out of date
select *
from employees
where month(hire_date) = 3;

#get all employees hired at 2004 year using year() function
# year()
select * 
from employees 
where  year(hire_date) =2004;
/*
comparison operator in mysql
=
!= , <>
>
>=
<
<=
is null : for empty 
is not null : for not empty
between x and y :Between two values (inclusive)

NOT BETWEEN 
IN(x, y, z, ......) :Match any of a list of values 
NOT IN(x, y, z, ....)
LIKE _ % : search for pattern
NOT LIKE _% 
*/


select now()  , current_date() , current_time(), current_timestamp(), current_timestamp;

select date(now())  , time(now()) ,year(now()) , hour(now());
/*
mysql date functions

now() -->2022-02-01 15:37:10 
current_date() -->2022-02-01
current_time() -->15:37:10
current_timestamp() -->2022-02-01 15:37:10
current_timestamp --> 2022-02-01 15:37:10
date(expression maybe date or datetime) -->2022-02-01
time(expression) -->15:39:51
year(expression maybe date or datetime) --> 2022

hour(expression) -->15
month(expression like'1993-03-23') -->03
day(expression) --> 23
*/


#practice 2.4 Write a query that displays the last name (with the first letter in uppercase and all the other letters in lowercase) and the length of the last name for all employees whose name starts with the letters “J,” “A,” or “M.” 
select last_name, length(last_name) as length
from employees
where last_name like 'J%' or last_name like 'A%' or last_name like 'M%' 
order by last_name;

#practice 2.4 another solution using substr() function
select last_name, length(last_name) as length
from employees
where substr(last_name, 1, 1) in ('A', 'J', 'M')
order by last_name;

#practice 2.4 another solution using left() function
select last_name, length(last_name) as length
from employees
where left(last_name, 1) in ('A', 'J', 'M')
order by last_name;

select left('doaa' ,2) ;  -- do
select right('doaa' ,2) ;  -- aa
select substr('doaa' ,2 , 2) ;  -- oa
select substr('doaa' ,2 ) ;  -- oaa

select length('أحمد'); -- 8 bytes
select length('ahmed'); -- 5 bytes

select char_length('أحمد'); -- 4 char
select char_length('ahmed'); -- 5 char

/*
LENGTH(string) : returns the length of a string in bytes.
where 1 english letter is stored in 1 byte
while 1 arabic letter is stored in 2 bytes

CHAR_LENGTH() function return the length of a string (in characters)

SUBSTR(string, start, length) :extracts a substring from a string (starting at any position).
where start index in mysql starts from 1 not 0

LEFT(string, number_of_chars):extracts a number of characters from a string (starting from left).

RIGHT(string, number_of_chars):extracts a number of characters from a string (starting from right).
*/

--------------------------------------------------------------

/*
    -if i want to store image or video in database use datatype blob
    -blob(binary large object)
    -blob can store up to 2GB in database
    -but blob makes database more slower and searching inside database becomes very slow 

    alternative solution for storing image is to put image on server and give database the path
*/

/*
    foreign key
    i want to link user_id in posts table with id(primary key) in users table 
    -we always references on primary key
*/


create table posts(
    id int primary key auto_increment,
    title varchar(255) not null,
    body text,
    media varchar(255) default 'posts/default_post.png',
    created_at timestamp default current_timestamp,
    user_id int
);



drop table users;

create table users(
    id int primary key,
    name varchar(100) not null,
    birthdate date,
    email varchar(255) unique not null,
    mobile char(12) unique,
    password varchar(32) not null,
    gender enum('male', 'female') default 'male'
);


#two ways to add foreign key (outside the table) using alter
alter table posts 
add constraint fk_posts_user_id 
foreign key(user_id) 
references users(id);


insert into posts(title, user_id) values('toys', 1);
insert into posts(title, user_id) values('gamess', 1);

#gives error as there is not id 10 in users table
insert into posts(title, user_id) values('playstations', 10);

#second way to add foreign key(inside table) while creating
create table posts(
    id int primary key auto_increment,
    title varchar(255) not null,
    body text,
    media varchar(255) default 'posts/default_post.png',
    created_at timestamp default current_timestamp,
    user_id int,
    CONSTRAINT fk_posts_user_id 
    FOREIGN KEY (user_id) 
    REFERENCES users (id)
);


#to remove constraint
alter table posts 
drop foreign key `fk_posts_user_id`;




show create table posts;
/*
CREATE TABLE `posts` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `title` varchar(255) NOT NULL,
   `body` text DEFAULT NULL,
   `media` varchar(255) DEFAULT 'posts/default_post.png',
   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
   `user_id` int(11) DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `fk_posts_user_id` (`user_id`),
   CONSTRAINT `fk_posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4
 */



 /*
    we can use `` --> back tick where variable name can contain spaces
 */
 create database `my db`;
 drop schema `my db`;



# can't delete or update id = 1 since it is foreign key in posts table
delete from users where id = 1;
UPDATE users SET `id` = '10' WHERE (`id` = '1');


/*
Error Code: 1451. Cannot delete or update a parent row: 
a foreign key constraint fails (`blog2`.`posts`, 
CONSTRAINT `fk_posts_user_id` FOREIGN KEY (`user_id`) 
REFERENCES `users` (`id`))

*/

#can delete id = 3 since it doesn't exists in posts table
delete from users where id = 3;


#if i want to update id = 1 to 10 , so i must also update the users_id from 1 to 10 in posts table:
# by determing delete and update behaviour while creating foreign key

#i can't alter foreign key , so i must delete it and create it again
alter table posts 
drop foreign key `fk_posts_user_id`;

alter table posts
add constraint `fk_posts_user_id`
foreign key(user_id)
references users(id)
on update cascade 
on delete set null;

/*
on update cascade : when update in parent table , update also in child table

on update set null :when update in parent table , make its ids in child table null

on delete cascade :  when delete in parent table , delete also in child table

on delete set null : when delete in parent , make its ids in child table null

*/

alter table posts 
drop foreign key `fk_posts_user_id`;

alter table posts
add constraint `fk_posts_user_id`
foreign key(user_id)
references users(id)
on update set null
on delete cascade;

/*
we can make ER diagram using workbench:
File -> New Model --> add diagram

- in workbench it will not only draw the diagram but also create its script without writing myself

-create new database:
1)double click on mydb

2)name : -----

3)charset: how many bytes to store the character
- latin store character in 1 byte
-utf8 store character in 2 bytes for some characters like arabic , supports arabic
-utf8mb4 store character in 4 bytes in case of emojis, ...

4)collation :for comparison text with another text
-for example caseSensitive or inSensitive

-anything which ends with (ci) are case Insensitive
-anything which ends with (bin or cs) are case Sensitive

- we will choose general or unicode which is good for arabic or english or emojis or ...

- we will choose utf8mb4_general_ci

- in MySQL we change collate at database level or table level or column level
for example the whole table will be inSensitive but at password column we can make it Case Sensitive

-in MySQL default is InSensitive
-While in Oracle default is Case Sensitive

*/


/*
we can create table:
1)click on table icon from side bar
2)click on empty place to place the table
3)double click on table to change name
4) add columns definitions:
- pk (primary key)
- NN (NOT NULL)
- UQ (UNIQUE)
- AI (AUTO_INCREMENT)
-
*/


#relations
/*
    1 - many
    1 - 1
    many - many
*/

/*
- created_by will reference id in same table
where one admin can create many users (1 to many)
while one user can be created by only one admin(1 to 1)

so overall relation (1 to many)

- brands has 1 to many categories
- also categories has 1 to many brands
then overall relation (many to many) so it will contain too many redundants records

so we will make third table products and link it with both brands table by 1 to many relation 
and with categories table by 1 to many relation , this is called normalization ( decrease redundancy)


- one seller may have many products but one product has one seller so 1 to many relation between products and users


-product may have many images so 1 to many relation between products table and product_images table

- 1user may have many contacts so 1 to many relation between users table and contacts table

- 1 user may have many orders so 1 to many relation between users table and orders table

- 1 contact may have many orders so 1 to many relation between contacts table and orders table

- 1 product may be in many orders as with different qty
, also 1 order may have many products so many to many relation between orders table and products table,
so we need third table order_items with relation 1 to many with orders table and 1 to many relation with products table 
*/


/*
-we can save our erd diagram as image :
file --> export -->export as png

- we can Save our erd diagram as script:
file--> export --> forward engineer create script

- but workbench will add keyword visible which is available on mysql 8 and not available on mariadb that we have 
so when we open the script we need to remove visible keyword before running the script.
*/


--more examples of erd diagrams https://drawsql.app/templates/popular 


---------------------------------------------------------

/*
see mySql slides 2 from page 6

# functions in mySql has 2 types:
1) single row functions : functions return one result per row
2) multi row (aggregate) functions  :return one per set of rows

*/


/*
string functions:
1)LENGTH(string) : returns the length of a string in bytes.
where 1 english letter is stored in 1 byte
while 1 arabic letter is stored in 2 bytes

2)CHAR_LENGTH() function return the length of a string (in characters)

3)SUBSTR(string, start, length) :extracts a substring from a string (starting at any position).
where start index in mysql starts from 1 not 0

4)LEFT(string, number_of_chars):extracts a number of characters from a string (starting from left).

5)RIGHT(string, number_of_chars):extracts a number of characters from a string (starting from right).

6) CONCAT(arg1, arg2, ...) Return concatenated string

7) INSTR() Return the index of the first occurrence of substring

8) TRIM() Remove leading and trailing spaces

9)UPPER() & LOWER(): 	Return the argument(whole word) in uppercase  - lowercase

10) SPACE(n) put n spaces

11) REPEAT(string, number) :  repeats a string as many times as specified.

12) RPAD(string, length, rpad_string):  right-pads a string with another string, to a certain length.
عاوز مثلا الاسم يتكتب فى عدد حروف معين و بكمل الباقى بحاجة معينة ولو الاسم بتاعى اكبر من عدد الحروف هيقص الاسم

13)LPAD(string, length, lpad_string):left-pads a string with another string, to a certain length.
*/

select left('doaa' ,2) ;  -- do
select right('doaa' ,2) ;  -- aa
select substr('doaa' ,2 , 2) ;  -- oa
select substr('doaa' ,2 ) ;  -- oaa

select length('أحمد'); -- 8 bytes
select length('ahmed'); -- 5 bytes

select char_length('أحمد'); -- 4 char
select char_length('ahmed'); -- 5 char


#get the first 3 letters from last_name from table employee
select last_name, left(last_name, 3) from employees;

#get the last 3 letters from last_name from table employee
select last_name, right(last_name, 3) from employees;

#if i want to combine both results using concat function
select last_name, concat( left(last_name, 3),right(last_name, 3)) from employees;

#if i want to make password from first 3 letters of first name and last 3 letters from last name from table employees
select first_name, last_name, concat( left(first_name, 3),right(last_name, 3)) as password 
from employees;

#example on repeat()
select concat('ahmed' , repeat('x' ,10) ,'ali' )  rslt;  --'ahmedxxxxxxxxxxali'



#example on rpad()
select concat(rpad('ahmed' ,10,' ')   ,'ali' )  rslt; -- ahmed     ali

#example on rpad()
select concat(rpad('ahmed abdelrahman' ,10,' ')   ,'ali' )  rslt; -- ahmed abdeali

#example on lpad()
select concat(lpad('Ahmed' ,10,' ')   ,'ali' ); --              Ahmedali

#examples
select last_name , lpad(round(salary) ,8 , 0) sal
from employees;

#example on lpad and rpad
select last_name , lpad(rpad(round(salary) ,8 , 'X') ,12,'X') sal
from employees; -- XXXX17000XXX
----------------------------------------------------------
/*
union:
The UNION operator is used to combine the result-set of two or more SELECT statements.

-Every SELECT statement within UNION must have the same number of columns
-The columns must also have similar data types
-The columns in every SELECT statement must also be in the same order

*/

#example The UNION operator selects only distinct values by default. To allow duplicate values, use UNION ALL:
select concat('ahmed' , space(10) ,'ali' )  rslt , 15000 sal
union 
select concat('abd elrahman' , space(10) ,'ali' ) rslt ,null
union 
select concat('ahmed' , space(10) ,'ali' )  rslt , 15000 ;

#example To allow duplicate values, use UNION ALL:
select concat('ahmed' , space(10) ,'ali' )  rslt , 15000 sal
union all
select concat('abd elrahman' , space(10) ,'ali' ) rslt ,null
union all
select concat('ahmed' , space(10) ,'ali' )  rslt , 15000 ;


#example to allow order by , we must put it with last statement , we must also put alias with the first statement 
select concat('ahmed' , space(10) ,'ali' )  rslt , 15000 sal
union all
select concat('abd elrahman' , space(10) ,'ali' )  ,null 
union all
select concat('ahmed' , space(10) ,'ali' )  rslt , 15000 
order by 2 desc;


----------------------------------------------------------
/*
- alias column name during display can be put between " "
- while original column(table) name is put between ` `
- litterals(where last_name like 'A%') is put between ' '
- as is optional
*/

#example 
select `first_name`  "First Name" , last_name, 
concat( left(first_name, 3),right(last_name, 3)) as password 
from `employees`
where last_name like 'A%';

#Example on instr()
SELECT INSTR('New horizons', 'New'); -- 1    

SELECT INSTR('New horizons', 'old'); -- 0

SELECT INSTR('ahmed', 'h');     -- 2

SELECT INSTR('ahmed', 'hx'); -- 0
SELECT INSTR('ahmed ali ', 'a'); -- 1 (first occurence of a)


#example on trim()
SELECT TRIM('  BAR  ');	--BAR

#Example on lower()
select lower('AHMED'); --ahmed
#example on upper()
select upper('ahmed'); --AHMED

#example on SPACE()
SELECT SPACE(6);

SELECT CONCAT('ahmed', SPACE(10), 'fawzy'); --ahmed          fawzy (it will put 10 spaces between ahmed and fawzy)


-------------------------------------------------------
/*
NUMERIC Functions:

1)ABS()	Return the absolute value

2)POW() or POWER() Return the argument raised to the specified power

3)Round():  Round the argument(بتقرب الكسور)

4)Mod():	Return the remainder

5) TRUNCATE() : Truncate to specified number of decimal places

*/

#examples

select abs(-10);         -- 10
select pow(10,2)	     --100
select mod(10,2);        --0
select round(10.57);     --11
SELECT TRUNCATE(1.293,1);--1.2


-----------------------------------------------------------

/*
mysql date functions

1)now() -->2022-02-01 15:37:10 
2)current_timestamp() -->2022-02-01 15:37:10
3)current_timestamp --> 2022-02-01 15:37:10 (synonym : name without ())

4)current_date() -->2022-02-01
current_time() -->15:37:10

4)time(expression) -->15:39:51
5)date(expression maybe date or datetime) -->2022-02-01
6)year(expression maybe date or datetime) --> 2022

7)hour(expression) -->15
8)month(expression like'1993-03-23') -->03
9)day(expression) --> 23

10)str_to_date() : date in mysql must be written in this format('1993-03-23'), so if i want to enter date in different format , i must convert it to mysql date format by using str_to_date()

str_to_date('myformat', 'explaining it')


11)DATE_FORMAT(date, format):formats a date as specified.
if i want to change mysql format to another format i want
format:
%D	Day of the month as a numeric value, followed by suffix (1st, 2nd, 3rd, ...)
%d	Day of the month as a numeric value (01 to 31)
%M	Month name in full (January to December)
%m	Month name as a numeric value (00 to 12)
%Y	Year as a numeric, 4-digit value
%a	Abbreviated weekday name (Sun to Sat)
%b	Abbreviated month name (Jan to Dec)
%H	Hour (00 to 23)
%h	Hour (00 to 12)

12)DATE_ADD(date, INTERVAL value addunit) :adds a time/date interval to a date and then returns the date.
addunit:
SECOND
MINUTE
HOUR
DAY
WEEK
MONTH
YEAR
DAY_SECOND
DAY_MINUTE
DAY_HOUR
YEAR_MONTH
MINUTE_SECOND
HOUR_MICROSECOND
HOUR_SECOND
HOUR_MINUTE

13)DATE_SUB(date, INTERVAL value interval) :subtracts a time/date interval from a date and then returns the date.

14)DATEDIFF(date1, date2) returns the number of days between two date values.
*/

#example on str_to_date()
select * from employees 
where hire_date > str_to_date( '01/01/2004' ,'%d/%m/%Y') order by hire_date; 

#example on DATE_FORMAT()
select last_name,
DATE_FORMAT(hire_date, '%D/%M/%Y') as start_date --17th/June/2003
from employees;

#example on date_format()
select last_name,
DATE_FORMAT(hire_date, '%D-%M-%Y') as start_date
from employees;


#Example on date_add()
SELECT DATE_ADD("2017-06-15 09:34:21", INTERVAL 15 MINUTE);--2017-06-15 09:49:21

#Example on date_add()
SELECT DATE_ADD('2017-06-15 09:34:21', INTERVAL '1 10' HOUR_MINUTE);--2017-06-15 10:44:21

#Example on date_sub()
SELECT DATE_SUB('2017-06-15 09:34:21', INTERVAL 3 DAY);--2017-06-12 09:34:21

#Example on date_sub()
SELECT DATE_SUB('2017-06-15 09:34:21', INTERVAL -3 MONTH);--2017-09-12 09:34:21

#Example on DATEDIFF()
SELECT DATEDIFF('2017-06-25 09:34:21', '2017-06-15 15:25:35');
--10 

#Example on DATEDIFF()
SELECT DATEDIFF('2017-06-05 09:34:21', '2017-06-15 15:25:35');
-- (-10) 

#Examples
select date_add( now() , Interval 10 day) rslt ;
select date_add( now() , Interval 10 year) rslt ;
select date_sub( now() , Interval 5 hour) rslt ;

#Example how many weeks between two dates
select last_name , round(datediff( now() ,  hire_date ) /7) weeks
from employees;


select date_sub( now() , Interval 39 year) rslt ;

#to know my age
select datediff( now() , '1997-05-30')/365.25 rslt ;

#i want to know employees who worked for 15 years or more
select * from employees 
where year(hire_date) <= year(now()) -15;

#another solution
select * , datediff(now() , hire_date)/365.25 as years_of_work 
from employees  
where datediff(now() , hire_date)/365.25 >= 15;

---------------------------------------------------

/*
different functions

1)LAST_INSERT_ID(expression):returns the AUTO_INCREMENT id of the last row that has been inserted or updated in a table.

2)row_count() :	returns The number of rows updated

3)DATABASE()	Return the default (current) database name

4)SCHEMA()	Synonym for DATABASE()

5)USER()	The user name and host name provided by the client
6)SESSION_USER()  Synonym for USER()
7)SYSTEM_USER() Synonym for USER()

8)IFNULL(expression, alt_value) : returns a specified value if the expression is NULL.
If the expression is NOT NULL, this function returns the expression.

*/

#example on LAST_INSERT_ID()
insert into users(name) value('Ahmed');
select LAST_INSERT_ID(); -- 1

#example 
update users set name = 'memo';
select row_count(); -- hpw many rows affected

#example
SELECT IFNULL("Hello", "W3Schools.com"); -- Hello

#example
SELECT IFNULL(NULL, 500); --500

-----------------------------------------------------------

/*
grouping(multi-row)(aggregate) functions :
Group functions operate on sets of rows to give one result per group.

1)sum()
2)max()
3)min()
4)avg()
when i have 100 employees , all of them have salaries except 10 , so the avg will be calculated for the 90 employees only

5)count() : when you count , count something has value (primary key)

restrictions for group functions:
- can not select anything else with group functions except for special condition
- can not use group functions with where , but we can use single row function with where 

-we can use having with group functions 
-we can use where with group functions if we used subqueries(using another select statement)

-we can select something with group functions if we are using group by

- we can use min , max on numbers, dates where recent date is max while old date is min , text where a is min while z is max
- sum , avg must be performed on numbers
*/ 

#examples
select sum(salary), max(salary), min(salary), avg(salary)
from hr.employees;  

#example (all employees have id)
select count(employee_id)
from hr.employees;--107

#example (not all employees has commision)
select count(commission_pct) from hr.employees; --35

#example
select count(department_id), count(manager_id)
from hr.employees; -- 106 106


#example on wrong select(دى غلط)
#كدا هيجبلى اول ريكورد فقط و هيجيب الاقل مرتب
select min(salary) , last_name from employees;

#example gives error
select min(salary)
from employees
where min(salary) > 1500;

#example with having
select min(salary)
from employees
having min(salary) > 1500; --2500


#example of subqueries
select * from employees
where salary = (select min(salary) from employees);


#example count employees in department 50 , department 30, department 20 discretly
select count(*) from employees where department_id = 50;
select count(*) from employees where department_id = 30;
select count(*) from employees where department_id = 20;


#another solution using group by
select department_id ,count(*) 
from employees 
group by department_id;


#we can select more 
select department_id, job_id ,count(*) 
from employees 
group by department_id, job_id;

#we want to put condition on count 
select department_id, job_id ,count(*) 
from employees 
group by department_id, job_id
having count(*) >= 5;


#example
select count(department_id) from employees; -- 106 but some results are repeated
select count(distinct department_id) frm employees; -- 11


---------------------------------------------------
#hw is practice 1,2,3