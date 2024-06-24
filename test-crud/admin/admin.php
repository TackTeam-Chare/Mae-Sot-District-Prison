<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- include head elements here -->
</head>
<body>
    <?php include('./layout/navbar.php'); ?>
    <div class="container pt-4">
        <h1>จัดการข่าว</h1>
        <form action="admin_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $news['id'] ?? ''; ?>">
            <div class="form-group">
                <label for="title">หัวข้อ</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $news['title'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="content">เนื้อหา</label>
                <textarea name="content" id="content" class="form-control" rows="5" required><?php echo $news['content'] ?? ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="date">วันที่</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo $news['date'] ?? ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">รูปภาพ</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php if (isset($news['image'])): ?>
                    <img src="<?php echo $news['image']; ?>" alt="news image" class="img-thumbnail mt-2">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
        <h2>ข่าวทั้งหมด</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>หัวข้อ</th>
                    <th>วันที่</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM news ORDER BY date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>'.$row['title'].'</td>';
                        echo '<td>'.$row['date'].'</td>';
                        echo '<td>';
                        echo '<a href="admin.php?id='.$row['id'].'" class="btn btn-warning">แก้ไข</a> ';
                        echo '<a href="admin_process.php?delete='.$row['id'].'" class="btn btn-danger">ลบ</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "<tr><td colspan='3'>No news found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include('./layout/footer.php'); ?>
</body>
</html>
