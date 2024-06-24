<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    if (isset($_POST['id']) && $_POST['id'] != '') {
        $id = $_POST['id'];
        $sql = "UPDATE news SET title='$title', content='$content', date='$date', image='$image' WHERE id=$id";
    } else {
        $sql = "INSERT INTO news (title, content, date, image) VALUES ('$title', '$content', '$date', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM news WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
