<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวประชาสัมพันธ์</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        .container {
            font-family: 'Noto Sans Thai', sans-serif;
        }

        .card.mb-3 {
            margin-left: auto;
            margin-right: auto;
            max-width: 730px;
        }

        .card-body {
            width: 100%;
        }

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
            height: 330px;
            object-fit: cover;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }
        div.card.mb-3 {
            margin-left: auto;
            margin-right: auto;
            width: 800px;
        }

        .card-body{
            width: 100%;
            height: auto;
        }

        .events-section {
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 900;
        }

    </style>
</head>

<body>
    <?php include('./layout/navbar.php'); ?>

    <div class="container">
        <h1 class="text-center mb-4 fw-bold text-white mt-3">ข่าวประชาสัมพันธ์</h1>
        <hr>
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-12 events-section" id="events-container">
                <!-- Events will be dynamically added here -->
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination will be dynamically added here -->
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">รายละเอียดกิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="eventModalBody">
                        <!-- Event details will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./layout/footer.php'); ?>

    <script>
        let currentPage = 1;
        const eventsPerPage = 1;
        let totalEvents = 0;
        let allEvents = [];

        document.addEventListener("DOMContentLoaded", function() {
            fetch('http://localhost:8000/events')
                .then(response => response.json())
                .then(data => {
                    allEvents = data;
                    totalEvents = data.length;
                    displayEvents(currentPage);
                    setupPagination(totalEvents, eventsPerPage);
                })
                .catch(error => console.error('Error fetching events:', error));
        });

        function displayEvents(page) {
            const startIndex = (page - 1) * eventsPerPage;
            const endIndex = startIndex + eventsPerPage;
            const eventsToDisplay = allEvents.slice(startIndex, endIndex);

            const eventsContainer = document.getElementById('events-container');
            eventsContainer.innerHTML = '';

            eventsToDisplay.forEach(event => {
                const eventCard = document.createElement('div');
                eventCard.classList.add('card', 'mb-3');

                const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';

                eventCard.innerHTML = `
                    <div class="card-body">
                        <img src="${imageUrl}" alt="event image" class="img-fluid mb-3">
                        <h5 class="card-title">${event.title}</h5>
                        <p class="card-text">${event.content}</p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eventModal" onclick="loadEventDetails(${event.id})">
                            ดูรายละเอียด
                        </button>
                    </div>
                `;

                eventsContainer.appendChild(eventCard);
            });
        }

        function setupPagination(totalItems, itemsPerPage) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            const createPageItem = (page, isActive = false) => {
                const li = document.createElement('li');
                li.classList.add('page-item');
                if (isActive) li.classList.add('active');

                const a = document.createElement('a');
                a.classList.add('page-link');
                a.href = '#';
                a.textContent = page;
                a.addEventListener('click', (event) => {
                    event.preventDefault();
                    currentPage = page;
                    displayEvents(currentPage);
                    setupPagination(totalEvents, eventsPerPage);
                });

                li.appendChild(a);
                return li;
            };

            const prevItem = document.createElement('li');
            prevItem.classList.add('page-item');
            prevItem.innerHTML = `<a class="page-link" href="#" aria-label="Previous">&laquo;</a>`;
            prevItem.addEventListener('click', (event) => {
                event.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    displayEvents(currentPage);
                    setupPagination(totalEvents, eventsPerPage);
                }
            });
            pagination.appendChild(prevItem);

            for (let i = 1; i <= totalPages; i++) {
                pagination.appendChild(createPageItem(i, i === currentPage));
            }

            const nextItem = document.createElement('li');
            nextItem.classList.add('page-item');
            nextItem.innerHTML = `<a class="page-link" href="#" aria-label="Next">&raquo;</a>`;
            nextItem.addEventListener('click', (event) => {
                event.preventDefault();
                if (currentPage < totalPages) {
                    currentPage++;
                    displayEvents(currentPage);
                    setupPagination(totalEvents, eventsPerPage);
                }
            });
            pagination.appendChild(nextItem);
        }

        function loadEventDetails(eventId) {
            const event = allEvents.find(event => event.id === eventId);
            const eventModalBody = document.getElementById('eventModalBody');
            eventModalBody.innerHTML = `
                <h5>${event.title}</h5>
                <img src="../../uploads/${event.image}" class="img-fluid mb-3" alt="Event Image">
                <p>${event.content}</p>
            `;
        }
    </script>

</body>

</html>
