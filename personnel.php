<!doctype html>
<html>
<head>
    <title>ทำเนียบบุคลากร</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            box-sizing: border-box;
        }
        @font-face {
            font-family: 'thaisanslite_r1';
            src: url('font/thaisanslite_r1.woff2') format('woff2'),
                url('font/thaisanslite_r1.woff') format('woff'),
                url('font/thaisanslite_r1.ttf') format('truetype');
        }
        body {
            text-align: center;
            background-color: #941010;
            font-family: 'thaisanslite_r1', sans-serif;
        }
        .navbar-brand img {
            height: 80px;
            width: 80px;
        }
        .navbar-nav .nav-link {
            font-size: 18px;
        }
        .main-content {
            padding: 20px;
            color: #fff;
        }
        .btn-outline-info {
            color: #fff;
            border-color: #fff;
        }
        .btn-outline-info:hover {
            color: #941010;
            background-color: #fff;
            border-color: #fff;
        }
        .card {
            background-color: #B34E4E;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            color: #fff;
        }
        .container-fluid {
            background-color: #F8F9FA;
            padding: 20px;
        }
        .container-fluid h4, .container-fluid p, .container-fluid a {
            color: #000;
        }
        .container-fluid a:hover {
            text-decoration: underline;
        }
        @media (max-width: 480px) {
            .navbar-brand img {
                height: 50px;
                width: 50px;
            }
            .navbar-nav .nav-link {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<?php include('./layout/navbar.php'); ?>
    <main class="main-content">
        <div class="container py-4">
            <h2>ทำเนียบบุคลากร</h2>
            <hr class="bg-info my-4" style="height:3px;">
            <div class="text-center">
                <img src="img/ข้อมูลเจ้าหน้าที่2.jpg" alt="เจ้าหน้าที่" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
            <br>
            <div class="d-flex flex-column">
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายการศึกษา</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">แผนผังผู้บริหาร</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายบริหารทั่วไป</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายทัณฑปฏิบัติ</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายฝึกวิชาชีพ</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายควบคุมและรักษาการณ์</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายสวัสดิการผู้ต้องขังและสงเคราะห์ผู้ต้องขัง</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายสถานพยาบาลเรือนจำ</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">งานควบคุมแดนหญิง</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายรักษาการณ์</a>
                <a href="staff_information.php" class="btn btn-lg btn-block btn-outline-info my-2">ฝ่ายควบคุม</a>
            </div>
        </div>
    </main>

    <?php include('./layout/footer.php'); ?>
</body>
</html>
