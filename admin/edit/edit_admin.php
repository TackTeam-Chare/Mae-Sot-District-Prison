<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขผู้ดูแลระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>แก้ไขผู้ดูแลระบบ</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updateAdminForm">
            <input type="hidden" value="<?php echo htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); ?>" name="id">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control" placeholder="ชื่อ" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล์</label>
                <input type="email" class="form-control" placeholder="อีเมล์" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่านเก่า</label>
                <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">รหัสผ่านใหม่</label>
                <input type="password" class="form-control" placeholder="รหัสผ่านใหม่" name="new_password">
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
                <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const adminId = "<?php echo htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); ?>"; // Get admin ID from URL parameter
            const url = `http://localhost:8000/stuffview_admins?id=${adminId}`;
            const token = localStorage.getItem('authToken');

            // Fetch admin details
            fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text) });
                }
                return response.json();
            })
            .then(admin => {
                // Populate form fields with existing data
                document.querySelector('input[name="name"]').value = admin.name;
                document.querySelector('input[name="email"]').value = admin.email;
                if (admin.is_main_priority == 1) {
                    document.getElementById('is_main_admin_yes').checked = true;
                } else {
                    document.getElementById('is_main_admin_no').checked = true;
                }
            })
            .catch(error => {
                console.error('Error fetching admin:', error);
                alert('Failed to fetch admin details');
            });
        });

        document.getElementById("updateAdminForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const id = document.querySelector('input[name="id"]').value;
            const isMainAdminValue = document.querySelector('input[name="is_main_admin"]:checked').value;
            const isMainAdmin = isMainAdminValue === 'true' ? 1 : 0; // Convert string 'true'/'false' to 1/0

            const formData = {
                id: id,
                name: document.querySelector('input[name="name"]').value,
                email: document.querySelector('input[name="email"]').value,
                password: document.querySelector('input[name="password"]').value,
                new_password: document.querySelector('input[name="new_password"]').value,
                is_main_admin: isMainAdmin // Use 1/0 value
            };

            const token = localStorage.getItem('authToken');
            const url = `http://localhost:8000/admins`;

            fetch(url, {
                method: 'PUT',
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
                alert('Admin updated successfully!');
                history.back();
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
                alert('Failed to update admin: ' + error.message);
            });
        });
    </script>
</body>

</html>
