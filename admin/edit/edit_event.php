<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .btn-secondary a {
            color: white;
            text-decoration: none;
        }

        .btn-secondary a:hover {
            color: white;
            text-decoration: none;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0.25rem;
        }

        textarea.form-control {
            resize: none;
        }

        button.btn-primary {
            background-color: #007bff;
            border: none;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>เเก้ไขกิจกรรม</h1>
            <button class="btn btn-secondary"><a href="./dashboard.php" class="text-white text-decoration-none">กลับ</a></button>
        </div>
        <form method="POST" action="./crud.php" enctype="multipart/form-data">
            <input type="number" hidden name="id" value="<?php echo $_GET['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">หัวเรื่อง</label>
                <input type="text" class="form-control" placeholder="หัวข่าว" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">เนื้อหาข่าว</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่บทความเนื้อหาข่าวสาร" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image_file" class="form-label">ภาพข่าว</label>
                <input type="file" class="form-control" name="image_file" accept="image/*" required>
            </div>
            <div>
                <button type="submit" name="event_update" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>