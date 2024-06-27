<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวกิจกรรม</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .card-subtitle {
            font-size: 0.875rem;
            color: white; 
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
            flex-grow: 1;
        }
        .row-cols-6 {
            gap: 20px;

        }
        .container {
            margin-left: auto;

            margin-right: auto;

            max-width: 100%;
        }
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
<article class="container">
        <h1 class="top23 text-center" style="color: rgb(255, 255, 255);">ข่าวกิจกรรม</h1>
        <br>
        <div class="row row-cols-1 row-cols-md-6 g-3 justify-content-center align-items-center">
    
            <?php
        $query = mysqli_query($con, "select * from events where 1 order by id desc");
        while ($result = mysqli_fetch_array($query)) { ?>
            <div class="col mb-3 aos-init">
                <a class="card text-reset text-decoration-none rounded-15" href="new.php">
                    <img src="./uploads/<?php echo $result['image_path']?>" class="card-img-top img-autofit rounded-15" alt="news" style="height:200px;">
                    <div class="card-body">
                        <h5 class="card-title badge bg-primary text-wrap"><?php echo $result['title'];?></h5>
                        <h6 class="card-subtitle mb-2 "><?php echo $result['created_at'];?></h6>
                        <p class="card-text"><?php echo $result['content'];?></p>
                    </div>
                </a>
            </div>

        <?php } ?>
        </div>
    </article>
</body>

</html>