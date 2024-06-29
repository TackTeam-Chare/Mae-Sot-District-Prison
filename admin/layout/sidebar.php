<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
            height: 100vh; /* Ensure body takes the full viewport height */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Ensure it is above other content */
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            position: fixed;
            top: 56px; /* Below the fixed navbar */
            bottom: 0; /* Align with the bottom of the viewport */
            height: calc(100vh - 56px - 70px); /* Adjust height considering navbar and footer */
            overflow-y: auto;
            z-index: 900;
        }

        .sidebar h2 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .sidebar .nav-link {
            color: white;
            font-size: 1rem;
            margin: 5px 0;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .sidebar .nav-link.collapsible::after {
            content: '\f078'; /* FontAwesome caret down */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            float: right;
            transition: transform 0.3s;
        }

        .sidebar .nav-link.collapsible[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        .sidebar .collapse {
            margin-left: 15px;
            border-left: 2px solid #007bff;
            padding-left: 15px;
        }

        .sidebar .collapse .nav-link {
            font-size: 0.9rem;
            margin: 3px 0;
        }

        .content {
            margin-top: 56px; /* Below the fixed navbar */
            margin-left: 250px; /* Align next to the sidebar */
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f8f9fa;
            overflow-y: auto;
            height: calc(100vh - 56px - 70px); /* Adjust height considering navbar and footer */
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            left: 250px; /* Align with the sidebar */
            width: calc(100% - 250px);
            text-align: center;
            height: 70px; /* Fixed height for the footer */
        }

        .footer p {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                height: calc(100vh - 56px - 70px); /* Adjust for smaller screens */
            }

            .content {
                margin-left: 200px;
                width: calc(100% - 200px);
                height: calc(100vh - 56px - 70px); /* Adjust height considering navbar and footer */
            }

            .footer {
                left: 200px;
                width: calc(100% - 200px);
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link collapsible" data-bs-toggle="collapse" href="#dashboardMenu" role="button" aria-expanded="false" aria-controls="dashboardMenu">
                Dashboard
            </a>
            <div class="collapse" id="dashboardMenu">
                <a class="nav-link" href="#">Overview</a>
                <a class="nav-link" href="#">Analytics</a>
            </div>
            <a class="nav-link" href="#">Orders</a>
            <a class="nav-link collapsible" data-bs-toggle="collapse" href="#accountMenu" role="button" aria-expanded="false" aria-controls="accountMenu">
                Account
            </a>
            <div class="collapse" id="accountMenu">
                <a class="nav-link" href="#">Profile</a>
                <a class="nav-link" href="#">Settings</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar -->

    <!-- Content -->
    <div class="content">
        <!-- Main content goes here -->
    </div>
    <!-- Content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-muted mb-0">Admin Dashboard &copy; 2024 | Powered by Your Company</p>
        </div>
    </footer>
    <!-- Footer -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ensure the collapsible icons rotate correctly
        document.querySelectorAll('.collapsible').forEach(function(collapsibleLink) {
            collapsibleLink.addEventListener('click', function() {
                var expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
            });
        });
    </script>
</body>

</html>
