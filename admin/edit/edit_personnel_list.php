<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เเก้ไขทำเนียบบุคคลากร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>เเก้ไขทำเนียบบุคคลากร</h1>
            <button class="btn btn-secondary"><a href="../dashboard.php" class="text-white text-decoration-none">กลับ</a></button>
        </div>
        <form method="POST" action="./crud.php" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="title" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" placeholder="หัวข่าว" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">ตำเเหน่ง</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่บทความเนื้อหาข่าวสาร" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image_file" class="form-label">ภาพประจำตัว</label>
                <input type="file" class="form-control" name="image_file" accept="image/*" required>
            </div>
            <div>
                <button type="submit" name="event_insert" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>