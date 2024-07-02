<?php
include_once('./inc/config.php');

session_start();
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบผู้ดูแล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
        }
        h1 {
            font-weight: 900;
        }
        .card {
            margin: 1rem 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-body {
            padding: 1.5rem;
        }
        .table-responsive {
            margin-top: 2rem;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include_once('./layout/navbar.php') ?>

    <div class="container mt-4">
        <h1 class="mb-4 text-center">หน้าหลัก</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">ข่าวประชาสัมพันธ์</h5>
                        <p class="card-text">
                            เนื้อหาของข่าวประชาสัมพันธ์เกี่ยวกับเหตุการณ์ล่าสุดที่เกี่ยวข้องกับองค์กรของเราและข้อมูลที่เป็นประโยชน์ต่อสมาชิก.
                        </p>
                        <a href="#" class="btn btn-primary">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">ผลิตภัณฑ์</h5>
                        <p class="card-text">
                            ข้อมูลเกี่ยวกับผลิตภัณฑ์ใหม่และผลิตภัณฑ์ที่มีอยู่ที่สามารถให้บริการแก่ลูกค้า รวมถึงรายละเอียดการใช้งานและคุณสมบัติพิเศษ.
                        </p>
                        <a href="#" class="btn btn-primary">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">ตารางแก้ยอดผู้ต้องขัง</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>หมายเลข</th>
                                        <th>ชื่อ</th>
                                        <th>สถานะ</th>
                                        <th>การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>ชื่อผู้ต้องขัง 1</td>
                                        <td>สถานะ 1</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">ดู</a>
                                            <a href="#" class="btn btn-sm btn-warning">แก้ไข</a>
                                            <a href="#" class="btn btn-sm btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>ชื่อผู้ต้องขัง 2</td>
                                        <td>สถานะ 2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">ดู</a>
                                            <a href="#" class="btn btn-sm btn-warning">แก้ไข</a>
                                            <a href="#" class="btn btn-sm btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    <!-- เพิ่มข้อมูลในตารางตามต้องการ -->
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn btn-primary mt-3">เพิ่มข้อมูลใหม่</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">ตารางแก้ข้อมูลเจ้าหน้าที่</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>หมายเลข</th>
                                        <th>ชื่อ</th>
                                        <th>ตำแหน่ง</th>
                                        <th>การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>ชื่อเจ้าหน้าที่ 1</td>
                                        <td>ตำแหน่ง 1</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">ดู</a>
                                            <a href="#" class="btn btn-sm btn-warning">แก้ไข</a>
                                            <a href="#" class="btn btn-sm btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>ชื่อเจ้าหน้าที่ 2</td>
                                        <td>ตำแหน่ง 2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success">ดู</a>
                                            <a href="#" class="btn btn-sm btn-warning">แก้ไข</a>
                                            <a href="#" class="btn btn-sm btn-danger">ลบ</a>
                                        </td>
                                    </tr>
                                    <!-- เพิ่มข้อมูลในตารางตามต้องการ -->
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn btn-primary mt-3">เพิ่มข้อมูลใหม่</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
