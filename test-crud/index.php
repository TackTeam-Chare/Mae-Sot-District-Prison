<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- include head elements here -->
</head>
<body>
    <?php include('./layout/navbar.php'); ?>
    <div class="container pt-4">
        <!-- carousel and other sections here -->
        <main class="min-vh-100">
            <div class="container py-3 py-md-5" style="min-height:80vh;">
                <!-- ผู้บัญชาการ section here -->
                <div class="row mb-5">
                    <div class="col-12 col-md-8 col-lg-9">
                        <div id="news">
                            <h2>ข่าวกิจกรรม</h2>
                            <hr>
                            <div class="row">
                                <?php
                                $sql = "SELECT * FROM news ORDER BY date DESC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<div class="col-12 col-lg-6 mb-3">';
                                        echo '<a class="card text-reset text-decoration-none" href="new.php?id='.$row['id'].'">';
                                        echo '<img src="'.$row['image'].'" class="card-img-top" alt="news">';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">'.$row['title'].'</h5>';
                                        echo '<h6 class="card-subtitle mb-2 text-muted">'.$row['date'].'</h6>';
                                        echo '</div>';
                                        echo '</a>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo "No news found";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include('./layout/footer.php'); ?>
    </div>
</body>
</html>
