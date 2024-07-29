<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลฝ่ายบริหาร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลฝ่ายฝ่ายควบคุมเเละรักษาการณ์</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_employee.php" class="text-white text-decoration-none">เพิ่มข้อมูลผู้บริหาร</a></button>
            </div>
            <div class="col-lg-12 events-section" id="employees-container">
                <!-- Employees will be dynamically added here -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employees-table-body">
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_employees?dep_id=5', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    const employeesTableBody = document.getElementById('employees-table-body');

                    data.forEach(employee => {
                        const imageUrl = employee.image ? `../../uploads/${employee.image}` : '../../img/no_image.png';

                        const employeeRow = document.createElement('tr');

                        employeeRow.innerHTML = `
                            <td><img src="${imageUrl}" alt="employee image" class="img-fluid" style="max-width: 100px;"></td>
                            <td>${employee.name}</td>
                            <td>${employee.pos_name}</td>
                            <td>${employee.dep_name}</td>
                            <td class="d-flex gap-2">
                                <a href="../edit/edit_employee.php?id=${employee.id}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" onclick="confirmDelete(${employee.id})">Delete</button>
                            </td>
                        `;
                        employeesTableBody.appendChild(employeeRow);
                    });
                })
                .catch(error => console.error('Error fetching employees:', error));
        });

        function confirmDelete(employeeId) {
            if (confirm('Are you sure you want to delete this employee?')) {
                deleteEmployee(employeeId);
            }
        }

        function deleteEmployee(employeeId) {
            const token = localStorage.getItem('authToken');
            fetch(`http://localhost:8000/employee_delete?id=${employeeId}`, {
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
                    alert('Employee deleted successfully!');
                    location.reload(); // Reload the page to reflect the changes
                })
                .catch(error => {
                    console.error('Error deleting employee:', error);
                    alert('Failed to delete employee: ' + error.message);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
