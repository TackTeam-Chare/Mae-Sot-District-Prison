<?php session_start();
include_once('./inc/config.php');
// Code for login 


if (isset($_POST['news_insert'])) {
    $title = $_POST['title'];
    $content = $_POST["content"];
    $msg = mysqli_query($con, "INSERT INTO news(title,content) VALUES ('$title','$content');");

    if ($msg) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
    }
}

if (isset($_POST["event_insert"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
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
        echo "ไฟล์มีขนาดใหญ่เกินไป , ไฟล์ต้องมีขนาดไม่เกิน 50mb.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "อนุญาติเพียงไฟลนิด JPG, JPEG, PNG เเละ GIF.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "ไม่สามารถอัพโหลดได้.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image_file"]["name"])) . " has been uploaded.";

            $stmt = $con->prepare("INSERT INTO events(title, content, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $target_file);
            $stmt->execute();
            $stmt->close();
            $con->close();
            echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
            echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
        } else {
            echo "ผิดพลาดในการบันทึกผล.";
        }
    }
}


if (isset($_POST['news_update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "UPDATE news SET title='" . $title . "',content='" . $content . "' WHERE id=" . $id . ';';
    if (mysqli_query($con, $sql)) {

        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
    } else {
        echo "ผิดพลาดในการบันทึกผล: " . mysqli_error($con);
    }
    mysqli_close($con);
}


if (isset($_POST["event_update"])) {
    $id = $_POST["id"]; // Assuming you have the event ID from the form
    $title = $_POST["title"];
    $content = $_POST["content"];
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
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "อนุญาติเพียงไฟล์ประเภท JPG, JPEG, PNG และ GIF.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "ไม่สามารถอัพโหลดได้.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image_file"]["name"])) . " has been uploaded.";

            // Delete the old image file if it exists
            if (!empty($old_image_path) && file_exists($old_image_path)) {
                unlink($old_image_path);
            }

            // Update the record in the database
            $stmt = $con->prepare("UPDATE events SET title = ?, content = ?, image_path = ? WHERE id = ?");
            $stmt->bind_param("sssi", $title, $content, $target_file, $id);
            $stmt->execute();
            $stmt->close();
            $con->close();
            echo "<script>alert('อัพเดทข้อมูลสำเร็จ');</script>";
            echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
        } else {
            echo "ผิดพลาดในการอัพโหลดไฟล์.";
        }
    }
}
if (isset($_POST['news_delete'])) {
    $id = $_POST['id'];


    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // sql to delete a record
    $sql = "DELETE FROM news WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('ลบข้อมูลสำเร็จ " . $id . "');</script>";
        echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
    } else {
        echo "ลบข้อมูลไม่สำเร็จ: " . $con->error;
    }

    $stmt->close();
    $con->close();
}

if (isset($_POST["event_delete"])) {
    $id = $_POST["id"]; // Assum;
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

    // Delete the old image file if it exists
    if (!empty($old_image_path) && file_exists($old_image_path)) {
        unlink($old_image_path);
    }

    // sql to delete a record
    $sql = "DELETE FROM events WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('ลบข้อมูลสำเร็จ " . $id . "');</script>";
        echo "<script type='text/javascript'> document.location = './dashboard.php'; </script>";
    } else {
        echo "ลบข้อมูลไม่สำเร็จ: " . $con->error;
    }

    $stmt->close();
    $con->close();
}
