<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขบุคคลากร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .btn-secondary a {
            color: white;
            text-decoration: none;
        }

        .btn-secondary a:hover {
            color: white;
            text-decoration: none;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0.25rem;
        }

        textarea.form-control {
            resize: none;
        }

        button.btn-primary {
            background-color: #007bff;
            border: none;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>แก้ไขบุคคลากร</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updateProductForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">    
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อบุคคลากร</label>
                <input type="text" class="form-control" placeholder="ชื่อบุคคลากร" name="name" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">ภาพบุคคลากร</label>
                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event)">
                <img id="currentImage" style="display: none; max-width: 200px; margin-top: 10px;" />
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">ฝ่ายบุคลากร</label>
                <select id="department" class="form-control" name="department" required>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <div class="mb-3">
                <label for="job_position" class="form-label">ตำเเหน่งบุคคลากร</label>
                <select id="job_position" class="form-control" name="job_position" required>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <button type="submit" id="submitForm" class="btn btn-primary">บันทึก</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const eventId = <?php echo $_GET['id']; ?>; // Get event ID from URL parameter
            const token = localStorage.getItem('authToken');

            const departmentSelect = document.getElementById('department');
            const jobPositionSelect = document.getElementById('job_position');

            // Fetch departments and populate the select options
            fetch('http://localhost:8000/viewDepartments', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(department => {
                    const option = document.createElement('option');
                    option.value = department.id;
                    option.textContent = department.dep_name;
                    departmentSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching departments:', error));

            // Fetch job positions and populate the select options
            fetch('http://localhost:8000/viewJobPositions', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(jobPosition => {
                    const option = document.createElement('option');
                    option.value = jobPosition.id;
                    option.textContent = jobPosition.pos_name;
                    jobPositionSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching job positions:', error));

            // Fetch employee details
            fetch(`http://localhost:8000/stuffview_employees?id=${eventId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(employee => {
                // Populate form fields with existing data
                document.querySelector('input[name="name"]').value = employee.name;
                document.getElementById('department').value = employee.dep_id;
                document.getElementById('job_position').value = employee.pos_id;

                // Display current image if exists
                if (employee.image) {
                    const currentImage = document.getElementById('currentImage');
                    currentImage.src = `../../uploads/${employee.image}`;
                    currentImage.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching employee:', error);
                alert('Failed to fetch employee details');
            });
        });

        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentImage = document.getElementById('currentImage');
                    currentImage.src = e.target.result;
                    currentImage.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById("updateProductForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(); // Create FormData object
            formData.append('id', document.querySelector('input[name="id"]').value);
            formData.append('name', document.querySelector('input[name="name"]').value);
            formData.append('dep_id', document.getElementById('department').value);
            formData.append('pos_id', document.getElementById('job_position').value);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);


            
            const token = localStorage.getItem('authToken');


            const url = 'http://localhost:8000/employees'; // Replace with your API endpoint

            fetch(url, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle success response
                console.log('Success:', data);
                alert('Employee updated successfully!');
                // Optionally redirect to another page
                history.back();
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
                alert('Failed to update employee: ' + error.message);
            });
        });
    </script>
</body>

</html>
