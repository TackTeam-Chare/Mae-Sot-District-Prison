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
            <button><a href="./add_news.php">Add</a></button>
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
                    <button class="list--manage_item" type="submit" name="news_update"><a href="./update_news.php?id=<?php echo $result['id']?>">edit</a></button>
                </div>
                <form action="./crud.php" method="POST">
                <div class="model--field">
                    <input type="text" name='id' hidden value=<?php echo $result['id']?>>
                    <button class="list--manage_item" type="submit" name="news_delete">delete</button>
                </div>
                </form>
                
            </div>

        <?php } ?>
                    </div>

                    <div class="container">      
        <div class="model--title">
         <div>
         <h3>กิจจกรรม</h3>
         </div>
         <div class="button">
            <button><a href="./add_event.php">Add</a></button>
         </div>
        </div>
        <?php
        $query = mysqli_query($con, "select * from events where 1");
        while ($result = mysqli_fetch_array($query)) { ?>

            <div class="model--items">
                <div class="model--field"><?php echo $result['id'] ?></div>
                <div class="model--field"><?php echo $result['title'] ?></div>
                <div class="model--field"><?php echo $result['content'] ?></div>
                <img src="../uploads/<?php echo $result['image_path']?>"  alt="news" style="height:200px;"><div class="model--field">
                    <button class="list--manage_item" type="submit" name="news_update"><a href="./update_event.php?id=<?php echo $result['id']?>">edit</a></button>
                </div>
                </form>
                <form action="./crud.php" method="POST">
                <div class="model--field">
                    <input type="text" name='id' hidden value=<?php echo $result['id']?>>
                    <button class="list--manage_item" type="submit" name="event_delete">delete</button>
                </div>
                </form>
            </div>

        <?php } ?>
                    </div>

                </body>

</html>