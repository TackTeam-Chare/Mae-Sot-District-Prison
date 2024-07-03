<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        h1 {
            font-weight: 900;
        }

        .news-section,
        .events-section {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลสินค้า</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_product.php" class="text-white text-decoration-none">เพิ่มรายกการสินค้า</a></button>
            </div>
            <div class="col-lg-12 events-section" id="products-container">
                <!-- Products will be dynamically added here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                            <div class="card-body">
                                <h5 class="card-title">${product.title}</h5>
                                <p class="card-text">${product.content}</p>
                                <img src="${imageUrl}" alt="product image" class="img-fluid mb-3" style="max-height: 200px;">
                                <div class="d-flex justify-content-end">
                                    <a href="../edit/edit_product.php?id=${product.id}" class="btn btn-success me-2">Edit</a>
                                    <button class="btn btn-danger" onclick="confirmDelete(${product.id})">Delete</button>
                                </div>
                            </div>
                        `;

                        productsContainer.appendChild(productCard);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        });

        function confirmDelete(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                deleteProduct(productId);
            }
        }

        function deleteProduct(productId) {
            fetch(`http://localhost:8000/product_delete?id=${productId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Product deleted successfully!');
                    location.reload(); // Reload the page to reflect the changes
                })
                .catch(error => {
                    console.error('Error deleting product:', error);
                    alert('Failed to delete product: ' + error.message);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
