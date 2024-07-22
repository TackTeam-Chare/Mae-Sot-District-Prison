
    <style>
        div.card {
            width: 100%;
            height: auto;
            /* ทำให้การ์ดมีความสูงอัตโนมัติ */
        }

        img.card-img-top {
            width: 100%;
            max-height: 400px;
            /* จำกัดความสูงของรูปภาพ */
            object-fit: cover;
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }

        .card-body {
            overflow: hidden;
            /* ป้องกันไม่ให้ข้อความล้นออกนอก card */
            text-overflow: ellipsis;
            /* เพิ่มจุดต่อท้ายถ้าข้อความยาวเกินไป */
            display: -webkit-box;
            -webkit-line-clamp: 4;
            /* จำนวนบรรทัดที่ต้องการแสดง */
            -webkit-box-orient: vertical;
        }

        .card-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-text {
            height: 100px;
            /* จำกัดความสูงของ card-text */
            overflow-y: auto;
            /* เพิ่มการเลื่อนถ้าข้อความเกิน */
        }

        /* ปรับความกว้างของการ์ดตามขนาดหน้าจอ */
        @media (min-width: 768px) {
            .col-md-8 {
                max-width: 80%;
            }
        }

        @media (min-width: 992px) {
            .col-lg-8 {
                max-width: 60%;
            }
        }

        /* Style pagination to match the tone */
        .pagination .page-item .page-link {
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .pagination .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-item .page-link:hover {
            color: #0056b3;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
    </style>


    <div class="container">
        <h1 class="text-center mb-4 fw-bold text-white">ข่าวประชาสัมพันธ์</h1>
        <hr>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col" id="events-container">
                <!-- Events will be dynamically added here -->
            </div>
        </div>
        <nav class="mt-5 text-center" aria-label="Page navigation example">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination will be dynamically added here -->
            </ul>
        </nav>
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
                eventCard.classList.add('card', 'mb-3');

                const imageUrl = event.image ? `../../uploads/${event.image}` : '../../img/no_image.png';

                eventCard.innerHTML = `
                    <div class="card-body">
                        <img src="${imageUrl}" alt="event image" class="img-fluid mb-3">
                        <h5 class="card-title">${event.title}</h5>
                        <p class="card-text">${event.content}</p>
                        <a href="../new.php?id=${event.id}" class="btn btn-success">อ่านเพิ่มเติม</a>
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
