<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจัดการข้อมูลกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include_once('../layout/navbar.php') ?>
    <div class="container my-5">
        <h1 class="text-center mb-4 fw-bold">การจัดการข้อมูลกิจกรรม</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="d-flex justify-content-end align-items-center mb-3">
                <button class="btn btn-primary"><a href="../add/add_event.php" class="text-white text-decoration-none">Add</a></button>
            </div>
            <div class="col-lg-12 events-section" id="events-container">
                <!-- Events will be dynamically added here -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="events-table-body">
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_events',{
                headers:{
                    'Authorization':`Bearer ${token}`,
                }
            })
                .then(response => response.json())
                .then(data => {
                    const eventsTableBody = document.getElementById('events-table-body');

                    data.forEach(event => {
                        const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';

                        const eventRow = document.createElement('tr');

                        eventRow.innerHTML = `
                            <td><img src="${imageUrl}" alt="event image" class="img-fluid" style="max-width: 100px;"></td>
                            <td>${event.title}</td>
                            <td>${event.content}</td>
                            <td>${event.allow_publish == 0 ? "ยังไม่เผยเเพร่" : "กำลังเผยเเพร่"}</td>
                            <td class="d-flex gap-2">
                                <a href="../edit/edit_event.php?id=${event.id}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger" onclick="confirmDelete(${event.id})">Delete</button>
                            </td>
                        `;
                        eventsTableBody.appendChild(eventRow);
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
            const token = localStorage.getItem('authToken');
            fetch(`http://localhost:8000/event_delete?id=${eventId}`,{
                headers:{
                    'Authorization':`Bearer ${token}`,
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
