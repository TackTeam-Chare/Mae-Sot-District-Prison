<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเอกสาร</title>
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
            <h1>เพิ่มเอกสาร</h1>
            <button class="btn btn-secondary" onclick="goBackAndReset()">กลับ</button>
        </div>
        <form id="addProductForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">ชื่อเอกสาร</label>
                <input type="text" class="form-control" placeholder="หัวข่าว" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">รายละเอียดเอกสาร</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่บทความเนื้อหาข่าวสาร" required></textarea>
            </div>
            <div class="mb-3">
                <label for="document" class="form-label">เอกสาร</label>
                <input type="file" class="form-control" name="document" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx">
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
            window.history.back();
        }

        document.getElementById("addProductForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData();
            formData.append('title', document.querySelector('input[name="title"]').value);
            formData.append('content', document.querySelector('textarea[name="content"]').value);
            formData.append('document', document.querySelector('input[name="document"]').files[0]);
     
            const url = 'http://localhost:8000/docs'; // Update with your API endpoint
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
                    console.log('Success:', data);
                    alert('Document added successfully!');
                    goBackAndReset();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to add document: ' + error.message);
                });
        });
    </script>
</body>

</html>
