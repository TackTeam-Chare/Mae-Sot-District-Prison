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

        .news-section,
        .events-section {
            margin-bottom: 2rem;
        }

        /* Main content container */
        .main-content {
            margin-left: 250px;
            /* กำหนดความกว้างเดียวกับ Sidebar */
            transition: margin-left 0.3s;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <?php include_once('./layout/navbar.php') ?>

    <div class="container main-content mt-4">
        <h1 class="mb-4 text-center">หน้าหลัก</h1>
        <div class="row">
            <div class="col-md-6">
                <?php include_once('../admin/layout/event.php') ?>
            </div>
            <div class="col-md-6">
                <?php include_once('../admin/layout/product.php') ?>
            </div>
        </div>

        <div class="row mt-5">
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
