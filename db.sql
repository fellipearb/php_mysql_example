create database example;
use example;

create table leads (
    id int(10) auto_increment primary key,
    name varchar(200),
    email varchar(200),
    comments varchar(200),
    phone_number varchar(20),
    created_at datetime DEFAULT current_timestamp()
);