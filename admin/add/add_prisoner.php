<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ต้องขัง</title>
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
            <h1>เพิ่มผู้ต้องขัง</h1>
            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        </div>
        <form id="addPrisonerForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อผู้ต้องขัง</label>
                <input type="text" class="form-control" placeholder="ชื่อผู้ต้องขัง" name="name" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">ภาพผู้ต้องขัง</label>
                <input type="file" class="form-control" name="image" accept="image/*">
            </div>
            <fieldset class="mb-3">
                <legend class="form-label">เพศ</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="0" required>
                    <label class="form-check-label" for="gender_male">
                        ชาย
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="1" required>
                    <label class="form-check-label" for="gender_female">
                        หญิง
                    </label>
                </div>
            </fieldset>
            <fieldset class="mb-3">
                <legend class="form-label">สัญชาติ</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_thai" id="is_thai_yes" value="0" required>
                    <label class="form-check-label" for="is_thai_yes">
                        ไทย
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_thai" id="is_thai_no" value="1" required>
                    <label class="form-check-label" for="is_thai_no">
                        ต่างประเทศ
                    </label>
                </div>
            </fieldset>
            <button type="submit" id="submitForm" class="btn btn-primary">บันทึก</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("addPrisonerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const getGender = document.querySelector('input[name="gender"]:checked').value;
            const getIsThai = document.querySelector('input[name="is_thai"]:checked').value;
            
            const gender = getGender === '0' ? 0 : 1; 
            const is_thai = getIsThai === '0' ? 0 : 1; 
            
            const formData = new FormData(); // Create FormData object
            formData.append('name', document.querySelector('input[name="name"]').value);
            formData.append('gender',gender);
            formData.append('type',is_thai);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);

            const url = 'http://localhost:8000/prisoners'; // Replace with your API endpoint
            const token = localStorage.getItem('authToken');
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
                    alert('Prisoner added successfully!');
                    goBackAndReset();
                    // Optionally redirect to another page
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                    alert('Failed to add prisoner: ' + error.message);
                });
        });

        function goBackAndReset() {
            sessionStorage.setItem('refreshPreviousPage', 'true');
            // Navigate to the previous page
            window.history.back();
        }
    </script>
</body>

</html>
