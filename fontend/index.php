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
    <?php 
        $nsx='';
        if(isset($_GET['nsx']))
            $nsx=$_GET['nsx'];
        // Kết nối csdl.
        include_once(__DIR__.'/../dbconnect.php');
        //câu lệnh select
        $sql= <<<EOT
        SELECT *
        FROM sanpham sp left JOIN hinhsanpham hsp
        ON sp.sp_ma = hsp.sp_ma
        JOIN nhasanxuat nsx ON sp.nsx_ma=nsx.nsx_ma
        WHERE nsx_ten LIKE '%$nsx%'
        GROUP BY sp.sp_ma
EOT;
        // Câu lệnh thực thi
        $result = mysqli_query($conn,$sql);
        $ds_sanpham=[];
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $ds_sanpham[] = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => $row['sp_gia'],
                'hsp_tentaptin' => $row['hsp_tentaptin']
            );
        }
    ?>



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
                <?php foreach($ds_sanpham as $sp):?>
                <div class="card" style="width: 8rem; display: inline-block;">
                    <img src="../../shared/<?= ($sp['hsp_tentaptin']=="") ? 'default-image.jpg':$sp['hsp_tentaptin'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $sp['sp_ten']?></h5>
                        <p class="card-text"><?= number_format($sp['sp_gia'],0,".",",")." VNĐ"?></p>
                        <a href="#" class="btn btn-warning">Mua hàng</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include_once(__DIR__.'/partials/footer.php') ?>
    <!-- Scripts -->
    <?php include_once(__DIR__.'/scripts.php') ?>
</body>
</html>