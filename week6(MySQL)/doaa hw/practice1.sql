#1.1
select last_name, round(salary)
from employees
where salary > 12000
order by salary;


#1.2
select last_name, department_id
from employees
where employee_id = 176;

#1.3
select last_name, round(salary)
from employees
where salary not between 5000 and 12000
order by salary desc;

#1.4
select last_name, job_id, hire_date
from employees
where last_name in('Matos', 'Taylor')
order by hire_date;

#1.5
select last_name, department_id
from employees
where department_id in (20, 50)
order by last_name;

#1.6
select last_name as Employee, round(salary) as Monthly_Salary
from employees 
where (salary between 5000 and 12000)
and (department_id in (20, 50))
order by salary;


#1.7
select last_name , hire_date
from employees
where year(hire_date) = 1994;

#1.8
select last_name, job_id
from employees
where manager_id is null;

#1.9
select last_name, round(salary), truncate(commission_pct,1)
from employees
where commission_pct is not null
order by 2 desc, 3 desc;