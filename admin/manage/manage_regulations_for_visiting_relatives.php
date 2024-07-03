<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        h1 {
            font-weight: 900;
        }
        .card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-section,
        .events-section {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลระเบียบการเข้าเยี่ยมญาติ</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_regulations_for_visiting_relatives.php" class="text-white text-decoration-none">Add</a></button>
            </div>
            <div class="col-lg-12 events-section" id="events-container">
                <!-- Events will be dynamically added here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('http://localhost:8000/visiting_rules')
                .then(response => response.json())
                .then(data => {
                    const eventsContainer = document.getElementById('events-container');

                    data.forEach(event => {
                        const eventCard = document.createElement('div');
                        eventCard.classList.add('card', 'mb-3');

                        // Check if event.image exists and use it, otherwise use a default icon
                        
                        const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';

                        eventCard.innerHTML = `
                     
                            <div class="card-body">
                                <img src="../../uploads/${imageUrl}" alt="event image" class="img-fluid mb-3" >
                                <h5 class="card-title">${event.title}</h5>
                                <p class="card-text">${event.content}</p>
                               
                                <div class="d-flex justify-content-end">
                                    <a href="../edit/edit_regulations_for_visiting_relatives.php?id=${event.id}" class="btn btn-success me-2">Edit</a>
                                    <button class="btn btn-danger" onclick="confirmDelete(${event.id})">Delete</button>
                                </div>
                            </div>
                        `;

                        eventsContainer.appendChild(eventCard);
                    });
                })
                .catch(error => console.error('Error fetching events:', error));
        });

        function confirmDelete(eventId) {
            if (confirm('Are you sure you want to delete this event?')) {
                deleteEvent(eventId);
            }
        }

        function deleteEvent(eventId) {
            fetch(`http://localhost:8000/visiting_rule_delete?id=${eventId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    alert('Event deleted successfully!');
                    location.reload(); // Reload the page to reflect the changes
                })
                .catch(error => {
                    console.error('Error deleting event:', error);
                    alert('Failed to delete event: ' + error.message);
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
