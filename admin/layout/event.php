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
    <div class="container">
        <h1 class="text-center mb-4 fw-bold">ข่าวประชาสัมพันธ์</h1>
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
                        <div class="d-flex justify-content-end">
                            <a href="../../admin/edit/edit_event.php?id=${event.id}" class="btn btn-success me-2">Detail</a>
                        </div>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
