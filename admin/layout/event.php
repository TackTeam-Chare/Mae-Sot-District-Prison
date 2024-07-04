<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        .events-section {
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 900;
        }

        .card-body .img-fluid {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }
    </style>
</head>

<body>
    <div class="container ">
        <h1 class="text-center mb-4 fw-bold">ข่าวประชาสัมพันธ์</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-12 events-section" id="events-container">
                <!-- Events will be dynamically added here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('http://localhost:8000/events')
                .then(response => response.json())
                .then(data => {
                    const eventsContainer = document.getElementById('events-container');

                    data.forEach(event => {
                        const eventCard = document.createElement('div');
                        eventCard.classList.add('card', 'mb-3');

                        const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';

                        eventCard.innerHTML = `
                            <div class="card-body">
                                     <img src="${imageUrl}" alt="event image" class="img-fluid mb-3">
                                <h5 class="card-title">${event.title}</h5>
                                <p class="card-text">${event.content}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="../../admin/edit/edit_event.php?id=${event.id}" class="btn btn-success me-2">Detail</a>
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
            fetch(`http://localhost:8000/event_delete?id=${eventId}`, {
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
                    location.reload();
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