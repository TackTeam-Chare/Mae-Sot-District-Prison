<!DOCTYPE html>
<html>

<head>
    <title>เรือนจำอำเภอแม่สอด</title>
    <link rel="icon" type="image/x-icon" href="img/spd_20150704164759_b.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        /* Hover effect for links */
        a {
            color: aliceblue;
            transition: color 0.3s;
        }

        a:hover {
            color: #ffc107;
            /* Change to the color you prefer on hover */
            text-decoration: none;
            /* Optional: Remove underline on hover */
        }

        .unique-animation-container {
            background-color: rgb(175, 61, 61);
            height: 90px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .unique-animation-article {
            display: flex;
            animation: alternateScroll 20s linear infinite;
            align-items: center;
        }

        .unique-animation-article a {
            margin: 0 10px;
        }

        .unique-animation-article img {
            max-height: 80px;
            transition: transform 0.3s;
        }

        .unique-animation-article img:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .unique-animation-container {
                height: auto;
                padding: 10px 0;
            }

            .unique-animation-article img {
                max-height: 50px;
                margin: 0 5px;
            }
        }

        @keyframes alternateScroll {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(calc(-50%));
            }

            50% {
                transform: translateX(calc(-100%));
            }

            75% {
                transform: translateX(calc(-50%));
            }

            100% {
                transform: translateX(0);
            }
        }

        .link-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .link-buttons a {
            text-decoration: none;
            color: white;
        }

        .link-buttons .btn {
            border: 1px solid white;
            background-color: transparent;
        }

        .link-buttons .btn:hover {
            background-color: white;
            color: red;
        }

        .img-thumbnail {
            cursor: pointer;
            transition: transform 0.3s, border-color 0.3s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            border-color: #ffc107;
        }
    </style>
</head>

