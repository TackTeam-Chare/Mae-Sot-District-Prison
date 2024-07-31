<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขผู้ต้องขัง</title>
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
            <h1>แก้ไขผู้ต้องขัง</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updatePrisonerForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">    
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อผู้ต้องขัง</label>
                <input type="text" class="form-control" placeholder="ชื่อผู้ต้องขัง" name="name" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">ภาพผู้ต้องขัง</label>
                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event)">
                <img id="currentImage" style="display: none; max-width: 200px; margin-top: 10px;" />
            </div>
            <fieldset class="mb-3">
                <legend class="form-label">เพศ</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="1" required>
                    <label class="form-check-label" for="gender_male">
                        ชาย
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="0" required>
                    <label class="form-check-label" for="gender_female">
                        หญิง
                    </label>
                </div>
            </fieldset>
            <div class="mb-3">
                <label for="nationality" class="form-label">สัญชาติ</label>
                <select class="form-control" name="nationality" required>
                    <option value="Thai">ไทย</option>
                    <option value="Foreign">ต่างชาติ</option>
                </select>
            </div>
            <button type="submit" id="submitForm" class="btn btn-primary">บันทึก</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const prisonerId = <?php echo $_GET['id']; ?>; // Get prisoner ID from URL parameter
            const token = localStorage.getItem('authToken');

            // Fetch prisoner details
            fetch(`http://localhost:8000/stuffview_prisoners?id=${prisonerId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(prisoner => {
                // Populate form fields with existing data
                document.querySelector('input[name="name"]').value = prisoner.name;
                if (prisoner.gender == 0) {
                    document.getElementById('gender_female').checked = true;
                } else {
                    document.getElementById('gender_male').checked = true;
                }
                document.querySelector('select[name="nationality"]').value = prisoner.nationality;
                // Display current image if exists
                if (prisoner.image) {
                    const currentImage = document.getElementById('currentImage');
                    currentImage.src = `../../uploads/${prisoner.image}`;
                    currentImage.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching prisoner:', error);
                alert('Failed to fetch prisoner details');
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

        document.getElementById("updatePrisonerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(); // Create FormData object
            formData.append('id', document.querySelector('input[name="id"]').value);
            formData.append('name', document.querySelector('input[name="name"]').value);
            formData.append('gender', document.querySelector('input[name="gender"]:checked').value);
            formData.append('nationality', document.querySelector('select[name="nationality"]').value);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);

            const token = localStorage.getItem('authToken');
            const url = 'http://localhost:8000/prisoners'; // Replace with your API endpoint

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
                alert('Prisoner updated successfully!');
                // Optionally redirect to another page
                history.back();
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
                alert('Failed to update prisoner: ' + error.message);
            });
        });
    </script>
</body>

</html>
