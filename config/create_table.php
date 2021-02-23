<?php
	$table_user = "
	CREATE TABLE auth(
	id int AUTO_INCREMENT NOT null PRIMARY KEY,
 	name varchar(100),
    username varchar(50),
    email varchar(50),
    phone varchar(20),
    address varchar(255),
    pass varchar(100),
    time timestamp
	)
	";

?>