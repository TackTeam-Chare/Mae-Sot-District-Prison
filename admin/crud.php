<?php
session_start();
include_once('./inc/config.php');

// Code for inserting news
if (isset($_POST['news_insert'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST["content"]);
    $msg = mysqli_query($con, "INSERT INTO news(title,content) VALUES ('$title','$content')");

    if ($msg) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
    }
}

// Code for inserting events
if (isset($_POST["event_insert"])) {
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $content = mysqli_real_escape_string($con, $_POST["content"]);
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image_file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "ต้องใช้ไฟลนิดรูปภาพ.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image_file"]["size"] > 500000) {
        echo "ไฟล์มีขนาดใหญ่เกินไป, ไฟล์ต้องมีขนาดไม่เกิน 50MB.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "อนุญาติเพียงไฟล์ประเภท JPG, JPEG, PNG และ GIF.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "ไม่สามารถอัพโหลดได้.";
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image_file"]["name"])). " has been uploaded.";

            $stmt = $con->prepare("INSERT INTO events(title, content, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $target_file);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
            echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
        } else {
            echo "ผิดพลาดในการบันทึกผล.";
        }
    }
}

// Code for updating news
if (isset($_POST['news_update'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $sql = "UPDATE news SET title='$title', content='$content' WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
    } else {
        echo "ผิดพลาดในการบันทึกผล: " . mysqli_error($con);
    }
}

// Code for updating events
if (isset($_POST["event_update"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $content = mysqli_real_escape_string($con, $_POST["content"]);
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Retrieve the old image path
    $stmt = $con->prepare("SELECT image_path FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($old_image_path);
    $stmt->fetch();
    $stmt->close();

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image_file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "ต้องใช้ไฟล์ประเภทรูปภาพ.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image_file"]["size"] > 500000) {
        echo "ไฟล์มีขนาดใหญ่เกินไป, ไฟล์ต้องมีขนาดไม่เกิน 50MB.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "อนุญาติเพียงไฟล์ประเภท JPG, JPEG, PNG และ GIF.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "ไม่สามารถอัพโหลดได้.";
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image_file"]["name"])). " has been uploaded.";

            // Delete the old image file
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }

            $stmt = $con->prepare("UPDATE events SET title = ?, content = ?, image_path = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $content, $target_file, $id);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
            echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
        } else {
            echo "ผิดพลาดในการบันทึกผล.";
        }
    }
}
?>
