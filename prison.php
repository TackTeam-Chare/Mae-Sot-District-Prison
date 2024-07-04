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
      /* ป้องกันไม่ให้ข้อความล้นออกนอก card */
      text-overflow: ellipsis;
      /* เพิ่มจุดต่อท้ายถ้าข้อความยาวเกินไป */
      display: -webkit-box;
      -webkit-line-clamp: 4;
      /* จำนวนบรรทัดที่ต้องการแสดง */
      -webkit-box-orient: vertical;
    }

    .card-title {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .card-text {
      height: 100px;
      /* จำกัดความสูงของ card-text */
      overflow-y: auto;
      /* เพิ่มการเลื่อนถ้าข้อความเกิน */
    }

    /* ปรับความกว้างของการ์ดตามขนาดหน้าจอ */
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

    .card {
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      display: flex;
      flex-direction: column;
      background-color: #fff;
      border-radius: 5px;
      margin: 1rem;
      padding: 0;
      width: 100%;
      max-width: 300px;
      height: auto;
    }

    .card:hover {
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
    }


    .card-title {
      font-size: 1.25rem;
      margin-top: 15px;
      color: #333;
    }

    .card-text {
      font-size: 1rem;
      flex-grow: 1;
      color: #666;
    }

    .card-img-top {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }

    h1,
    h3 {
      color: #333;
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
  </style>
</head>

<body>
  <?php include('./layout/navbar.php'); ?>

  <div class="container my-5">
    <h1 class="text-center text-light">ผลิตภัณฑ์ของฝ่ายฝึกวิชาชีพ</h1>
    <p class="text-center text-light">ติดต่อสอบถามได้ที่<br>เบอร์ 055 531226 ต่อ 108</p>

    <div class="d-flex flex-wrap justify-content-center" id="products-container">
      <!-- Product cards will be dynamically generated here -->
    </div>
  </div>

  <?php include('./layout/footer.php'); ?>

  <!-- โหลด jQuery ก่อน Bootstrap 5 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- โหลด Bootstrap 5 พร้อม Popper.js และ JavaScript ของ Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <!-- Your custom script for fetching and displaying products -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Fetch products from your API or local data
      fetch('http://localhost:8000/products')
        .then(response => response.json())
        .then(data => {
          const productsContainer = document.getElementById('products-container');

          data.forEach(product => {
            const productCard = document.createElement('div');
            productCard.classList.add('card', 'mb-3');

            // Check if product.image exists and use it, otherwise use a default icon
            const imageUrl = product.image ? `../../uploads/${product.image}` : '../../img/no_image.png';

            productCard.innerHTML = `
                            <div class="card-body" data-bs-toggle="modal" data-bs-target="#productModal"
                                    data-title="${product.title}"  data-image="${imageUrl}" data-content="${product.content}">
                                <img src="${imageUrl}" alt="product image" class="img-fluid mb-3" >
                                <h5 class="card-title">${product.title}</h5>
                                <p class="card-text">${product.content}</p>
                            
                            </div>
                        `;

            productsContainer.appendChild(productCard);
          });
        })
        .catch(error => console.error('Error fetching products:', error));

      // Modal initialization and content update
      const productModal = new bootstrap.Modal(document.getElementById('productModal'));
      const productModalBody = document.getElementById('productModalBody');

      $('#productModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const title = button.data('title');
        const image = button.data('image');
        const content = button.data('content');

        productModalBody.innerHTML = `
                        <div class="text-center">
                        <img src="${image}" alt="product image" class="img-fluid">
                    </div>
                    <h5 class="modal-title mt-3">${title}</h5>
                    <p>${content}</p>
                `;
      });
    });
  </script>

  <!-- Modal -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title " id="productModalLabel">ข้อมูลผลิตภันฑ์</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="productModalBody">
          <!-- Product details will be dynamically inserted here -->
        </div>
      </div>
    </div>
  </div>

</body>

</html>