<body>
    <?php include('./layout/navbar.php'); ?>
    <div class="container pt-4">
        <div id="carouselExampleControls" class="carousel slide rounded-15 z-depth-1 aos-init aos-animate"
            data-ride="carousel" data-aos="zoom-out" data-aos-once="true">
            <div class="carousel-inner carousel-molyze rounded-15" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="img/เรือนจำแม่สอด2.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <a href="http://www.correct.go.th/correct-koknongna/KokNongNa-Correct.html#p=cover">
                        <img class="d-block img-fluid" src="img/slideR23.jpg" alt="Second   slide">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="http://www.correct.go.th/?p=93152">
                        <img class="d-block img-fluid" src="img/covid.png" alt="Third slide">
                    </a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <main class="min-vh-100">
        <div class="container py-3 py-md-5" style="min-height:80vh;">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 align-self-start">
                        <div id="director" class="mb-5 md-mb-0">
                            <div class="mt-2 aos-init aos-animate" data-aos="flip-down">
                                <h2 class="mb-0">
                                    <span class="float-left">
                                        <i class="fas fa-star fa-sm fa-fw"></i>
                                        <span style="color: aliceblue;">ผู้บัญชาการ</span>
                                    </span>
                                </h2>
                                <br>
                                <hr class="bg-white my-4" style="height: 3px;">
                            </div>
                            <div class="row justify-content-center aos-init aos-animate" data-aos="fade-up">
                                <div class="col-12 col-md-12 text-center">
                                    <img src="img/boss.jpg"
                                        style="max-height: 200px; max-width:240px;" class="img-fluid  mx-auto" onclick="showImageModal(this.src)">
                                </div>
                                <div class="col-12 col-md-12 text-center mt-4 mt-md-4">
                                    <p class="font-weight-bold mb-0" style="font-size:110%;">
                                        <span style="color: aliceblue;">นายศุภชัย ศรีกอง</span>
                                    </p>
                                    <p class="text-muted">
                                        <span style="color: aliceblue;">ผู้บัญชาการเรือนจำอำเภอแม่สอด</span>
                                    <aside id="text-9" class="widget widget_text clearfix">
                                        <br>
                                        <h4>
                                            <span style="color: aliceblue;">เรือนจำชั่วคราวห้วยหินฝน</span>
                                        </h4>
                                        <br>
                                        <a href="https://www.facebook.com/%E0%B9%80%E0%B8%A3%E0%B8%B7%E0%B8%AD%E0%B8%99%E0%B8%88%E0%B8%B3%E0%B8%8A%E0%B8%B1%E0%B9%88%E0%B8%A7%E0%B8%84%E0%B8%A3%E0%B8%B2%E0%B8%A7%E0%B8%AB%E0%B9%89%E0%B8%A7%E0%B8%A2%E0%B8%AB%E0%B8%B4%E0%B8%99%E0%B8%9D%E0%B8%99-138969522037726/">
                                            <img src="img/เรือนจำห้วย.jpg" height="150" width="255" class="img-fluid ">
                                        </a>
                                        <br>
                                        <br>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-9">
                        <div>
                            <img class="d-block img-fluid " src="img/slide8.jpg" onclick="showImageModal(this.src)">
                        </div>
                        <div id="news">
                            <div class="mt-2 aos-init aos-animate" data-aos="flip-down">
                                <h2 class="mb-0">
                                    <span class="float-left">
                                        <i class="fas fa-thumbtack fa-sm fa-fw"></i>
                                        <span style="color: aliceblue;">ข่าวกิจกรรม</span>
                                    </span>
                                    <span class="float-right d-none d-md-inline-block">
                                        <a href="press_release.php" class="btn btn-sm btn-outline-info" data-pjax=""
                                            data-pjax-state="">
                                            <span style="color: aliceblue;">อ่านเพิ่มเติม »
                                        </a>
                                    </span>
                                </h2>
                                <br>
                                <hr class="bg-white my-4" style="height: 3px;">
                            </div>
                            <div class="col-12 col-md-8 col-lg-9 order-md-1">
                                <div class="mb-4">
                                    <h2 class="h2" style="color: white; font-weight: bold;">
                                        ยินดีต้อนรับสู่เว็บไซต์เรือนจำอำเภอแม่สอด</h2>
                                    <p style="color: white;">ยินดีต้อนรับสู่เว็บไซต์ของเรือนจำอำเภอแม่สอด
                                        ท่านสามารถเรียนรู้ข้อมูลเพิ่มเติมได้จากเว็บไซต์นี้</p>
                                </div>
                               <?php include_once('./layout/event_news.php') ?>
                            </div>

                        </div>

                    </div>
                </div>
                <?php include_once('./layout/prisoners.php')?>
    </main>

    <article>
        <h1 class="top">
            <span style="color: aliceblue;">เว็บไซต์ที่เกี่ยวข้อง</span>
        </h1>
        <p style="color: aliceblue;">เว็บไซต์นี้จัดทำขึ้นเพื่อให้ข้อมูลและข่าวสารเกี่ยวกับเรือนจำอำเภอแม่สอด
            และเพื่ออำนวยความสะดวกให้กับประชาชนที่สนใจและมีความประสงค์ที่จะติดต่อกับเรือนจำอำเภอแม่สอด</p>
        <p style="color: aliceblue;">เรือนจำอำเภอแม่สอดเป็นหน่วยงานในสังกัดกรมราชทัณฑ์ กระทรวงยุติธรรม
            ที่มีภารกิจหลักในการดูแลควบคุมผู้ต้องขัง และฟื้นฟูสมรรถภาพทางร่างกายและจิตใจของผู้ต้องขังให้สามารถกลับเข้าสู่สังคมได้อย่างมีคุณภาพ</p>
        <hr style="height: 5px;" color="aliceblue">
    </article>
    <div class="link-buttons">
        <a href="https://www.moj.go.th/" class="btn btn-outline-light">กระทรวงยุติธรรม</a>
        <a href="http://www.correct.go.th/" class="btn btn-outline-light">กรมราชทัณฑ์</a>
        <a href="http://www.led.go.th/" class="btn btn-outline-light">กรมบังคับคดี</a>
        <a href="https://www.probation.go.th/" class="btn btn-outline-light">กรมคุมประพฤติ</a>
        <a href="https://www.rlpd.go.th/" class="btn btn-outline-light">กรมคุ้มครองสิทธิและเสรีภาพ</a>
        <a href="http://www.djop.go.th/home" class="btn btn-outline-light">กรมพิพิจและคุ้มครองเด็ก</a>
        <a href="https://www.oja.go.th/TH/" class="btn btn-outline-light">สำนักงานกิจการยุติธรรม</a>
        <a href="http://web.tak.go.th/" class="btn btn-outline-light">จังหวัดตาก</a>
        <a href="https://mesc.coj.go.th/th/page/item/index/id/1" class="btn btn-outline-light">ศาลจังหวัดแม่สอด</a>
        <a href="http://www.tak.ago.go.th/maesod-lawaid/index.php/2018-06-04-09-25-41" class="btn btn-outline-light">สำนักงานอัยการจังหวัดตาก(สาขาแม่สอด)</a>
        <a href="http://maesot.tak.police.go.th/" class="btn btn-outline-light">ตำรวจภูธรอำเภอแม่สอด</a>
        <a href="https://www.dsd.go.th/Tak" class="btn btn-outline-light">ศูนย์พัฒนาฝีมือแรงงาน จ.ตาก</a>
        <a href="https://www.maepalocal.go.th/home" class="btn btn-outline-light">องค์การบริหารส่วนอำเภอแม่สอด</a>
        <a href="https://www.nakhonmaesotcity.go.th/web/" class="btn btn-outline-light">เทศบาลนครแม่สอด</a>
    </div>

    <div class="unique-animation-container">
        <?php include('./layout/animation.php'); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('./layout/footer.php'); ?>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid" alt="Selected Image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImageModal(src) {
            document.getElementById('modalImage').src = src;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
</body>

</html>
