<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ดาวน์โหลดเอกสาร</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
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
            background-color: #f8f9fa;
        }

        h1 {
            margin-top: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .document-row {
            background-color: #ffffff;
            border-radius: 8px;
            border: 2px solid #dc3545;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            transition: transform 0.2s ease-in-out;
        }

        .document-row:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .document-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #dc3545;
            text-align: left;
            margin-bottom: 10px;
        }

        .document-content {
            color: #555;
            text-align: left;
            margin-bottom: 10px;
        }

        .btn-download {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            margin-top: 10px;
        }

        .btn-download:hover {
            background-color: #a71d2a;
        }
    </style>
</head>

<body>
    <?php include('./layout/navbar.php'); ?>

    <div class="container mt-5">
        <h1 class="mb-4">ดาวน์โหลดเอกสาร</h1>
        <div id="documents-container"></div>
    </div>

    <?php include('./layout/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_docs', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(docs => {
                const documentsContainer = document.getElementById('documents-container');
                docs.forEach(doc => {
                    const documentRow = `
                        <div class="document-row">
                            <div class="document-title">${doc.title}</div>
                            <div class="document-content">${doc.content}</div>
                            <a href="../../uploads/${doc.document}" class="btn btn-download" download>
                                <i class="fas fa-file-pdf"></i> ดาวน์โหลดเอกสาร
                            </a>
                        </div>
                    `;
                    documentsContainer.innerHTML += documentRow;
                });
            })
            .catch(error => {
                console.error('Error fetching documents:', error);
                alert('Failed to fetch documents');
            });
        });
    </script>
</body>

</html>
