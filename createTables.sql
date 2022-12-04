create table EMPLOYEE
(
    empID int primary key auto_increment, 
    name varchar(50), 
    wage float, 
    position varchar(30),
    clockedIn boolean
);

create table CUSTOMER
(
    custID int primary key auto_increment, 
    name varchar(50), 
    address varchar(50), 
    email varchar(50), 
    phoneNum varchar(20)
);

create table MENU
(
    itemID int primary key auto_increment, 
    itemName varchar(50), 
    itemPrice float, 
    isVegan boolean, 
    stock int
);

create table ORDERS
(
    orderID int primary key auto_increment, 
    status int,
    price float, 
    orderTime int, 
    isComplete boolean, 
    empID int,
    custID int,
    foreign key (empID) references EMPLOYEE (empID)
    on delete set null on update cascade,
    foreign key (custID) references CUSTOMER (custID)
    on delete set null on update cascade
);

create table CONTAINS (
  quantity int,
  itemID int,
  orderID int,
  foreign key (itemID) references MENU (itemID) on delete set null on update cascade,
  foreign key (orderID) references ORDERS (orderID) on delete set null on update cascade
);
