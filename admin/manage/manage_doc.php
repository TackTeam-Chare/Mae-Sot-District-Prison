<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .table img, .table iframe {
            max-width: 100px;
            height: auto;
        }

        .doc-preview {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: auto;
        }
    </style>
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลเอกสาร</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary">
                    <a href="../add/add_doc.php" class="text-white text-decoration-none">เพิ่มไฟล์เอกสาร</a>
                </button>
            </div>
            <div class="col-lg-12 events-section" id="products-container">
                <!-- Products will be dynamically added here -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Document</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body">
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_docs', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    const productsTableBody = document.getElementById('products-table-body');

                    data.forEach(product => {
                        const fileUrl = product.document ? `../../uploads/${product.document}` : '../../img/no_image.png';
                        const fileExtension = product.document ? product.document.split('.').pop().toLowerCase() : '';

                        let previewContent = '';

                        if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                            previewContent = `<img src="${fileUrl}" alt="Document preview" class="doc-preview">`;
                        } else if (['pdf'].includes(fileExtension)) {
                            previewContent = `<iframe src="${fileUrl}" class="doc-preview" frameborder="0"></iframe>`;
                        } else {
                            previewContent = `<span>No preview available</span>`;
                        }

                        const productRow = document.createElement('tr');

                        productRow.innerHTML = `
                            <td>${previewContent}</td>
                            <td>${product.title}</td>
                            <td>${product.content}</td>
                            <td class="d-flex gap-2">
                                <a href="../edit/edit_doc.php?id=${product.id}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" onclick="confirmDelete(${product.id})">Delete</button>
                            </td>
                        `;
                        productsTableBody.appendChild(productRow);
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
            const token = localStorage.getItem('authToken');
            fetch(`http://localhost:8000/doc_delete?id=${productId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
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
