<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once(__DIR__.'/config.php');
        include_once(__DIR__.'/head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../../assets/frontend/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../../assets/frontend/css/index.css">
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/partials/header.php') ?>

    <div class="container">
        <!-- /* Ảnh quảng cáo */ -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="../../shared/anh-nen-1.png" class="d-block w-100" alt="abc">
                    </div>
                    <div class="carousel-item">
                    <img src="../../shared/anh-nen-2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="../../shared/anh-nen-2.png" class="d-block w-100" alt="...">
                    </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row">
            <!-- Thanh menu đứng -->
            <div class="col-md-3" id="sidebar">
                <?php include_once(__DIR__.'/partials/sidebar.php') ?>
            </div>
            <!-- Hiển thị sản phẩm -->
            <div class="col-md-9" id="contain">
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/scripts.php') ?>
</body>
</html>