<?php
session_start();
include_once('./inc/config.php');

if (!isset($_SESSION['login_status'])) {
    $_SESSION['login_status'] = ''; 
}

if (isset($_POST['login'])) {
    $admin_username = $_POST['username'];
    $password = md5($_POST['password']);
    $ret = mysqli_query($con, 'SELECT * FROM admin WHERE username="'.$admin_username.'" and password="'.$password.'"');
    $num = mysqli_num_rows($ret);

    if ($num > 0) {
        $row = mysqli_fetch_array($ret);
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['admin_id'] = $row['id'];
        header("Location: ./dashboard.php");
        exit();
    } else {
        $_SESSION['login_status'] = 'fail';  
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Admin</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card">
            <h3 class="text-center mb-4">Admin Login</h3>

        
            <div id="alert-fail" class="alert alert-danger d-none" role="alert">
                ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap และ Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript สำหรับการแสดง Alert -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
  
            const loginStatus = '<?php echo $_SESSION['login_status']; ?>';

            if (loginStatus === 'success') {
                setTimeout(function() {
                    window.location.href = './dashboard.php';
                }, 5000); 
            } else if (loginStatus === 'fail') {

                const failAlert = document.getElementById('alert-fail');
                failAlert.classList.remove('d-none');
            }

            // ล้าง session สำหรับ login status หลังจากการแสดงผล
            <?php $_SESSION['login_status'] = ''; ?>
        });
    </script>
</body>

</html>