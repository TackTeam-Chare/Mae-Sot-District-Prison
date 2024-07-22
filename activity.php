<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>กิจกรรม</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <style>
    div.card {
      width: 100%;
      height: auto;
    }

    img.card-img-top {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-top-left-radius: calc(0.25rem - 1px);
      border-top-right-radius: calc(0.25rem - 1px);
    }

    .card-body {
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
    }

    .card-title {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .card-text {
      height: 100px;
      overflow-y: auto;
    }

    @media (min-width: 768px) {
      .col-md-8 {
        max-width: 80%;
      }
    }

    @media (min-width: 992px) {
      .col-lg-8 {
        max-width: 60%;
      }
    }
  </style>
</head>

<body>
  <?php include('./layout/navbar.php'); ?>
  <div class="container mt-5">
    <h1 class="text-center mb-4" style="color: aliceblue; font-weight: bold;">ระเบียบการเยี่ยมญาติ</h1>
    <div class="row justify-content-center" id="content">
      <!-- เนื้อหาที่สร้างแบบไดนามิกจะถูกเพิ่มที่นี่ -->
    </div>
  </div>
  <?php include('./layout/footer.php'); ?>

  <!-- Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="" id="modalImage" class="img-fluid" alt="...">
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      fetch('http://localhost:8000/viewVisiting_rules')
        .then(response => response.json())
        .then(data => {
          const contentDiv = document.getElementById('content');
          data.forEach(item => {
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-12 col-lg-8 mb-3';

            const card = `
              <div class="card">
                <img src="../../uploads/${item.image}" class="card-img-top" alt="${item.title}" data-bs-toggle="modal" data-bs-target="#imageModal">
                <div class="card-body">
                  <h5 class="card-title">${item.title}</h5>
                  <p class="card-text">${item.content}</p>
                </div>
              </div>
            `;

            colDiv.innerHTML = card;
            contentDiv.appendChild(colDiv);
          });

          // Add event listeners for opening the modal with the image
          const images = document.querySelectorAll('.card-img-top');
          images.forEach(img => {
            img.addEventListener('click', function () {
              const modalImage = document.getElementById('modalImage');
              modalImage.src = this.src;
              const imageModalLabel = document.getElementById('imageModalLabel');
              imageModalLabel.textContent = this.alt;
            });
          });
        })
        .catch(error => console.error('Error fetching JSON:', error));
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
