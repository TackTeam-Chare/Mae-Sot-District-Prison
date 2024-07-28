
<body>
    <div class="container">
        <h1 class="text-center mb-4 fw-bold text-white">ข่าวประชาสัมพันธ์</h1>
        <hr>
        <div class="row row-cols-1 row-cols-md-2 g-4" id="events-container">
            <!-- Events will be dynamically added here -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">รายละเอียดข่าวประชาสัมพันธ์</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="eventImage" src="" class="img-fluid mb-3" alt="event image">
                    <h5 id="eventTitle"></h5>
                    <p id="eventContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPage = 1;
        const eventsPerPage = 4; // จำกัดแสดงเพียง 4 ข่าวต่อหน้า
        let totalEvents = 0;
        let allEvents = [];

        document.addEventListener("DOMContentLoaded", function () {
            fetch('http://localhost:8000/viewEvents')
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
                eventCard.classList.add('col');

                const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';

                eventCard.innerHTML = `
                    <div class="card h-100">
                        <img src="${imageUrl}" class="card-img-top" alt="event image">
                        <div class="card-body">
                            <h5 class="card-title">${event.title}</h5>
                            <p class="card-text">${event.content}</p>
                            <button class="btn btn-success" onclick="showEventDetails(${event.id})">อ่านเพิ่มเติม</button>
                        </div>
                    </div>
                `;

                eventsContainer.appendChild(eventCard);
            });
        }

        function showEventDetails(eventId) {
            const event = allEvents.find(event => event.id === eventId);

            if (event) {
                const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';
                document.getElementById('eventImage').src = imageUrl;
                document.getElementById('eventTitle').innerText = event.title;
                document.getElementById('eventContent').innerText = event.content;

                const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
