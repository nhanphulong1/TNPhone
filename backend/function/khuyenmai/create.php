<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Nhúng file quản lý phần HEAD -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->
            <div class="col-md-8">
                <!-- content -->
                <div class="text-center">
                    <br>
                    <h1>THÊM CHƯƠNG TRÌNH KHUYẾN MÃI</h1>
                    <hr> <br>
                </div>
                <form name="frmThemMoiKM" action="" method="post">
                    <div class="form-group">
                        <label>Tên khuyến mãi:</label>
                        <input type="text" name="km_ten" class="form-control" placeholder="Nhập tên khuyến mãi">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Nội dung khuyến mãi:</label>
                        <textarea name="km_noidung" class="form-control" rows="5"></textarea>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Giảm giá: 0~70% </label><br>
                            <input type="text" name="km_discount" class="form-control" placeholder="Phần trăm khuyến mãi">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ngày bắt đầu:</label>
                            <input type="date" name="km_batdau" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ngày kết thúc</label>
                            <input type="date" name="km_ketthuc" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <button name="btnSave" class="btn btn-primary">Lưu khuyến mãi</button>
                        </div>
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </div>
                </form>
                <!-- endcontent -->
            </div>
        </div>
    </div>
    <br> <br> <br>
    <?php
    if (isset($_POST['btnSave'])) {
        $km_ten = $_POST['km_ten'];
        $km_noidung = $_POST['km_noidung'];
        $km_discount = $_POST['km_discount'] ? $_POST['km_discount'] : '0';
        $km_batdau = $_POST['km_batdau'];
        $km_ketthuc = $_POST['km_ketthuc'];

        // 1.Kết nối database
        include_once(__DIR__ . '/../../../dbconnect.php');

        // 2.Chuẩn bị câu truy vấn sql
        $insertKhuyenMai = <<<EOT
            INSERT INTO khuyenmai (km_ten, km_noidung, km_discount, km_batdau, km_ketthuc)
            VALUES ('$km_ten', '$km_noidung', $km_discount, '$km_batdau', '$km_ketthuc')
EOT;
        // 3.Thực thi câu lệnh
        $resultInserKhuyenMai = mysqli_query($conn, $insertKhuyenMai);
        echo '<script>location.href ="index.php";</script>';
    }
    ?>
    <br>
    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- endfooter -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
</body>

</html>