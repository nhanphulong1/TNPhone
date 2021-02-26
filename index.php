<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once(__DIR__.'/frontend/config.php');
        include_once(__DIR__.'/frontend/head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="/TNPhone/assets/frontend/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="/TNPhone/assets/frontend/css/index.css">
</head>
<body>
    <?php 
        $nsx='';
        if(isset($_GET['nsx']))
            $nsx=$_GET['nsx'];
        
        // Kết nối csdl.
        include_once(__DIR__.'/dbconnect.php');
        //câu lệnh select
        $sql= <<<EOT
        SELECT sp.sp_ma, sp_ten, sp_gia,hsp_tentaptin
            FROM sanpham sp left JOIN hinhsanpham hsp
            ON sp.sp_ma = hsp.sp_ma
            WHERE sp_ten LIKE '%%'
            GROUP BY sp.sp_ma
            ORDER BY sp.sp_ngaycapnhat desc
            LIMIT 5
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


        $sqlSanPhamNhieu= <<<EOT
        SELECT sp.sp_ma, sp_ten, sp_gia,hsp_tentaptin,sp_ngaycapnhat,ifnull(SUM(ct.ctdh_soluong),0) soluongdaban
            FROM sanpham sp left JOIN hinhsanpham hsp
            ON sp.sp_ma = hsp.sp_ma
            left JOIN chitietdathang ct ON ct.sp_ma = sp.sp_ma
            WHERE sp_ten LIKE '%%'
            GROUP BY sp.sp_ma
            ORDER BY soluongdaban desc
            LIMIT 5
EOT;
        // Câu lệnh thực thi
        $result_SPNhieu = mysqli_query($conn,$sqlSanPhamNhieu);
        $ds_sanphamnhieu=[];
        while($row = mysqli_fetch_array($result_SPNhieu,MYSQLI_ASSOC)){
            $ds_sanphamnhieu[] = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => $row['sp_gia'],
                'hsp_tentaptin' => $row['hsp_tentaptin']
            );
        }
    ?>



    <!-- Header -->
    <?php include_once(__DIR__.'/frontend/partials/header.php') ?>

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
                    <img src="./shared/anh-nen-1.png" class="d-block w-100" alt="abc">
                    </div>
                    <div class="carousel-item">
                    <img src="./shared/anh-nen-2.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="./shared/anh-nen-2.png" class="d-block w-100" alt="...">
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
            <!-- Hiển thị sản phẩm mới nhất -->
            <div class="col-md-12" id="contain">
                <h4 class="tieudesp">Các Sản Phẩm Nổi Bật</h4>
                <div>
                    <?php if(!empty($ds_sanpham)): ?>
                    <?php foreach($ds_sanpham as $sp):?>
                    <div class="card" style="width: 20%; display: inline-block;">
                        <a href="/TNPhone/frontend/layouts/chitietsp.php?sp_ma=<?=$sp['sp_ma'] ?>"><img src="<?= (!$sp['hsp_tentaptin']) ? '/TNPhone/assets/uploads/products/default-image.jpg':'/TNPhone/assets/uploads/products/'.$sp['hsp_tentaptin'] ?>" class="card-img-top"></a>
                        <div class="card-body">
                            <a href="/TNPhone/frontend/layouts/chitietsp.php?sp_ma=<?=$sp['sp_ma'] ?>">
                                <h5 class="card-title"><?= $sp['sp_ten']?></h5>
                                <p class="card-text"><?= number_format($sp['sp_gia'],0,".",",")." VNĐ"?></p>
                            </a>
                            <a href="/TNPhone/frontend/layouts/chitietsp.php?sp_ma=<?=$sp['sp_ma'] ?>" class="btn btn-warning">Mua hàng</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <div id="tb_khong"><p>Không có sản phẩm này.</p></div>
                    <?php endif; ?>
                </div>
                <!-- Cách dòng -->
                <hr id="space">
                <!-- Các sản phẩm bán nhiều nhất -->
                <h4 class="tieudesp">Các Sản Phẩm Bán Chạy</h4>
                <div>
                    <?php if(!empty($ds_sanphamnhieu)): ?>
                    <?php foreach($ds_sanphamnhieu as $sp):?>
                    <div class="card" style="width: 20%; display: inline-block;">
                        <a href="/TNPhone/frontend/layouts/chitietsp.php?sp_ma=<?=$sp['sp_ma'] ?>"><img src="<?= (!$sp['hsp_tentaptin']) ? '/TNPhone/assets/uploads/products/default-image.jpg':'/TNPhone/assets/uploads/products/'.$sp['hsp_tentaptin'] ?>" class="card-img-top"></a>
                        <div class="card-body">
                            <a href="/TNPhone/frontend/layouts/chitietsp.php?sp_ma=<?=$sp['sp_ma'] ?>">
                                <h5 class="card-title"><?= $sp['sp_ten']?></h5>
                                <p class="card-text"><?= number_format($sp['sp_gia'],0,".",",")." VNĐ"?></p>
                            </a>
                            <a href="/TNPhone/frontend/layouts/chitietsp.php?sp_ma=<?=$sp['sp_ma'] ?>" class="btn btn-warning">Mua hàng</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <div id="tb_khong"><p>Không có sản phẩm này.</p></div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>
    <!-- Footer -->
    <?php include_once(__DIR__.'/frontend/partials/footer.php') ?>
    <!-- Scripts -->
    <?php include_once(__DIR__.'/frontend/scripts.php') ?>
</body>
</html>