<?php
include_once('./admin/inc/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวประชาสัมพันธ์</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('./layout/navbar.php'); ?>

    <section>
        <div class="container py-5">
            <h2 style="color: #ffffff;">ข่าวประชาสัมพันธ์</h2>
            <div id="newsList"></div>
        </div>
    </section>

    <div class="container mt-5">
        <?php include('./layout/activityNews.php'); ?>
    </div>

    <?php include('./layout/footer.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetchNews(); // Fetch news when the page loads

            function fetchNews() {
                fetch('http://localhost:8000/events') // Replace with your API endpoint
                    .then(response => response.json())
                    .then(data => {
                        const newsListDiv = document.getElementById('newsList');
                        data.forEach(events => {
                            const article = document.createElement('article');
                            article.classList.add('browser');
                            article.innerHTML = `
                                <h2>${events.title}</h2>
                                <img class="img-fluid" src="./uploads/${events.image}">
                                <p>${events.content}</p>

                            `;
                            newsListDiv.appendChild(article);
                        });
                    })
                    .catch(error => console.error('Error fetching news:', error));
            }
        });
    </script>

</body>

</html>
