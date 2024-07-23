<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>แก้ไขกิจกรรม</h1>
            <button onclick="window.history.back()" class="btn btn-secondary">กลับ</button>
        </div>
        <form id="updateEventForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
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
                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event)">
                <img class="form-control mt-2" id="currentImage" src="" alt="Current Image">
            </div>
            <fieldset class="mb-3">
                <legend class="form-label">กำหนดการเผยเเพร่</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_main_admin" id="is_main_admin_no" value="0" required>
                    <label class="form-check-label" for="is_main_admin_no">
                        ไม่เผยเเพร่
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_main_admin" id="is_main_admin_yes" value="1" required>
                    <label class="form-check-label" for="is_main_admin_yes">
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
        document.addEventListener("DOMContentLoaded", function() {
            const eventId = <?php echo $_GET['id']; ?>; // Get event ID from URL parameter
            const url = `http://localhost:8000/stuffview_events?id=${eventId}`;
            const token = localStorage.getItem('authToken');
            // Fetch event details
            fetch(url,
                {headers:{
                    "Authorization":`Bearer ${token}`
                }}
            )
                .then(response => response.json())
                .then(event => {
                    // Populate form fields with existing data
                    document.querySelector('input[name="title"]').value = event.title;
                    document.querySelector('textarea[name="content"]').value = event.content;
                    if (event.allow_publish == 0) {
                    document.getElementById('is_main_admin_no').checked = true;
                } else {
                    document.getElementById('is_main_admin_yes').checked = true;
                }
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
            const allow_publish_= document.querySelector('input[name="is_main_admin"]:checked').value;
            const allow_publish= allow_publish_ === '0' ? 0 : 1; 

            const formData = new FormData(); // Create FormData object
            
            formData.append('id', document.querySelector('input[name="id"]').value);
            formData.append('title', document.querySelector('input[name="title"]').value);
            formData.append('content', document.querySelector('textarea[name="content"]').value);
            formData.append('image', document.querySelector('input[name="image"]').files[0]);
            formData.append('allow_publish',allow_publish);

            // Create FormData object
            const token = localStorage.getItem('authToken');



            // Include current image if it exists
            const currentImage = document.getElementById('currentImage');
            if (currentImage.src && currentImage.src.length > 0) {
                formData.append('current_image', currentImage.src);
            }

            const url = 'http://localhost:8000/events'; // Replace with your API endpoint

            fetch(url,{
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                body: formData,
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
