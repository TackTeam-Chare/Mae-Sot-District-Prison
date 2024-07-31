<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลผู้ต้องขัง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลผู้ต้องขัง</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_prisoner.php" class="text-white text-decoration-none">เพิ่มข้อมูลผู้ต้องขัง</a></button>
            </div>
            <div class="col-lg-12 events-section" id="prisoners-container">
                <!-- Prisoners will be dynamically added here -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="prisoners-table-body">
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_prisoners', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    const prisonersTableBody = document.getElementById('prisoners-table-body');

                    data.forEach(prisoner => {
                        const imageUrl = prisoner.image ? `../../uploads/${prisoner.image}` : '../../img/no_image.png';

                        const prisonerRow = document.createElement('tr');

                        employeeRow.innerHTML = `
                            <td><img src="${imageUrl}" alt="employee image" class="img-fluid" style="max-width: 100px;"></td>
                            <td>${employee.name}</td>
                            <td>${employee.gender == 0 ? "ชาย" : "หญิง"}</td>
                            <td>${employee.type == 0 || null? "ไทย" : "ต่างประเทศ"}</td>
                            
                            <td class="d-flex gap-2">
                                <a href="../edit/edit_prisoner.php?id=${prisoner.id}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" onclick="confirmDelete(${prisoner.id})">Delete</button>
                            </td>
                        `;
                        prisonersTableBody.appendChild(prisonerRow);
                    });
                })
                .catch(error => console.error('Error fetching prisoners:', error));
        });

        function confirmDelete(prisonerId) {
            if (confirm('Are you sure you want to delete this prisoner?')) {
                deletePrisoner(prisonerId);
            }
        }

        function deletePrisoner(prisonerId) {
            const token = localStorage.getItem('authToken');
            fetch(`http://localhost:8000/prisoner_delete?id=${prisonerId}`, {
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
                    alert('Prisoner deleted successfully!');
                    location.reload(); // Reload the page to reflect the changes
                })
                .catch(error => {
                    console.error('Error deleting prisoner:', error);
                    alert('Failed to delete prisoner: ' + error.message);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
