<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
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
    <div class="container my-5">
        <h1 class="mt-4">แผนที่เรือนจำอำเภอแม่สอด</h1>
        <div class="map-container">
            <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3821.277474354053!2d98.57530591429452!3d16.71300142630372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dd98b51c22209b%3A0x9f9ecbc69dec0fa8!2z4LmA4Lij4Li34Lit4LiZ4LiI4Liz4Lit4Liz4LmA4Lig4Lit4LmB4Lih4LmI4Liq4Lit4LiU!5e0!3m2!1sth!2sth!4v1647395813755!5m2!1sth!2sth" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="card mx-auto">
            <div class="card-body">
                <h5 class="card-title">ติดต่อเรา</h5>
                <p class="card-text">
                    โทร. 055-531-226<br>
                    โทรสาร. 0-5553-2826><br>
                    Email: maesodprison@hotmail.com
                </p>
            </div>
        </div>
    </div>
</body>
</html>
