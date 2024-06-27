<?php
include_once('./inc/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบผู้ดูเเล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <?php include_once('./layout/navbar.php') ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>
        <hr>
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>ข่าวประชาสัมพันธ์</h3>
                <button class="btn btn-primary"><a href="./add_news.php" class="text-white text-decoration-none">Add</a></button>
            </div>
            <?php
            $query = mysqli_query($con, "SELECT * FROM news");
            while ($result = mysqli_fetch_array($query)) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $result['title']; ?></h5>
                        <p class="card-text"><?php echo $result['content']; ?></p>
                        <div class="d-flex justify-content-end">
                            <a href="./update_news.php?id=<?php echo $result['id']; ?>" class="btn btn-warning me-2">Edit</a>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>กิจกรรม</h3>
                <button class="btn btn-primary"><a href="./add_event.php" class="text-white text-decoration-none">Add</a></button>
            </div>
            <?php
            $query = mysqli_query($con, "SELECT * FROM events");
            while ($result = mysqli_fetch_array($query)) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $result['title']; ?></h5>
                        <p class="card-text"><?php echo $result['content']; ?></p>
                        <img src="../uploads/<?php echo $result['image_path']; ?>" alt="event image" class="img-fluid mb-3" style="max-height: 200px;">
                        <div class="d-flex justify-content-end">
                            <a href="./update_event.php?id=<?php echo $result['id']; ?>" class="btn btn-warning me-2">Edit</a>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include_once('./layout/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>