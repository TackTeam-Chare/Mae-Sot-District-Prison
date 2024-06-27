<?php
$id = $_GET['id'];
echo $id;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <button><a href="./dashboard.php">back</a></button>
    <div class="container">
        <h1>เพิ่มข่าวสารประชาสัมพันธ์์</h1>
        <form method="POST" action="./crud.php">
            <input type="number" hidden name="id" value="<?php echo $id; ?>">
            <div class="form--input">
                <label for="title">หัวเรื่อง</label>
                <input type="text" placeholder='หัวข่าว' name="title">
            </div>
            <div class="form--input">
                <label for="title">เนื้อหาข่าว</label>
                <textarea type="text" name="content" placeholder="ใส่บทความเนื้อหาข่าวสาร">
</textarea>
            </div>

            <div>
                <button type="submit" name="news_update">บันทึก</button>
            </div>
        </form>
    </div>
</body>

</html>