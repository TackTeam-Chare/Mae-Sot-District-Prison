<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลผู้ดูแลระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/style.css">

      
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลผู้ดูแลระบบ</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_admin.php" class="text-white text-decoration-none">Add</a></button>
            </div>
            <div class="col-lg-12 admins-section" id="admins-container">
                <!-- Admins will be dynamically added here -->
            </div>
        </div>
    </div>

    <script>
          const token = localStorage.getItem("authToken");
        fetch(`http://localhost:8000/is_main_admin`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('คุณไม่มีสิทธิในการจัดการหน้านี้');
                history.back();
                }
                return response.json();
            })
            .then(data => {

            })
            .catch(error => {
                console.error(error);
                alert(error.message);
                history.back()
            });
    
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem("authToken");
            fetch('http://localhost:8000/stuffview_admins', {
                    headers: {
                        'Authorization': `Bearer ${token}` // Include the token in the Authorization header
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const adminsContainer = document.getElementById('admins-container');

                    data.forEach(admin => {
                        const adminCard = document.createElement('div');
                        adminCard.classList.add('card', 'mb-3');

                        adminCard.innerHTML = `
                        <div class="card-body">
                            <h5 class="card-title">${admin.name}</h5>
                            <p class="card-text">${admin.email}</p>
                            <p class="card-text"><h5>ระดับการจัดการ : ${admin.is_main_priority?"หลัก":'รอง'}</h5></p>
                            <div class="d-flex justify-content-end">
                                <a href="../edit/edit_admin.php?id=${admin.id}" class="btn btn-success me-2">Edit</a>
                                <button class="btn btn-danger" onclick="confirmDelete(${admin.id})">Delete</button>
                            </div>
                        </div>
                    `;

                        adminsContainer.appendChild(adminCard);
                    });
                })
                .catch(error => {
                    console.error('Error fetching admins:', error);
                });
        });

        function confirmDelete(adminId) {
            if (confirm('Are you sure you want to delete this admin?')) {
                deleteAdmin(adminId);
            }
        }

        function deleteAdmin(adminId) {
            const token = localStorage.getItem("authToken");
            fetch(`http://localhost:8000/admin_delete?id=${adminId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
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
                    alert('Admin deleted successfully!');
                    location.reload(); // Reload the page to reflect the changes
                })
                .catch(error => {
                    console.error('Error deleting admin:', error);
                    alert('Failed to delete admin: ' + error.message);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>