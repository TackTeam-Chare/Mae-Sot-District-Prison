<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark">
        <div class="p-3 d-flex justify-content-between align-items-center border-bottom">
            <span class="fw-bold">เมนู</span>
            <span class="close-btn" onclick="toggleSidebar()">&times;</span>
        </div>
        <div class="sidebar-links p-3">
            <a href="/admin/dashboard.php" class="d-block"><i class="fa fa-home"></i> หน้าเเรก</a>
            <a href="#" class="d-block" onclick="toggleSubMenu('aboutSubMenu')"><i class="fa fa-building"></i> การจัดการข้อมูล <i class="fa fa-caret-down ms-auto"></i></a>
            <div id="aboutSubMenu" class="sidebar-submenu">
                <a href="/admin/manage/manage_prison_history.php" class="d-block"><i class="fa fa-history"></i> ประวัติเรือนจำ</a>
                <a href="/admin/manage/manage_personnel_list.php" class="d-block"><i class="fa fa-users"></i> ทำเนียบบุคคลากร</a>
                <a href="/admin/manage/manage_product.php" class="d-block"><i class="fa fa-box"></i> ผลิตภัณฑ์</a>
                <a href="/admin/manage/manage_events.php" class="d-block"><i class="fa fa-bullhorn"></i> ข่าวประชาสัมพันธ์</a>
                <a href="/admin/edit/edit_mission.php" class="d-block"><i class="fa fa-flag"></i> พันธกิจ</a>
                <a href="/admin/edit/edit_duty.php" class="d-block"><i class="fa fa-tasks"></i> ภารกิจ</a>
            </div>
            <a href="/admin/add/add_user.php" class="d-block"><i class="fa fa-user-shield"></i> ผู้ดูแลระบบ</a>
            <a href="/admin/add/add_regulations_for_visiting_relatives.php" class="d-block"><i class="fa fa-handshake"></i> ระเบียบการเยี่ยมญาติ</a>
            <a href="/admin/manage/manage_contact.php" class="d-block"><i class="fa fa-phone"></i> ติดต่อ</a>
            <a href="/admin/admin_verify.php" class="d-block"><i class="fa fa-sign-out-alt"></i> ออกจากระบบ</a>
        </div>
    </div>

    <!-- Page Content -->
    <div id="content" class="p-3">
        <button class="btn btn-primary" onclick="toggleSidebar()">☰ เมนู</button>
        <!-- Add your page content here -->
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