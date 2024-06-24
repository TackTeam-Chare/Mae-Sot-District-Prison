<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- include head elements here -->
</head>
<body>
    <?php include('./layout/navbar.php'); ?>
    <div class="container pt-4">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM news WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<h1>'.$row['title'].'</h1>';
            echo '<p>'.$row['date'].'</p>';
            echo '<img src="'.$row['image'].'" alt="news">';
            echo '<p>'.$row['content'].'</p>';
        } else {
            echo "News not found";
        }
        ?>
    </div>
    <?php include('./layout/footer.php'); ?>
</body>
</html>
