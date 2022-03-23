
drop database company;
create database company;
use company;

CREATE TABLE regions (
    region_id varchar(20) NOT NULL PRIMARY KEY,
    region_name VARCHAR(100) NOT NULL
);

CREATE TABLE countries (
    country_id varchar(20) NOT NULL PRIMARY KEY,
    country_name VARCHAR(50) NOT NULL,
    region_id varchar(20) NOT NULL,
    FOREIGN KEY (region_id)
        REFERENCES regions (region_id)
);

alter table countries modify region_id varchar(20) not null;
                        
CREATE TABLE locations (
    location_id varchar(20) NOT NULL PRIMARY KEY,
    street_address TEXT,
    postal_code varchar(20),
    city VARCHAR(50),
    state_province VARCHAR(50),
    country_id varchar(20),
    FOREIGN KEY (country_id)
        REFERENCES countries (country_id)
);

alter table locations modify country_id varchar(20) not null;
                        
CREATE TABLE departments (
    department_id varchar(20) NOT NULL PRIMARY KEY,
    department_name VARCHAR(50),
    location_id varchar(20),
    FOREIGN KEY (location_id)
        REFERENCES locations (location_id)
);
                        
CREATE TABLE jobs (
    job_id varchar(20) NOT NULL PRIMARY KEY,
    job_title VARCHAR(50),
    min_salary varchar(20),
    max_salary VARCHAR(20)
);

CREATE TABLE employees (
    employee_id varchar(20) NOT NULL PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(50),
    phone_number VARCHAR(20),
    hire_date VARCHAR(20),
    job_id varchar(20),
    salary VARCHAR(20),
    manager_id varchar(20),
    department_id varchar(20),
    FOREIGN KEY (job_id)
        REFERENCES jobs (job_id),
    FOREIGN KEY (department_id)
        REFERENCES departments (department_id)
);

alter table employees add foreign key(manager_id) references employees(employee_id);
alter table employees modify job_id varchar(20) not null;


CREATE TABLE dependents (
    dependent_id varchar(20) PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    relationship VARCHAR(50),
    employee_id varchar(20),
    FOREIGN KEY (employee_id)
        REFERENCES employees (employee_id)
);

alter table dependents modify employee_id varchar(20) not null;


rename table departments to dept;
rename table dept to departments;
select * from departments;
alter table employees modify salary smallint not null;
alter table employees add commission int;




