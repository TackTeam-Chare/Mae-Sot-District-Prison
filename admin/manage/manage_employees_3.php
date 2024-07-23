<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
  
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลฝ่ายบริหาร</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_employee.php" class="text-white text-decoration-none">เพิ่มข้อมูลผู้บริหาร</a></button>
            </div>
            <div class="col-lg-12 events-section" id="products-container">
                <!-- Products will be dynamically added here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token =localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_employees?dep_id=3',{
                medthod:"GET",
                headers:{
                    'Authorization':`Bearer ${token}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    const employeeContainer = document.getElementById('products-container');

                    data.forEach(employee => {
                        const employeeCard = document.createElement('div');
                        employeeCard.classList.add('card', 'mb-3');

                        // Check if product.image exists and use it, otherwise use a default icon
                        const imageUrl = employee.image ? `../../uploads/${employee.image}` : '../../img/no_image.png';

                        employeeCard.innerHTML = `
                            <div class="card-body">
                                   <img src="${imageUrl}" alt="product image" class="img-fluid mb-3">
                                <h5 class="card-title">${employee.name}</h5>
                                <p class="card-text">${employee.pos_name}</p>
                                <p class="card-text">${employee.dep_name}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="../edit/edit_employee.php?id=${employee.id}" class="btn btn-success me-2">Edit</a>
                                    <button class="btn btn-danger" onclick="confirmDelete(${employee.id})">Delete</button>
                                </div>
                            </div>
                        `;

                        employeeContainer.appendChild(employeeCard);
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        });

        function confirmDelete(employeeId) {
            if (confirm('Are you sure you want to delete this product?')) {
                deleteProduct(employeeId);
            }
        }

        function deleteProduct(employeeId) {
            const token =localStorage.getItem('authToken');
            fetch(`http://localhost:8000/employee_delete?id=${employeeId}`, {
                    method: 'GET',
                    headers: {
                        'Authorization':`Bearer ${token}`,
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