<!doctype html>
<html lang="th">

<head>
  <title>แผนผังฝ่ายการศึกษา</title>
  <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .card {
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      height: 100%;
      display: flex;
      flex-direction: column;
      background-color: rgb(179, 78, 78);
      border-radius: 2px;
      margin: 1rem;
      padding: 25px;
    }

    .card:hover {
      transform: translateY(-5px);
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
    }

    .card-subtitle {
      font-size: 0.875rem;
      color: white;
      font-weight: bold;
    }

    .card-text {
      font-size: 1rem;
      flex-grow: 1;
    }

    .card-img-top {
      height: 300px;
      background-size: cover;
      background-position: center;
    }

    .tree {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin: 20px;
    }

    .node {
      text-align: center;
      margin: 20px;
    }

    .node img {
      width: 150px; /* Increased size */
      height: 150px; /* Increased size */
      border-radius: 50%;
      border: 3px solid #ddd;
    }

    .children {
      display: flex;
      justify-content: center;
    }
  </style>
</head>

<body>
  <?php include('./layout/navbar.php'); ?>
  <div class="container my-5">
    <h2 class="text-white mb-4">แผนผังฝ่ายการศึกษา</h2>
    <hr class="bg-white my-4" style="height: 3px;">
    <div class="tree">
      <div class="node">
        <img src="img/02.jpg" alt="นายกุหลาบ บุญเลิศ">
        <div>นายกุหลาบ บุญเลิศ</div>
        <div>ผู้กำกับการฝ่ายการศึกษาและพัฒนาจิตใจ</div>
      </div>
      <div class="node">
        <img src="img/02.jpg" alt="นายชูพันธ์ วรเจริญ">
        <div>นายชูพันธ์ วรเจริญ</div>
        <div>หัวหน้าโครงการศึกษาและพัฒนาจิตใจ</div>
      </div>
      <div class="children">
        <div class="node">
          <img src="img/02.jpg" alt="นายวิทยา ก้านลำ">
          <div>นายวิทยา ก้านลำ</div>
          <div>หัวหน้าฝ่ายการศึกษา</div>
        </div>
        <div class="node">
          <img src="img/04.jpg" alt="นายอนันทร์ สิงหิการ">
          <div>นายอนันทร์ สิงหิการ</div>
          <div>หัวหน้าฝ่ายงานอบรมจิตบำบัด</div>
        </div>
        <div class="node">
          <img src="img/04.jpg" alt="นายอนันทร์ สิงหิการ">
          <div>นายอนันทร์ สิงหิการ</div>
          <div>หัวหน้าฝ่ายงานอบรมจิตบำบัด</div>
        </div>
        <div class="node">
          <img src="img/04.jpg" alt="นายอนันทร์ สิงหิการ">
          <div>นายอนันทร์ สิงหิการ</div>
          <div>หัวหน้าฝ่ายงานอบรมจิตบำบัด</div>
        </div>
        <div class="node">
          <img src="img/04.jpg" alt="นายอนันทร์ สิงหิการ">
          <div>นายอนันทร์ สิงหิการ</div>
          <div>หัวหน้าฝ่ายงานอบรมจิตบำบัด</div>
        </div>
      </div>
    </div>
  </div>

  <?php include('./layout/footer.php'); ?>


</body>

</html>
