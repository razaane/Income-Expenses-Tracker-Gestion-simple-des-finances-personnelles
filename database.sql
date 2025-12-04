CREATE DATABASE smart_wallet ;
use smart_wallet ;

CREATE TABLE incomes (
    id int PRIMARY KEY AUTO_INCREMENT , 
    montant DECIMAL(10,2) NOT NULL , 
    la_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    descreption TEXT NOT NULL
);

CREATE TABLE expenses (
    id int PRIMARY KEY AUTO_INCREMENT,
    montant DECIMAL(10,2) NOT NULL , 
    la_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    descreption TEXT NOT NULL
);

show databases;

