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

    <?php
    // 1.Kết nối database
    include_once(__DIR__ . '/../../../dbconnect.php');

    // * Truy vấn dữ liệu nhà sản xuất * //

    // 2.Chuẩn bị câu truy vấn sql
    $selectNSX = <<<EOT
        SELECT * FROM nhasanxuat
EOT;

    // 3.Thực thi câu lệnh
    $resultSelectNSX = mysqli_query($conn, $selectNSX);

    // 4.Phân rã dữ liệu truy vấn
    $dsNSX = [];
    while ($rowNSX = mysqli_fetch_array($resultSelectNSX, MYSQLI_ASSOC)) {
        $dsNSX[] = array(
            'nsx_ma' => $rowNSX['nsx_ma'],
            'nsx_ten' => $rowNSX['nsx_ten']
        );
    }


    // * Truy vấn dữ liệu khuyến mãi * //

    // 2.Chuẩn bị câu truy vấn sql
    $selectKM = <<<EOT
        SELECT * FROM khuyenmai
EOT;

    // 3.Thực thi câu lệnh
    $resultSelectKM = mysqli_query($conn, $selectKM);

    // 4.Phân rã dữ liệu truy vấn
    $dsKM = [];
    while ($rowKM = mysqli_fetch_array($resultSelectKM, MYSQLI_ASSOC)) {
        $dsKM[] = array(
            'km_ma' => $rowKM['km_ma'],
            'km_ten' => $rowKM['km_ten'],
            'km_noidung' => $rowKM['km_noidung'],
            'km_batdau' => $rowKM['km_batdau'],
            'km_ketthuc' => $rowKM['km_ketthuc']
        );
    }
    ?>


    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->
            <div class="col-md-9">
                <!-- content -->
                <div class="text-center">
                    <h1>THÊM MỚI SẢN PHẨM</h1>
                    <hr>
                </div>
                <form name="frmThemMoiSP" action="" method="post">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label>Tên sản phẩm: </label>
                            <input type="text" name="sp_ten" id="sp_ten" class="form-control" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Giá sản phẩm: </label>
                            <input type="number" name="sp_gia" id="sp_gia" class="form-control" placeholder="Nhập giá sản phẩm">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Số lượng sản phẩm: </label>
                            <input type="number" name="sp_soluong" id="sp_soluong" class="form-control" placeholder="Nhập số lượng">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label>Nhà sản xuất: </label>
                            <select name="nsx_ma" id="nsx_ma" class="form-control">
                                <option value="">-- Chọn nhà sản xuất --</option>
                                <?php foreach ($dsNSX as $nsx) : ?>
                                    <option value="<?= $nsx['nsx_ma']; ?>"><?= $nsx['nsx_ten']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <label>Khuyến mãi: </label>
                            <select name="nsx_ma" id="nsx_ma" class="form-control">
                                <option value="">-- Không áp dụng khuyến mãi --</option>
                                <?php foreach ($dsKM as $km) : ?>
                                    <option value="<?= $km['km_ma']; ?>"><?= $km['km_ten']; ?> - <?= $km['km_noidung']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Hình ảnh:</label>
                                <img src="/TNPhone/shared/default-image.jpg" id="preview-img" width="200px" class="form-control">
                                <input type="file" name="sp_hinhdaidien" id="sp_hinhdaidien" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea name="sp_mota" id="sp_mota" class="form-control" rows="12" placeholder="Viết mô tả sản phẩm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <button name="btnSave" class="btn btn-primary">Lưu sản phẩm</button>
                        </div>
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-secondary">Nhập lại</button>
                        </div>
                    </div>
                    <br>
                </form>
                <!-- endcontent -->
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['btnSave'])){
            $sp_ten = $_POST['sp_ten'];
            $sp_gia = $_POST['sp_gia'];
            $sp_soluong = $_POST['sp_soluong'];
            $nsx_ma = $_POST['nsx_ma'];
            $km_ma = $_POST['km_ma'];
        }
    ?>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- endfooter -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
</body>

</html>