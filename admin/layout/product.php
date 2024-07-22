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

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 900;
        }

        .display--box_sums{
            padding:20px 10px ;
            display:flex;
            flex-direction:column;
            background-color:darkblue;
            border:2px solid none;
            border-radius: 20px;
            color:white;
            transition:0.3s
        }
        .display--box_sums:hover{
            box-shadow: 0 0 20px rgba(50,50,50,.4);
        }
        #nav--button{
            align-self: center;
        }


        
    </style>
</head>

<body>
    <div class="container">
        <hr>
      <div class ='display--box_sums'>
      <h1  id="product-count">
            <!-- Total event count will be dynamically added here -->
    </h1>
        <h1>ผลิตภัณท์</h1>
        <hr style="height:5px;border-width:0;color:gray;background-color:white">
        <div id="nav--button">
        <a  style=' text-decoration: none; color:white;' href="/admin/manage/manage_product.php"><h5>More Info ></h5></a>
        </div>
      </div>
      
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const token = localStorage.getItem("authToken");

            fetch('http://localhost:8000/products_sum', {
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
                const count = data.total_events; // Assuming the API returns { total_events: <count> }
                document.getElementById('product-count').textContent = `${count}`;
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
