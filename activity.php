<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>กิจกรรม</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .custom-img {
      max-width: 100%;
      max-height: 400px; /* Adjust this value as needed */
      object-fit: cover;
      cursor: pointer;
    }
    .content-container {
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <?php include('./layout/navbar.php'); ?>
  <div class="container content-container">
    <h1 class="text-center mb-4" style="color: aliceblue; font-weight: bold;">ระเบียบการเยี่ยมญาติ</h1>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <img class="img-fluid mb-3 custom-img" src="img/ขั้นตอนการเยี่ยมยาติ.jpg" alt="ขั้นตอนการเยี่ยมยาติ" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage(this)">
        <img class="img-fluid mb-3 custom-img" src="img/ขั้นตอนการเยี่ยมยาติ2.jpg" alt="ขั้นตอนการเยี่ยมยาติ2" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage(this)">
        <img class="img-fluid mb-3 custom-img" src="img/ขั้นตอนการเยี่ยมยาติออนไลน์.jpg" alt="ขั้นตอนการเยี่ยมยาติออนไลน์" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage(this)">
      </div>
    </div>
  </div>
  <?php include('./layout/footer.php'); ?>

  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">ภาพขยาย</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="modalImage" src="" alt="Expanded Image" class="img-fluid">
        </div>
      </div>
    </div>
  </div>

  <script>
    function setModalImage(element) {
      const src = element.src;
      document.getElementById('modalImage').src = src;
    }
  </script>
</body>
</html>
