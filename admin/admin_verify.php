<?php session_start();
include_once('./inc/config.php');
// Code for login 
if (isset($_POST['login'])) {
    $adminusername = $_POST['username'];
    $pass = md5($_POST['password']);
    $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$adminusername' and password='$pass'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $extra = "dashboard.php";
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['adminid'] = $num['id'];
        echo "<script>alert('success !!!')</script>";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        // $extra = "index.php";
        // echo "<script>window.location.href='" . $extra . "'</script>";
        // exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>เรือนจำอำเภอแม่สอด</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        body {
            background-color: dimgray;
        }

        .container {
            display: flex;
            justify-content: center;
        }

        .form {
            display: flex;
            flex-direction: column;

        }
    </style>
</head>

<body>


    <div class="container">

        <form method="POST" class="form">
            
        <h1>Admin</h1>
            <div class="input">
                
            <label for="username">Username</label>
                <input type="text" name="username">
            </div>

            <div class="input">
                <label for="password">Password</label>
                <input type="text" name="password">
            </div>
            <button name="login" type="submit">sign in</button>
            </from>
    </div>

</body>

</html>l