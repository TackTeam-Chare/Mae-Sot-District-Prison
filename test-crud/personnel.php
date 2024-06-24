<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- include head elements here -->
</head>
<body>
    <?php include('./layout/navbar.php'); ?>
    <main class="main-content">
        <div class="container py-4">
            <h2>ทำเนียบบุคลากร</h2>
            <hr class="bg-info my-4" style="height:3px;">
            <div class="text-center">
                <img src="img/ข้อมูลเจ้าหน้าที่2.jpg" alt="เจ้าหน้าที่" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
            <br>
            <div class="row">
                <?php
                $sql = "SELECT * FROM staff";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-12 col-md-6 col-lg-4 mb-3">';
                        echo '<div class="card">';
                        echo '<img src="'.$row['image'].'" class="card-img-top" alt="staff">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">'.$row['name'].'</h5>';
                        echo '<p class="card-text">'.$row['position'].'<br>'.$row['department'].'</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No staff found";
                }
                ?>
            </div>
        </div>
    </main>
    <?php include('./layout/footer.php'); ?>
</body>
</html>
