#3.1
#Group functions work across many rows to produce one result per group. -->True

#3.2
#Group functions include nulls in calculations. -->False. Group functions ignore null values. If you want to include null values, use the IFNULL() function

#3.3
# The WHERE clause restricts rows before inclusion in a group calculation. -->TRUE

#3.4
select round(max(salary)) Maximum , round(min(salary)) Minimum, round(sum(salary)) Sum, round(avg(salary)) Average
from employees;

#3.5
select job_id, round(max(salary)) Maximum , round(min(salary)) Minimum, round(sum(salary)) Sum, round(avg(salary)) Average
from employees
group by job_id;

#3.6
select job_id, count(*)
from employees
group by job_id;

#3.7
select count(distinct manager_id) as Number_of_Managers
from employees;

#3.8
select round(max(salary) - min(salary)) as DIFFERENCE
from employees;

#3.9
select manager_id , round(min(salary))
from employees
where manager_id is not null
group by manager_id
having min(salary) >= 6000
order by min(salary) desc;
