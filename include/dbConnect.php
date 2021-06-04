<?php

/*
COMP306-DATABASE MANAGEMENT SYSTEMS


More information about the parameters can be found: 
https://www.php.net/manual/en/mysqli.construct.php
*/

$host     = 'localhost';
$username = 'root';
$passwd   = 'database2021'; #This operation is not secure
$dbName   = 'RestaurantChain';

$conn = mysqli_connect($host, $username, $passwd, $dbName, "3306", "/tmp/mysql.sock");

if(!$conn){
    die('Connection failed: '.mysqli_connect_error());
}

#Note that we did not close the php tag.

#self note:
#open mysql through terminal
#ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'database2021';