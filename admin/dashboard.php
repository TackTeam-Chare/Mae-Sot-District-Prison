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
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h1>Admin Dashboard</h1>
<hr>
    <div class="container">      
        <div class="model--title">
         <div>
         <h3>ข่าวประชาสัมพันธ์์</h3>
         </div>
         <div class="button">
            <button><a href="./addevent.php">Add</a></button>
         </div>
        </div>
        <?php
        $query = mysqli_query($con, "select * from news where 1");
        while ($result = mysqli_fetch_array($query)) { ?>

            <div class="model--items">
                <div class="model--field"><?php echo $result['id'] ?></div>
                <div class="model--field"><?php echo $result['title'] ?></div>
                <div class="model--field"><?php echo $result['content'] ?></div>
                <div class="model--field">
                    <button class="list--manage_item">edit</button>
                </div>
                <div class="model--field">
                    <button class="list--manage_item">delete</button>
                </div>
            </div>

        <?php } ?>
                    </div>
</body>

</html>