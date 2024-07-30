<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        body {
            text-align: center;
            background-color: #f5f5f5;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            margin-top: 20px;
            font-size: 2.5rem;
            color: #333;
            animation: fadeIn 1s ease-in-out;
        }

        .map-container {
            text-align: center;
            margin-top: 20px;
            animation: fadeInUp 1s ease-in-out;
        }

        .iframe {
            width: 100%;
            max-width: 100%;
            height: 600px;
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .card {
            margin-top: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: fit-content;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .card-body {
            flex: 1;
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card-text {
            line-height: 1.6;
            color: #666;
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="mt-4">แผนที่เรือนจำอำเภอแม่สอด</h1>
        <div class="map-container">
            <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3821.277474354053!2d98.57530591429452!3d16.71300142630372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30dd98b51c22209b%3A0x9f9ecbc69dec0fa8!2z4LmA4Lij4Li34Lit4LiZ4LiI4Liz4Lit4Liz4LmA4Lig4Lit4LmB4Lih4LmI4Liq4Lit4LiU!5e0!3m2!1sth!2sth!4v1647395813755!5m2!1sth!2sth" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div id="cards-container"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('http://localhost:8000/viewScreen_contents?id=4') // Replace with the actual URL of your JSON file or API endpoint
                .then(response => response.json())
                .then(data => {
                    const cardsContainer = document.getElementById('cards-container');

                    const card = document.createElement('div');
                    card.className = 'card';

                    const cardBody = `
                        <div class="card-body">
                            <h5 class="card-title">${data.title}</h5>
                            <p class="card-text">${data.content.replace(/\r\n/g, '<br>')}</p>
                        </div>
                    `;
                    card.innerHTML = cardBody;
                    cardsContainer.appendChild(card);

                    // Add show class to trigger animation
                    setTimeout(() => {
                        card.classList.add('show');
                    }, 100);
                })
                .catch(error => console.error('Error fetching JSON:', error));
        });
    </script>
</body>
</html>
