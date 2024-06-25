<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>information_personal</title>
    <style>
        body {
            background-color: #ffffff;
        }

        .main-content {
            margin-top: 20px;
        }

        .btn-primary {
            font-size: 1rem;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #dc3545;
            border-color: #dc3545;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: #bd2130;

            border-color: #b21f2d;
        }

        .img-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-center img {
            max-width: 100%;
            max-height: 300px;
            height: auto;
        }

        h2 {
            font-weight: bold;
            color: #dc3545;
        }

        a.btn {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="container py-4">
            <h2>ทำเนียบบุคลากร</h2>
            <hr class="bg-info my-4" style="height: 3px;">
            <div class="img-center">
                <img src="img/ข้อมูลเจ้าหน้าที่2.jpg" alt="เจ้าหน้าที่" class="img-fluid">
            </div>
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="staff_information.php" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">ฝ่ายการศึกษา</a>
                <a href="staff_information.php" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">แผนผังผู้บริหาร</a>
                <a href="staff_information.php" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">ฝ่ายบริหารทั่วไป</a>
                <a href="staff_information.php" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">ฝ่ายทัณฑปฏิบัติ</a>
            </div>
        </div>
    </main>
</body>

</html>