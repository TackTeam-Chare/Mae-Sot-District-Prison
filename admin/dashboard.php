<!DOCTYPE html>
<html lang="th">

<head>
    <link rel="icon" type="image/x-icon" href="./assets/icons/admin.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบผู้ดูแล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/style.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', sans-serif;
        }

        h1 {
            font-weight: 900;
        }

        .news-section,
        .events-section {
            margin-bottom: 2rem;
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        .card {
            margin-bottom: 2rem;
        }

        .card-title {
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 2rem;
        }

        #chart,
        #charts {
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body>
    <?php include_once('./layout/navbar.php') ?>

    <div class="container main-content mt-4">
        <h1 class="mb-4 text-center">หน้าหลัก</h1>
        <div class="row">
            <div class="col-md-6">
                <?php include_once('../admin/layout/event.php') ?>
            </div>
            <div class="col-md-6">
                <?php include_once('../admin/layout/product.php') ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ยอดผู้ต้องขัง</h5>
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ยอดผู้ต้องขังต่างประเทศ</h5>
                        <div id="chart_other"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ยอดพนักงาน</h5>
                        <div id="charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        console.log('start');
        const token = localStorage.getItem('authToken');
        const xArray = [];
        const yArray = [];
        const xArrays = [];
        const yArrays = [];

        fetch('http://localhost:8000/countPrisonersEach', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(employee => {
                    xArrays.push(employee.gender == 0 ? "ชาย" : "หญิง");
                    yArrays.push(employee.countPris);
                });

                const datasets = [{
                    x: xArrays,
                    y: yArrays,
                    type: "bar",
                    marker: {
                        color: "rgba(0,0,255,0.7)"
                    }
                }];

                const layout_ = {
                    title: "จำแนกตามเพศสภาพ",
                    xaxis: {
                        title: "เพศ"
                    },
                    yaxis: {
                        title: "จำนวน"
                    }
                };
                Plotly.newPlot("chart", datasets, layout_);
            })
            .catch(error => console.error('Error fetching prisoners:', error));


            const xArrays_ = [];
            const yArrays_ = [];


            fetch('http://localhost:8000/countPrisonersOtherEach', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(employee => {
                    xArrays_.push(employee.gender == 0 ? "ชาย" : "หญิง");
                    yArrays_.push(employee.countPris);
                });

                const datasets_ = [{
                    x: xArrays_,
                    y: yArrays_,
                    type: "bar",
                    marker: {
                        color: "rgba(0,150,255,0.7)"
                    }
                }];

                const layout__ = {
                    title: "จำแนกตามเพศสภาพ",
                    xaxis: {
                        title: "เพศ"
                    },
                    yaxis: {
                        title: "จำนวน"
                    }
                };
                Plotly.newPlot("chart_other", datasets_, layout__);
            })
            .catch(error => console.error('Error fetching prisoners:', error));

        fetch('http://localhost:8000/countDepartmentsEach', {
                method: "GET",
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(department => {
                    xArray.push(department.dep_name);
                    yArray.push(department.countDep);
                });

                const dataset = [{
                    x: xArray,
                    y: yArray,
                    type: "bar",
                    marker: {
                        color: "rgba(255,50,50,0.7)"
                    }
                }];

                const layout = {
                    title: "จำแนกตามแผนก",
                    xaxis: {
                        title: "แผนก"
                    },
                    yaxis: {
                        title: "จำนวน"
                    }
                };
                Plotly.newPlot("charts", dataset, layout);
            })
            .catch(error => console.error('Error fetching departments:', error));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
