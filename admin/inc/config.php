<?php
define('DB_SERVER','localhost');
define('DB_USER','user_3500');
define('DB_PASS' ,'Arnumat@4185');
define('DB_NAME', 'loginsystem');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
