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
    }

    .card {
      background-color: rgb(179, 78, 78);
      border-radius: 2px;
      display: inline-block;
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
  </style>
</head>

<body>
  <?php include('./layout/navbar.php'); ?>
  <div class="container my-5">
    <h2 class="text-white mb-4">แผนผังฝ่ายการศึกษา</h2>
    <hr class="bg-white my-4" style="height: 3px;">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-img-top" style="background-image: url('./img/01.jpg'); height: 300px; background-size: cover; background-position: center;"></div>
          <div class="card-body text-center" data-toggle="modal" data-target="#staffModal" data-name="นาย กุหลาบ บุญเลิศ" data-position="นักทัณฑวิทยาชำนาญการพิเศษ">
            <h5 class="card-title">นาย กุหลาบ บุญเลิศ</h5>
            <p class="card-text">นักทัณฑวิทยาชำนาญการพิเศษ<br>ผู้กำกับการฝ่ายการศึกษาและพัฒนาจิตใจ</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-img-top" style="background-image: url('./img/02.jpg'); height: 300px; background-size: cover; background-position: center;"></div>
          <div class="card-body text-center" data-toggle="modal" data-target="#staffModal" data-name="นายชูพันธ์ วรเจริญ" data-position="นักวิชาการอบรมและฝึกวิชาชีพชำนาญการ">
            <h5 class="card-title">นายชูพันธ์ วรเจริญ</h5>
            <p class="card-text">นักวิชาการอบรมและฝึกวิชาชีพชำนาญการ<br>หัวหน้าโครงการศึกษาและพัฒนาจิตใจ</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-img-top" style="background-image: url('./img/03.jpg'); height: 300px; background-size: cover; background-position: center;"></div>
          <div class="card-body text-center" data-toggle="modal" data-target="#staffModal" data-name="นายวิทยา ก้านลำ" data-position="นักทัณฑวิทยาปฏิบัติการ">
            <h5 class="card-title">นายวิทยา ก้านลำ</h5>
            <p class="card-text">นักทัณฑวิทยาปฏิบัติการ<br>หัวหน้าฝ่ายการศึกษา</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-img-top" style="background-image: url('./img/04.jpg'); height: 300px; background-size: cover; background-position: center;"></div>
          <div class="card-body text-center" data-toggle="modal" data-target="#staffModal" data-name="นายอนันทร์ สิงหิการ" data-position="เจ้าพนักงานราชทัณฑ์ชำนาญงาน">
            <h5 class="card-title">นายอนันทร์ สิงหิการ</h5>
            <p class="card-text">เจ้าพนักงานราชทัณฑ์ชำนาญงาน<br>หัวหน้าฝ่ายงานอบรมจิตบำบัด</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staffModalLabel">ข้อมูลพนักงาน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="staffModalBody">
          <!-- ข้อมูลจะถูกแทรกที่นี่โดย JavaScript -->
        </div>
      </div>
    </div>
  </div>

  <?php include('./layout/footer.php'); ?>

  <script>
    $(document).ready(function() {
      $('.card-body').click(function() {
        var name = $(this).data('name');
        var position = $(this).data('position');
        var imgSrc = $(this).prev('.card-img-top').css('background-image').replace('url("', '').replace('")', '');

        $('#staffModalLabel').text('ข้อมูล: ' + name);
        $('#staffModalBody').html('<img src="' + imgSrc + '" class="img-fluid mb-3" style="max-width: 100%; height: auto;" /><p><strong>ตำแหน่ง:</strong> ' + position + '</p>');

        $('#staffModal').modal('show');
      });
    });
  </script>
</body>

</html>
