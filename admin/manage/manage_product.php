<?php
include_once('../inc/config.php');

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
    <title>การจัดการข้อมูลผลิตภัณฑ์</title>
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
    </style>
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลผลิตภัณฑ์</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_product.php" class="text-white text-decoration-none">Add</a></button>
            </div>
            <div class="col-lg-12 events-section">
                <?php
                $query = mysqli_query($con, "SELECT * FROM events");
                while ($result = mysqli_fetch_array($query)) { ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $result['title']; ?></h5>
                            <p class="card-text"><?php echo $result['content']; ?></p>
                            <img src="../../uploads/<?php echo $result['image_path']; ?>" alt="event image" class="img-fluid mb-3" style="max-height: 200px;">
                            <div class="d-flex justify-content-end">
                                <a href="../edit/edit_product.php?php echo $result['id']; ?>" class="btn btn-warning me-2">Edit</a>
                                <form action="../crud.php" method="POST">
                                    <input type="text" name='id' hidden value=<?php echo $result['id'] ?>>
                                    <button class="btn btn-danger" type="submit" name="event_delete">delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
