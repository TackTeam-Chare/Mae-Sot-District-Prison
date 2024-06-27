<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME', 'db');

// เชื่อมต่อกับ MySQL
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// ตรวจสอบการเชื่อมต่อ
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
