/* 
mysql -u root  #connect to mysql
exit  #exit the connection
*/


CREATE DATABASE route35 COLLATE 'utf8_general_ci' ;
DROP DATABASE route35; 

/* 
database is same as schema in mysql
 */

SHOW DATABASES; #to show all databases

use route35; # to select certain database
select database(); #to get the current selected database;
select user(); #to get the username

select now(); == select current_timestamp(); == select current_timestamp;


CREATE TABLE users(
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    birthdate DATE,
    password VARCHAR(255) NOT NULL, 
    age INTEGER(3) UNSIGNED NOT NULL ,
    bio TEXT,   
    type ENUM('male', 'female') NOT NULL DEFAULT 'male',
    created_at DATETIME NOT NULL DEFAULT NOW(),
    PRIMARY KEY(id)
);


SHOW TABLES; # to show tables in database
desc users; # to show the table definitions

#to insert into columns
#md5() is a sql function store the password in encrypted form
insert into users(name, email, birthdate, password, age, type) value('ahmed', 'ahmed@gmail.com', '1998-03-21', md5('123'), 22 ,'male');

#we can use same insert to insert multiple records using word values
insert into users(name, email, birthdate, password, age, type) values('dina', 'dina@gmail.com', '2001-03-21', md5('321'), 13, 'female'),
('mai', 'mai@gmail.com', '1991-01-25', md5('333'), 30, 'female') ;

#if i didn't use the column names , i must enter all column record
insert into users value(4,'jack','jack@gmail.com','1998-03-21', md5('123'),NULL, 22 ,'male', now());

insert into users value(5,'james','james@gmail.com','1998-03-21', md5('123'), 22,NULL,'male',now());

#it will update all records
update users set bio= 'i am engineer';

#to update specific record we must set condition (where)
update users set bio = 'i am dina', name = 'dina ali' where email = 'dina@gmail.com';

#to duplicate the table(with all records) 
#but it will give error if new_users already exists
create table new_users as select * from users;

#to duplicate the table(with all records) 
#but it will not give error if new_users already exists
#it will only give warning
create table if not exists new_users as select * from users;

#to duplicate table structure only(without records) -->empty tables
create table users2 like users;

# to fill the empty table that we created  
insert into users2 select * from users;

#to empty the table (delete all records but keep the table)
delete from users2;

#to delete the table
drop table new_users;

#to delete table and not give error if i already deleted it
drop table if exists new_users;

#to delete specific record from a table
delete from users where email = 'james@gmail.com' and type = 'male';

#to get the statement of creating table
show create table users;

#to get the statement of creating database 
show create schema blog2;

#to alter table (add new column)
alter table users add country varchar(100) default 'Egypt';

#to alter (drop column) to table
alter table users drop column bio; 

# to alter(modify data type of column) table
# modify will remove the default value  in the new records so i must write it again if i want to
alter table users modify country varchar(50) default 'KSA';

# to change the column name , will remove the default value  in the new records so i must write it again if i want to.
alter table users change country user_country varchar(50) default 'Egypt';

# to reset the auto_increment start or number :
#you cannot reset the counter to a value less than or equal to any that have already been used
ALTER TABLE tablename AUTO_INCREMENT = 1;


#truncate table: deletes the data inside a table, but not the table itself.
#note that you can't truncate table if you have a foreign key 
truncate table table_name;

----------------constraints---------------------------------
drop table users;

create table users(
    id INTEGER unsigned primary key,
    name varchar(100) not null,
    birthdate date,
    email varchar(255) unique not null,
    mobile char(12) unique,
    password varchar(32) not null,
    gender enum('male', 'female') default 'male'
);


insert into users value(1, 'dina', null, 'dina@gmail.com', null, md5('123'), 'female');

update users set mobile = '01006654568' where id = 1;


----------------------select---------------------------
use hr;

#  * means all columns
select * from employees;


#to selects specific columns
select last_name, job_id, salary, department_id from employees;


#change column name during selecting only 
select last_name as name , job_id from employees;

select last_name as "emp name" , job_id from employees;


#to calculate expression  annual salary
select last_name as "emp name", salary * 12 as "annual_salary" from employees;

#to select distinct(non repeated) records
select distinct job_id from employees;


select distinct department_id,  job_id from employees;

#to order column by default ascending
select * from employees
order by salary asc;

#to order column descending
select * from employees
order by salary desc;

select last_name , salary
from employees
order by 2; # 2 means 2nd column which is salary

select last_name , salary
from employees
order by 2 desc;


#using multiple order if not by first column then order by second column
#if department is similar then order by salary

select last_name ,department_id , job_id ,salary
from employees
order by department_id, salary;


#for specific department
select last_name ,department_id , job_id ,salary
from employees
where department_id = 50
order by department_id, salary;

#for people with salary > 10000
select last_name ,department_id , job_id ,salary
from employees
where salary > 10000
order by department_id, salary;

/*
=
!= or <>
<=
>=
>
<
*/