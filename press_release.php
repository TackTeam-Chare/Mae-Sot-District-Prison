<?php
include_once('./admin/inc/config.php');
?>

<!doctype html>
<html>

<head>
    <title>ข่าวประชาสัมพันธ์</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('./layout/navbar.php'); ?>
    <section>
        <article class="all-browsers">
            <h2>
                <span style="color:#ffffff;">ดาวน์โหลด
            </h2>
            <article class="browser">
                <h2>
                    <a class="nav-link dropdown-toggle" href="data/No_Gift Policy.pdf">แบบรายงานการรับของขวัญและของกำนัลตามนโยบาย No Gift Policy จากการปฏิบัติหน้าที่.pdf</a>
                </h2>
    </section>
    <section>
        <article class="all-browsers">
            <h2>
                <span style="color:#ffffff;">ข่าวประชาสัมพันธ์
            </h2>
            <?php
        $query = mysqli_query($con, "select * from news where 1 order by id desc");
        while ($result = mysqli_fetch_array($query)) { ?>
            <article class="browser">
                <h2><?php echo $result['title'] . ''; ?></h2>
                <p><?php echo $result['content'] . ''; ?></p>
            </article>
        <?php } ?>
        </article>
        <article class="all-browsers">
            <h2>
                <span style="color:#ffffff;">ข่าวจัดซื้อ-จัดจ้าง
            </h2>
            <?php
        $query = mysqli_query($con, "select * from procurements where 1 order by id desc");
        while ($result = mysqli_fetch_array($query)) { ?>
            <article class="browser">
                <h2><?php echo $result['title'] . ''; ?></h2>
                <p><?php echo $result['content'] . ''; ?></p>
            </article>
        <?php } ?>
        </article>
    </section>
    
    <div class="container mt-5"> 
        <?php include('./layout/activityNews.php'); ?>
    </div>
    <?php include('./layout/footer.php'); ?>
</body>

</html>