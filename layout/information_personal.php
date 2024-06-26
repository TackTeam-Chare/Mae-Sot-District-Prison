<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>information_personal</title>
    <style>
        body {
            text-align: center;
            background-color: rgb(148, 16, 16);
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-top: 20px;
        }

        .btn-primary {
            font-size: 1rem;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #dc3545;
            border: none;
            font-weight: bold;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #007bff;
            transform: translateY(-2px);
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: #0056b3;
            outline: none;
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
            color: white;
        }

        a.btn {
            display: inline-block;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="container py-4">
            <h2>ทำเนียบบุคลากร</h2>
            <hr class="bg-white my-4" style="height: 3px;">
            <div class="img-center">
                <img src="img/ข้อมูลเจ้าหน้าที่2.jpg" alt="เจ้าหน้าที่" class="img-fluid">
            </div>
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="staff_information.php" class="btn btn-primary" role="button">ฝ่ายการศึกษา</a>
                <a href="staff_information.php" class="btn btn-primary" role="button">แผนผังผู้บริหาร</a>
                <a href="staff_information.php" class="btn btn-primary" role="button">ฝ่ายบริหารทั่วไป</a>
                <a href="staff_information.php" class="btn btn-primary" role="button">ฝ่ายทัณฑปฏิบัติ</a>
            </div>
        </div>
    </main>
</body>

</html>
