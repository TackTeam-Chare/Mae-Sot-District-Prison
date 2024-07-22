<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ดูเเลระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 800px; }
        h1 { font-size: 2rem; margin-bottom: 1rem; }
        .btn-secondary a { color: white; text-decoration: none; }
        .btn-secondary a:hover { color: white; text-decoration: none; }
        .form-label { font-weight: bold; }
        .form-control { border-radius: 0.25rem; }
        textarea.form-control { resize: none; }
        button.btn-primary { background-color: #007bff; border: none; }
        button.btn-primary:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>เพิ่มผู้ดูเเลระบบ</h1>
            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        </div>
        <form id="addAdminForm" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" placeholder="ชื่อผู้ดูเเลระบบ" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" placeholder="ใส่อีเมล์ผู้ดูเเลระบบ" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" placeholder="ใส่รหัสผู้ดูเเลระบบ" name="password" required>
            </div>
            <fieldset class="mb-3">
    <legend class="form-label">ผู้ดูแลหลัก:</legend>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="is_main_admin" id="is_main_admin_yes" value="true" required>
        <label class="form-check-label" for="is_main_admin_yes">
            หลัก
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="is_main_admin" id="is_main_admin_no" value="false" required>
        <label class="form-check-label" for="is_main_admin_no">
            รอง
        </label>
    </div>
</fieldset>

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
        }

        document.getElementById("addAdminForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    const isMainAdminValue = document.querySelector('input[name="is_main_admin"]:checked').value;
    const isMainAdmin = isMainAdminValue === 'true'; // Convert string 'true'/'false' to boolean

    const formData = {
        name: document.querySelector('input[name="name"]').value,
        email: document.querySelector('input[name="email"]').value,
        password: document.querySelector('input[name="password"]').value,
        is_main_admin: isMainAdmin // Use boolean value
    };

    const url = 'http://localhost:8000/admins'; // Replace with your API endpoint
    const token = localStorage.getItem('authToken');
    console.log(token);
    fetch(url, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`, // Include the token in the Authorization header
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            // Handle success response
            console.log('Success:', data);
            goBackAndReset();
        })
        .catch(error => {
            // Handle error
            console.error('Error:', error);
            alert('Error: ' + error.message);
        });
});

    </script>
</body>
</html>
