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
            <h1>แก้ไขข้อมูลพันธกิจ</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updateEventForm" enctype="multipart/form-data">
            <input type="hidden" value="2" name="id">
            <div class="mb-3">
                <label for="title" class="form-label">หัวเรื่อง</label>
                <input type="text" class="form-control" placeholder="หัวเรื่องข้อมูลพันธกิจ" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">เนื้อหาข้อมูลพันธกิจ</label>
                <textarea class="form-control" name="content" rows="5" placeholder="ใส่บทความเนื้อหาข้อมูลพันธกิจ" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">ภาพข้อมูลประกอบเนื้อหา</label>
                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event)">
                <img id="currentImage" src="" alt="Current Image">
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
            const eventId = 2; // Get event ID from URL parameter
            const url = `http://localhost:8000/screen_contents?id=${eventId}`;

            // Fetch event details
            fetch(url)
                .then(response => response.json())
                .then(event => {
                    // Populate form fields with existing data
                    document.querySelector('input[name="title"]').value = event.title;
                    document.querySelector('textarea[name="content"]').value = event.content;

                    // Display current image if exists
                    if (event.image) {
                        const currentImage = document.getElementById('currentImage');
                        currentImage.src = `../../uploads/${event.image}`;
                        currentImage.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching event:', error);
                    alert('Failed to fetch event details');
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

        document.getElementById("updateEventForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(this); // Create FormData object

            // Include current image if it exists
            const currentImage = document.getElementById('currentImage');
            if (currentImage.src && currentImage.src.length > 0) {
                formData.append('current_image', currentImage.src);
            }

            const url = 'http://localhost:8000/screen_contents'; // Replace with your API endpoint

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
                location.reload();

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
