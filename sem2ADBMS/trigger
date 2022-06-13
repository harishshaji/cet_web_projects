create database product;
use product;

create table product(pid int(5) primary key,name varchar(20),price int(5),qtyinstock int(10));

create table sale(saleid int(5) primary key,deliveryaddr varchar(50));

create table saleitem(saleid int(5),pid int(5),qty int(10),foreign key(saleid) references sale(saleid),foreign key(pid) references product(pid));

insert into sale values(20,'cet');

insert into product values(10,'book',40,5);

select * from product;

insert into saleitem values(20,10,3);

select * from product;
