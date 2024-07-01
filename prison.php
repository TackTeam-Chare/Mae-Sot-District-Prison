<!doctype html>
<html>

<head>
  <title>เรือนจำอำเภอแม่สอด</title>
  <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
      background-color: rgb(148, 16, 16);
    }

    .card {
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      display: flex;
      flex-direction: column;
      background-color: rgb(179, 78, 78);
      border-radius: 5px;
      margin: 1rem;
      padding: 25px;
      width: 100%;
      max-width: 300px;
      height: auto;
    }

    .card:hover {
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }

    .card-body {
      padding: 1rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .card-title {
      font-size: 1.25rem;
      margin-top: 15px;
      color: #ffffff;
    }

    .card-subtitle {
      font-size: 0.875rem;
      color: white;
      font-weight: bold;
    }

    .card-text {
      font-size: 1rem;
      flex-grow: 1;
      color: #ffffff;
    }

    .card-img-top {
      height: 250px;
      object-fit: cover;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }

    .btn-primary {
      background-color: #a33434;
      border: none;
      color: #ffffff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
    }

    .btn-primary:hover {
      background-color: red;
      color: #e97171;
      box-shadow: -8px 2px 53px 0px rgba(185, 29, 29, 0.55);
    }

    h1,
    h3 {
      color: #000000;
    }

    .container {
      margin-left: auto;
      margin-right: auto;
      max-width: 100%;
    }

    .row {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .row-cols-6 {
      gap: 20px;
    }

    /* Media queries for responsiveness */
    @media only screen and (max-width: 768px) {
      .card {
        width: 100%;
        max-width: 400px;
      }
    }

    @media only screen and (max-width: 480px) {
      .card-title {
        font-size: 1rem;
      }

      .site-title {
        font-size: 25px;
      }
    }

    .all-browsers {
      margin: 0;
      padding: 5px;
      background-color: rgb(179, 78, 78);
      text-align: left;
    }

    .all-browsers>h1,
    .browser {
      margin: 10px;
      padding: 5px;
      background: white;
    }

    .browser>h2,
    p {
      margin: 4px;
      font-size: 100%;
    }

    .text-info,
    .text-infoe,
    .text-truncate {
      color: #ffffff;
    }
  </style>
</head>

<body>
  <?php include('./layout/navbar.php'); ?>

  <div class="container my-5">
    <h1 class="text-center text-light">ผลิตภัณฑ์ของฝ่ายฝึกวิชาชีพ</h1>
    <p class="text-center text-light">ติดต่อสอบถามได้ที่<br>เบอร์ 055 531226 ต่อ 108</p>

    <div class="d-flex flex-wrap justify-content-center">
    <div class="card mb-4" data-bs-toggle="modal" data-bs-target="#productModal">
  <div class="card-img-top" style="background-image: url('./img/toop05.jpg');"></div>
  <div class="card-body text-center">
    <h5 class="card-title">ชุดรับแขกตอรากไม้</h5>
    <p class="card-text">ชุดรับแขกตอรากไม้<br> ราคา 5,000 บาท</p>
  </div>
</div>

      <div class="card mb-4"  data-bs-toggle="modal" data-bs-target="#productModal">
        <div class="card-img-top" style="background-image: url('./img/toop05.jpg');"></div>
        <div class="card-body text-center">
          <h5 class="card-title">ชุดรับแขกตอรากไม้</h5>
          <p class="card-text">ชุดรับแขกตอรากไม้<br> ราคา 5,000 บาท</p>
        </div>
      </div>
      <div class="card mb-4"  data-bs-toggle="modal" data-bs-target="#productModal">
        <div class="card-img-top" style="background-image: url('./img/toop05.jpg');"></div>
        <div class="card-body text-center">
          <h5 class="card-title">ชุดรับแขกตอรากไม้</h5>
          <p class="card-text">ชุดรับแขกตอรากไม้<br> ราคา 5,000 บาท</p>
        </div>
      </div>
      <div class="card mb-4"  data-bs-toggle="modal" data-bs-target="#productModal">
        <div class="card-img-top" style="background-image: url('./img/toop05.jpg');"></div>
        <div class="card-body text-center">
          <h5 class="card-title">ชุดรับแขกตอรากไม้</h5>
          <p class="card-text">ชุดรับแขกตอรากไม้<br> ราคา 5,000 บาท</p>
        </div>
      </div>

    </div>
  </div>

  <?php include('./layout/footer.php'); ?>

  <!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">ชุดรับแขกตอรากไม้</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="./img/toop05.jpg" class="card-img-top mb-3" alt="...">
        <p>รายละเอียด: ชุดรับแขกตอรากไม้ ราคา 5,000 บาท</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>