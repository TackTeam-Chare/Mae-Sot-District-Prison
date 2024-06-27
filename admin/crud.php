<?php session_start();
include_once('./inc/config.php');
// Code for login 


if (isset($_POST['news_insert'])) {
    $title = $_POST['title'];
    $content = $_POST["content"];
    $msg = mysqli_query($con, "INSERT INTO news(title,content) VALUES ('$title','$content');");

    if ($msg) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        echo "<script type='text/javascript'> document.location = './addnews.php'; </script>";
    }
}

if (isset($_POST["event_insert"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image_file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image_file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image_file"]["name"])). " has been uploaded.";

            $stmt = $con->prepare("INSERT INTO events(title, content, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $target_file);
            $stmt->execute();
            $stmt->close();
            $con->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>