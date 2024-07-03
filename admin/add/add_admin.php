<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มกิจกรรม</title>
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
            <h1>เพิ่มผู้ดูเเลระบบ</h1>
            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        </div>
        <form id="addAdminForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" placeholder="ชื่อผู้ดูเเลระบบ" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล์</label>
                <input class="form-control" name="email" rows="5" placeholder="ใส่อีเมล์ผู้ดูเเลระบบ" required></input>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input class="form-control" name="password" rows="5" placeholder="ใส่รหัสผู้ดูเเลระบบ" required></input>
            </div>
            <div>
                <button type="submit" id="submitForm" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
function goBackAndReset() {
    sessionStorage.setItem('refreshPreviousPage', 'true');
    // Navigate to the previous page
    window.history.back();

    // After a short delay, reload the previous page to reset its state
}

        document.getElementById("addAdminForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(); // Create FormData object
            formData.append('name', document.querySelector('input[name="name"]').value);
            formData.append('email', document.querySelector('input[name="name"]').value);
            formData.append('password', document.querySelector('input[name="password"]').value);

            const url = 'http://localhost:8000/admins'; // Replace with your API endpoint

            fetch(url, {
                    method: 'POST',
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
                    goBackAndReset();
                    // Optionally redirect to another page
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                });
        });
    </script>

</body>

</html>
