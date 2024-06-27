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
      font-size: 90%;
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

    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="card">
          <img src="img/toop01.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">ชุดรับแขกตอรากไม้ ราคา 5,000 บาท ค่ะ</h5>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="card">
          <img src="img/แก้ไขtoop2.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">เก้าอี้บาร์ตอไม้ขาเหล็ก ขนาด 45*45*70 ซม. ราคา 1,500 บาท</h5>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="card">
          <img src="img/toop03.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">เก้าอี้พนักพิงตอรากไม้ ขนาด 85*120*100 ซม. ทำจากไม้สักทอง ราคา 6,000 บาท</h5>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="card">
          <img src="img/toop04.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">เก้าอี้พนักพิงตอรากไม้เล็ก ขนาด 35*60*65 ซม. ทำจากไม้สักทอง ราคา 4,000 บาท</h5>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="card">
          <img src="img/toop05.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">เก้าอี้ฮ่องเต้ ขนาด 50*95*80 ซม. ทำจากไม้สักทอง ราคา 4,500 บาท</h5>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
        <div class="card">
          <img src="img/toop06.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">ชิงช้าสนามเล็ก ขนาด 100*100*200 ซม. ราคา 4,500 บาท</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('./layout/footer.php'); ?>
</body>

</html>
