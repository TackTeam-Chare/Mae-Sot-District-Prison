<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ดาวน์โหลดเอกสาร</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
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
            background-color: #ffffff; 
        }

        .map-container {
            text-align: center;
            margin-top: 20px;
        }

        .map-container .iframe {
            width: 80%; 
            max-width: 100%; 
            height: 600px; 
            border: none;
            border-radius: 8px;
            margin: auto; 
            margin-bottom: 30px;
        }

        .card {
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            width: 80%; 
            max-width: 600px; 
            margin: auto; 
            padding: 20px; 
            border-radius: 8px; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            height: fit-content; 
        }

        .card-body {
            flex: 1; 
            padding: 20px; 
        }

        .card-title {
            font-size: 1.5rem;
            color: #000; 
            font-weight: bold; 
        }

        .card-text {
            line-height: 1.6;
            color: #000;
        }
    </style>
</head>

<body>
    <?php include('./layout/navbar.php'); ?>

    <div class="container mt-5">
        <h1 class="mb-4">ดาวน์โหลด</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">เอกสารสำหรับดาวน์โหลด</h5>
                <p class="card-text">คุณสามารถดาวน์โหลดเอกสารต่างๆ ได้จากลิงก์ด้านล่างนี้:</p>
                <a href="path/to/your/document.pdf" class="btn btn-primary">
                    <i class="fas fa-file-pdf"></i> ดาวน์โหลดเอกสาร PDF
                </a>
            </div>
        </div>
    </div>
    <?php include('./layout/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
