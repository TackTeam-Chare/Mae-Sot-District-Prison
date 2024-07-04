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
</head>

<body>
    <?php include('./layout/navbar.php'); ?>

    <section>
        <div class="container py-5">
            <h2 style="color: #ffffff;">ข่าวประชาสัมพันธ์</h2>
            <div id="newsList"></div>
        </div>
    </section>



    <?php include('./layout/footer.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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