<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>
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
        #currentImage {
            max-width: 100%;
            display: none;
        }
    </style>
</head>
<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>แก้ไขสินค้า</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updateAdminForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" placeholder="ชื่อ" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" placeholder="อีเมล์" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่านเก่า</label>
                <input type="text" class="form-control" placeholder="รหัสผ่าน" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่านใหม่</label>
                <input type="text" class="form-control" placeholder="รหัสผ่าน" name="new_password">
            </div>


            <div>
                <button type="submit" id="submitForm" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const eventId = <?php echo $_GET['id']; ?>; // Get event ID from URL parameter
            const url = `http://localhost:8000/admins?id=${eventId}`;

            // Fetch event details
            fetch(url)
                .then(response => response.json())
                .then(admins => {
                    // Populate form fields with existing data
                    document.querySelector('input[name="name"]').value = admins.name;
                    document.querySelector('input[name="email"]').value = admins.email;    
                })
                .catch(error => {
                    console.error('Error fetching event:', error);
                    alert('Failed to fetch event details');
                });
        });


        document.getElementById("updateAdminForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(this); // Create FormData object

            const url = 'http://localhost:8000/admins'; // Replace with your API endpoint

            fetch(url, {
                method: 'POST', // Use POST instead of PUT due to HTML form restrictions
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
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
                alert('Event updated successfully!');
                // Optionally redirect to another page
                history.back();
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
                alert('Failed to update event: ' + error.message);
            });
        });
    </script>
</body>
</html>
