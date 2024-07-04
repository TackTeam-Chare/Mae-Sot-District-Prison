<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        .events-section {
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 900;
        }

        .card-body .img-fluid {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center mb-4 fw-bold">ผลิตภันฑ์</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-12 events-section" id="products-container">
                <!-- Products will be dynamically added here -->
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination will be dynamically added here -->
            </ul>
        </nav>
    </div>

    <script>
        let currentPage = 1;
        const productsPerPage = 1;
        let totalProducts = 0;

        document.addEventListener("DOMContentLoaded", function () {
            fetch('http://localhost:8000/products')
                .then(response => response.json())
                .then(data => {
                    totalProducts = data.length;
                    displayProducts(data, currentPage);
                    setupPagination(totalProducts, productsPerPage);
                })
                .catch(error => console.error('Error fetching products:', error));
        });

        function displayProducts(products, page) {
            const startIndex = (page - 1) * productsPerPage;
            const endIndex = startIndex + productsPerPage;
            const productsToDisplay = products.slice(startIndex, endIndex);

            const productsContainer = document.getElementById('products-container');
            productsContainer.innerHTML = '';

            productsToDisplay.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('card', 'mb-3');

                const imageUrl = product.image ? `../../uploads/${product.image}` : '../../img/no_image.png';

                productCard.innerHTML = `
                    <div class="card-body">
                        <img src="${imageUrl}" alt="product image" class="img-fluid mb-3">
                        <h5 class="card-title">${product.title}</h5>
                        <p class="card-text">${product.content}</p>
                        <div class="d-flex justify-content-end">
                            <a href="/admin/edit/edit_product.php?id=${product.id}" class="btn btn-success me-2">Detail</a>
                        </div>
                    </div>
                `;

                productsContainer.appendChild(productCard);
            });
        }

        function setupPagination(totalItems, itemsPerPage) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            const createPageItem = (page, isActive = false) => {
                const li = document.createElement('li');
                li.classList.add('page-item');
                if (isActive) li.classList.add('active');

                const a = document.createElement('a');
                a.classList.add('page-link');
                a.href = '#';
                a.textContent = page;
                a.addEventListener('click', () => {
                    currentPage = page;
                    fetch('http://localhost:8000/products')
                        .then(response => response.json())
                        .then(data => {
                            displayProducts(data, currentPage);
                            setupPagination(totalProducts, productsPerPage);
                        });
                });

                li.appendChild(a);
                return li;
            };

            const prevItem = createPageItem('«');
            prevItem.classList.add('page-item');
            prevItem.firstChild.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    fetch('http://localhost:8000/products')
                        .then(response => response.json())
                        .then(data => {
                            displayProducts(data, currentPage);
                            setupPagination(totalProducts, productsPerPage);
                        });
                }
            });
            pagination.appendChild(prevItem);

            for (let i = 1; i <= totalPages; i++) {
                pagination.appendChild(createPageItem(i, i === currentPage));
            }

            const nextItem = createPageItem('»');
            nextItem.classList.add('page-item');
            nextItem.firstChild.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    fetch('http://localhost:8000/products')
                        .then(response => response.json())
                        .then(data => {
                            displayProducts(data, currentPage);
                            setupPagination(totalProducts, productsPerPage);
                        });
                }
            });
            pagination.appendChild(nextItem);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
