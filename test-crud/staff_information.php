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
        $sql = "SELECT * FROM staff WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<h2>'.$row['name'].'</h2>';
            echo '<p>'.$row['position'].'</p>';
            echo '<p>'.$row['department'].'</p>';
            echo '<img src="'.$row['image'].'" alt="staff">';
        } else {
            echo "Staff not found";
        }
        ?>
    </div>
    <?php include('./layout/footer.php'); ?>
</body>
</html>
