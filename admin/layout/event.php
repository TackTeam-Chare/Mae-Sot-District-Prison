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

        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 900;
        }

        .display--box_sum {
            padding: 20px;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 20px;
            color: #333;
            transition: box-shadow 0.3s;
        }

        .display--box_sum:hover {
            box-shadow: 0 0 20px rgba(50, 50, 50, 0.1);
        }

        #nav--button {
            align-self: center;
        }

        .container {
            margin-top: 50px;
        }

        hr {
            border: 0;
            height: 1px;
            background: #333;
            background-image: linear-gradient(to right, #ccc, #333, #ccc);
        }

        .event-count {
            font-size: 3rem;
            font-weight: 900;
            color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="display--box_sum">
            <h1 id="event-count" class="event-count">
                <!-- Total event count will be dynamically added here -->
            </h1>
            <h1>ข่าวประชาสัมพันธ์</h1>
            <hr>
            <div id="nav--button">
                <a href="/admin/manage/manage_events.php" class="btn btn-primary">
                    More Info >
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem("authToken");

            fetch('http://localhost:8000/events_sum', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                }
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status === 401) {
                        throw new Error('Unauthorized: Invalid token');
                    } else {
                        return response.text().then(text => { throw new Error(text) });
                    }
                }
                return response.json();
            })
            .then(data => {
                const count = data.total_events;
                document.getElementById('event-count').textContent = `${count} กิจกรรม`;
            })
            .catch(error => {
                console.error('Error fetching event count:', error);
                alert('Error fetching event count: ' + error.message);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
