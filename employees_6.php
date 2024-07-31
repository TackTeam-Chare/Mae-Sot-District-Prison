<!doctype html>
<html lang="th">

<head>
    <title>แผนผังฝ่ายการศึกษา</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: rgb(179, 78, 78);
            border-radius: 2px;
            margin: 1rem;
            padding: 25px;
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

        .card-img-top {
            height: 300px;
            background-size: cover;
            background-position: center;
        }

        .tree {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .node {
            text-align: center;
            margin: 20px;
        }

        .node img {
            width: 150px;
            height: 150px;
            border: 3px solid #ddd;
        }

        .children {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php include('./layout/navbar.php'); ?>
    <div class="container my-5">
        <h2 class="text-white mb-4">แผนผังฝ่ายการศึกษา</h2>
        <hr class="bg-white my-4" style="height: 3px;">
        <div class="tree" id="tree">
            <!-- Nodes will be dynamically added here -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="./img/04.jpg" class="card-img-top mb-3" alt="...">
                    <p>Description</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('./layout/footer.php'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const token = localStorage.getItem('authToken');
            fetch('http://localhost:8000/stuffview_employees?dep_id=6', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    const tree = document.getElementById('tree');

                    const createNode = (name, position, image) => {
                        const node = document.createElement('div');
                        node.classList.add('node');
                        node.innerHTML = `
                            <img src="${image}" alt="${name}">
                            <div>${name}</div>
                            <div>${position}</div>
                        `;
                        node.addEventListener('click', () => {
                            document.getElementById('productModalLabel').innerText = name;
                            document.querySelector('#productModal .card-img-top').src = image;
                            document.querySelector('#productModal .card-img-top').alt = name;
                            document.querySelector('#productModal .modal-body p').innerText = position;
                            new bootstrap.Modal(document.getElementById('productModal')).show();
                        });
                        return node;
                    };

                    data.forEach((employee, index) => {
                        const imageUrl = employee.image ? `../../uploads/${employee.image}` : '../../img/no_image.png';
                        const node = createNode(employee.name, employee.pos_name, imageUrl);
                        
                        // Add the node to the tree
                        if (index < 2) {
                            tree.appendChild(node);
                        } else if (index < 7) {
                            let childrenContainer = tree.querySelector('.children');
                            if (!childrenContainer) {
                                childrenContainer = document.createElement('div');
                                childrenContainer.classList.add('children');
                                tree.appendChild(childrenContainer);
                            }
                            childrenContainer.appendChild(node);
                        }
                    });
                })
                .catch(error => console.error('Error fetching employees:', error));
        });
    </script>
</body>

</html>