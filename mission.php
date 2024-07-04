<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>พันธกิจ</title>
  <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <style>

   
body {
      background-image: url('img/รูปเรือนจำ.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
    }

    .content {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .content h2 {
      color: #fff;
      margin-bottom: 20px;
    }

    .content h4 {
      color: #fff;
      margin-bottom: 20px;
      font-size: 1.2rem;
      line-height: 1.6;
    }

    .mission-title {
      color: #fff;
      margin-top: 20px;
      margin-bottom: 20px;
      font-size: 2rem;
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>
<body>


<?php include('./layout/navbar.php'); ?>
 <h1 class="mission-title">ภารกิจเเละอำนาจหน้าที่</h1>
 
  <article class="content">
    <h4 id="cards-container">


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('http://localhost:8000/screen_contents?id=3') // Replace with the actual URL of your JSON file or API endpoint
            .then(response => response.json())
            .then(data => {
                const cardsContainer = document.getElementById('cards-container');
                cardsContainer.innerHTML = `
                
                 
  <br>
  <img class="img-fluid" src="./uploads/${data.image}">
  <br>
  <br>
                <span>${data.content.replace(/\r\n/g, '<br>')}</span>`;
            })
            .catch(error => console.error('Error fetching JSON:', error));
    });
  </script>

    </h4> <!-- Added id here -->
  </article>

<?php include('./layout/footer.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
