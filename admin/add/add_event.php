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
            <h1>เพิ่มกิจกรรม</h1>
            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        </div>
        <form id="addEventForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">หัวเรื่อง</label>
                <input type="text" class="form-control" placeholder="หัวข่าว" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">เนื้อหาข่าว</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่บทความเนื้อหาข่าวสาร" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">ภาพข่าว</label>
                <input type="file" class="form-control" name="image" accept="image/*">
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
        }

        document.getElementById("addEventForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(); // Create FormData object
            formData.append('title', document.querySelector('input[name="title"]').value);
            formData.append('content', document.querySelector('textarea[name="content"]').value);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);

            // Debugging: Print FormData contents

            const token = localStorage.getItem("authToken");
            fetch('http://localhost:8000/events', {
                method: "POST",
                headers: {
                    'Authorization': `Bearer ${token}` // Include the token in the Authorization header
                },
                body: formData // Do not set 'Content-Type' header with FormData
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
