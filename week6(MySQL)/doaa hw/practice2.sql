#2.1
select current_date();

#2.2
select employee_id, last_name, round(salary), round(salary*1.155) as New_Salary
from employees;

#2.3
select employee_id, last_name, round(salary), round(salary*1.155) as New_Salary, 
round(salary*1.155 - salary) as Increase
from employees;

#2.4
select concat(upper(substr(last_name,1,1)), lower(substr(last_name,2))) as name, char_length(last_name) as Length
from employees
where left(last_name,1) in ('A', 'M', 'J')
order by last_name;

#2.5
select last_name, round( ( year(now()) - year(hire_date))*12)  as MONTHS_WORKED
from employees
order by MONTHS_WORKED;

#2.6
select last_name, lpad(round(salary), 15, '$') as SALARY
from employees;

#2.7
select concat(left(last_name, 8) , space(10) , repeat('*', floor(salary/1000))) as EMPLOYEES_AND_THEIR_SALARIES
from employees
order by salary desc;

#2.8
#1 year = 52 weeks
select last_name, truncate( (year(now()) - year(hire_date)) *52, 0) as TENURE
from employees
where department_id = 90
order by TENURE desc;

#2.8 another solution
select last_name, truncate( datediff(now() , hire_date) / 7, 0) as TENURE
from employees
where department_id = 90
order by TENURE desc;
