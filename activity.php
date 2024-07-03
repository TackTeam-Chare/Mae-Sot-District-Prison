<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>กิจกรรม</title>
  <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('./layout/navbar.php'); ?>
  <div class="container mt-5">
    <h1 class="text-center mb-4" style="color: aliceblue; font-weight: bold;">ระเบียบการเยี่ยมญาติ</h1>
    <div class="row justify-content-center" id="content">
      <!-- Dynamic content will be injected here -->
    </div>
  </div>

  <?php include('./layout/footer.php'); ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetch('http://localhost:8000/visiting_rules')
        .then(response => response.json())
        .then(data => {
          const contentDiv = document.getElementById('content');
          data.forEach(item => {
            const colDiv = document.createElement('div');
            colDiv.className = 'col-md-8 mb-3';

            const card = `
              <div class="card">
                <img src="../../uploads/${item.image}" class="card-img-top" alt="${item.title}">
                <div class="card-body">
                  <h5 class="card-title">${item.title}</h5>
                  <p class="card-text">${item.content}</p>
                </div>
              </div>
            `;

            colDiv.innerHTML = card;
            contentDiv.appendChild(colDiv);
          });
        })
        .catch(error => console.error('Error fetching JSON:', error));
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
