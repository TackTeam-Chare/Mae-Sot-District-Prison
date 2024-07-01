<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        #sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            transition: all 0.3s;
            background-color: #343a40;
            color: white;
        }

        #sidebar.active {
            left: 0;
        }

        #sidebar .close-btn {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .sidebar-links a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }

        .sidebar-links a:hover {
            background-color: #495057;
            border-radius: 0;
        }

        .sidebar-links a .fa {
            margin-right: 10px;
        }

        .sidebar-submenu {
            display: none;
            padding-left: 30px;
        }

        .sidebar-submenu a {
            padding: 8px 15px;
        }

        .submenu-active {
            display: block;
        }

        #content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        #content.active {
            margin-left: 0;
        }
    </style>
</head>

<body>

    <div id="content" class="p-3">
        <button class="btn btn-primary" onclick="toggleSidebar()">☰ เมนู</button>
        <div id="sidebar" class="bg-dark">
            <div class="p-3 d-flex justify-content-between align-items-center border-bottom">
                <span class="fw-bold">เมนู</span>
                <span class="close-btn" onclick="toggleSidebar()">&times;</span>
            </div>
            <div class="sidebar-links p-3">
                <a href="/admin/dashboard.php" class="d-block"><i class="fa fa-home"></i> หน้าเเรก</a>
                <a href="#" class="d-block" onclick="toggleSubMenu('dataManagementSubMenu')"><i class="fa fa-building"></i> การจัดการข้อมูล <i class="fa fa-caret-down ms-auto"></i></a>
                <div id="dataManagementSubMenu" class="sidebar-submenu">
                    <a href="/admin/manage/manage_prison_history.php" class="d-block"><i class="fa fa-history"></i> ประวัติเรือนจำ</a>
                    <a href="#" class="d-block" onclick="toggleSubMenu('personnelSubMenu')"><i class="fa fa-users"></i> ทำเนียบบุคคลากร <i class="fa fa-caret-down ms-auto"></i></a>
                    <div id="personnelSubMenu" class="sidebar-submenu">
                        <a href="staff_information.php" class="d-block">ฝ่ายผู้บริหาร</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายบริหารทั่วไป</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายทัณฑปฎิบัติ</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายฝึกวิชาชีพ</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายควบคุมเเละรักษาการณ์</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายสวัสดิการผู้ต้องขังเเละสงเคราะห์ผู้ต้องขัง</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายการศึกษา</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายสภานพยาบาลเรือนจำ</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายควบคุมเเดนหญิง</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายรักษาการณ์</a>
                        <a href="staff_information.php" class="d-block">ฝ่ายควบคุม</a>
                    </div>
                    <a href="/admin/manage/manage_product.php" class="d-block"><i class="fa fa-box"></i> ผลิตภัณฑ์</a>
                    <a href="/admin/manage/manage_events.php" class="d-block"><i class="fa fa-bullhorn"></i> ข่าวประชาสัมพันธ์</a>
                    <a href="/admin/manage/manage_mission.php" class="d-block"><i class="fa fa-flag"></i> พันธกิจ</a>
                    <a href="/admin/manage/mange_duty.php" class="d-block"><i class="fa fa-tasks"></i> ภารกิจ</a>
                </div>
                <a href="/admin/manage/manage_admin.php" class="d-block"><i class="fa fa-user-shield"></i> ผู้ดูแลระบบ</a>
                <a href="/admin/manage/manage_regulations_for_visiting_relatives.php" class="d-block"><i class="fa fa-handshake"></i> ระเบียบการเยี่ยมญาติ</a>
                <a href="/admin/manage/manage_contact.php" class="d-block"><i class="fa fa-phone"></i> ติดต่อ</a>
                <a href="/admin/admin_verify.php" class="d-block"><i class="fa fa-sign-out-alt"></i> ออกจากระบบ</a>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
            document.getElementById("content").classList.toggle("active");
        }

        function toggleSubMenu(id) {
            var submenu = document.getElementById(id);
            submenu.classList.toggle("submenu-active");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
