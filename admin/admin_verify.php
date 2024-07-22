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
            background-image: url('img/background.jpg'); /* Add a background image if desired */
            background-size: cover;
            background-position: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .input-group-text {
            background-color: #e9ecef;
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

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Assuming the token is in the response data
                const token = data.token;
                if (token) {
                    // Save token to localStorage
                    localStorage.setItem('authToken', token);
                    showAlert('Login successful!', 'success');
                    setTimeout(() => {
                        window.location.href = "dashboard.php";  
                    }, 3000); // Wait 3 seconds before redirecting
                } else {
                    showAlert('Login failed! Please check your credentials.', 'danger');
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
