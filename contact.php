<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ติดต่อ</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Noto Sans Thai', sans-serif;
}

body {
  text-align: center;

}   


               .map-container {
            text-align: center;
            margin-top: 20px;
        }

      
        .map-container .iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 8px;
        }

      
        .card {
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Light shadow */
        }

        .card-title {
            font-size: 1.5rem;
            /* Larger title */
            color: #333;
            /* Dark text */
        }

        .card-text {
            line-height: 1.6;
        }
 
    </style>
</head>

<body>
    <?php include('./layout/navbar.php'); ?>

    <div class="container my-5">
        <h1 class="mt-4">แผนที่เรือนจำอำเภอแม่สอด</h1>
        <div class="map-container">
            <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3821.277474354053!2d98.57530591429452!3d16.71300142630372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dd98b51c22209b%3A0x9f9ecbc69dec0fa8!2z4LmA4Lij4Li34Lit4LiZ4LiI4Liz4Lit4Liz4LmA4Lig4Lit4LmB4Lih4LmI4Liq4Lit4LiU!5e0!3m2!1sth!2sth!4v1647395813755!5m2!1sth!2sth" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h5 class="card-title">ติดต่อเรา</h5>
                <p class="card-text">
                    โทร. 055-531-226<br>
                    โทรสาร. 0-5553-2826<br>
                    Email: maesodprison@hotmail.com
                </p>
            </div>
        </div>
    </div>

    <?php include('./layout/footer.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>