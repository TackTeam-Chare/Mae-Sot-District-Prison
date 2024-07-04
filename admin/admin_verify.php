<!DOCTYPE html>
<html lang="en">
<head>
    <title>เรือนจำอำเภอแม่สอด</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card">
            <h3 class="text-center mb-4">Admin Login</h3>
            <div id="alertPlaceholder"></div> <!-- Alert placeholder -->
            <form id="loginForm" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" value="Login" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const formData = new FormData(event.target); // Create FormData object from form
            const url = 'http://localhost:8000/login'; // Replace with your API endpoint
            var status = null;
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                status = response['status'];
                return response.json()
            })
            .then(data => {
                console.log('token:', data['token']);
                if (status == 200) {
                    alert('Login successfully!');
                    window.location.href = "dashboard.php";
                } else {
                    showAlert('Login failed! ', 'danger');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                showAlert('An error occurred during login. Please try again later.', 'danger');
            });
        });

        function showAlert(message, type) {
            const alertPlaceholder = document.getElementById('alertPlaceholder');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show`;
            alert.role = 'alert';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            alertPlaceholder.append(alert);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
