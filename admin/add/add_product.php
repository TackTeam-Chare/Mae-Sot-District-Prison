<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผลิตภันฑ์</title>
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
            <h1>เพิ่มสินค้า</h1>
            <button class="btn btn-secondary" onclick="window.history.back();">กลับ</button>
        </div>
        <form id="addProductForm" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" placeholder="หัวข่าว" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">รายละเอียดสินค้า</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่บทความเนื้อหาข่าวสาร" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">ภาพสินค้า</label>
                <input type="file" class="form-control" name="image" accept="image/*" >
            </div>
            <fieldset class="mb-3">
                <legend class="form-label">กำหนด</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_main_admin" id="is_main_admin_yes" value="0" required>
                    <label class="form-check-label" for="is_main_admin_yes">
                        ไม่เผยเเพร่
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_main_admin" id="is_main_admin_no" value="1" required>
                    <label class="form-check-label" for="is_main_admin_no">
                        เผยเเพร่
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

    // After a short delay, reload the previous page to reset its state
}

        document.getElementById("addProductForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const allow_publish_= document.querySelector('input[name="is_main_admin"]:checked').value;
            const allow_publish= allow_publish_ === '0' ? 0 : 1; 
            const formData = new FormData(); // Create FormData object
            formData.append('title', document.querySelector('input[name="title"]').value);
            formData.append('content', document.querySelector('textarea[name="content"]').value);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);
            formData.append('allow_publish',allow_publish);

            const url = 'http://localhost:8000/products'; // Replace with your API endpoint
            const token =localStorage.getItem('authToken');
            fetch(url, {
                    method: 'POST',
                    headers:{
                    'Authorization':`Bearer ${token}`
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
                    alert('Event add successfully!');
                    goBackAndReset();
                    // Optionally redirect to another page
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                    alert('Failed to add event: ' + error.message);
                });
        });
    </script>

</body>

</html>
