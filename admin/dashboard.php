<?php
include_once('./inc/config.php');

session_start();
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบผู้ดูเเล</title>
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

        .news-section, .events-section {
            margin-bottom: 2rem; /* เพิ่มช่องว่างด้านล่าง */
        }
    </style>
</head>
<body>
    <?php include_once('./layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">Admin Dashboard</h1>
        <hr>
        <div class="row gy-5">
            <!-- ข่าวประชาสัมพันธ์ -->
            <div class="col-lg-6 news-section">
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
                                <form action="./crud.php" method="POST">
                <div class="model--field">
                    <input type="text" name='id' hidden value=<?php echo $result['id']?>>
                    <button class="btn btn-danger" type="submit" name="news_delete">Delete</button>
                </div>
                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- กิจกรรม -->
            <div class="col-lg-6 events-section">
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
                                <form action="./crud.php" method="POST">
                <div class="model--field">
                    <input type="text" name='id' hidden value=<?php echo $result['id']?>>
                    <button class="btn btn-danger" type="submit" name="event_delete">delete</button>
                </div>
                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include_once('./layout/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
