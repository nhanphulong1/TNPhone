<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

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

            <div class="col-md-9">
                <?php

                // 1. Kết nối đến csdl
                include_once(__DIR__ . '/../../../dbconnect.php');

                // --- Truy vấn dữ liệu sản phẩm --- //

                // 2. Chuẩn bị câu truy vấn sql
                $sqlSelectSP = <<<EOT
            SELECT * FROM sanpham
EOT;
                // 3. Thực thi câu lệnh truy vấn

                $resultSelectSP = mysqli_query($conn, $sqlSelectSP);
                $ds_sanpham = [];
                while ($rowSP = mysqli_fetch_array($resultSelectSP, MYSQLI_ASSOC)) {
                    $ds_sanpham[] = array(
                        'sp_ma' => $rowSP['sp_ma'],
                        'sp_ten' => $rowSP['sp_ten']
                    );
                }

                ?>

                <!-- content -->
                <br>
                <h1 class="text-center">DANH SÁCH HÌNH SẢN PHẨM</h1>
                <hr>
                <br>

                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <table id="tblHinhSP" name="tblHinhSP" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Mã SP</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Hình ảnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ds_sanpham as $sp) : ?>
                            <tr>
                                <td class="text-center"><?= $sp['sp_ma']; ?></td>
                                <td><?= $sp['sp_ten']; ?></td>
                                <?php
                                $ma = $sp['sp_ma'];
                                // --- Truy vấn dữ liệu sản phẩm --- //

                                // 2. Chuẩn bị câu truy vấn sql
                                $sqlSelectHSP = <<<EOT
                                    SELECT * FROM hinhsanpham WHERE sp_ma = $ma
EOT;
                                // 3. Thực thi câu lệnh truy vấn
                                $resultSelectHSP = mysqli_query($conn, $sqlSelectHSP);
                                $ds_hinhsanpham = [];
                                while ($rowHSP = mysqli_fetch_array($resultSelectHSP, MYSQLI_ASSOC)) {
                                    $ds_hinhsanpham[] = array(
                                        'hsp_ma' => $rowHSP['hsp_ma'],
                                        'hsp_tentaptin' => $rowHSP['hsp_tentaptin'],
                                        'sp_ma' => $rowHSP['sp_ma']
                                    );
                                }
                                ?>
                                <td class="text-center" width="40%">
                                    <?php foreach ($ds_hinhsanpham as $hsp) : ?>
                                        <div class="form-group">
                                            <img src="/TNPhone/assets/uploads/products/<?= $hsp['hsp_tentaptin']; ?>" width="200px">
                                            <a href="edit.php?hsp_ma=<?= $hsp['hsp_ma']; ?>" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger" onclick="confirmDelete(<?= $hsp['hsp_ma']; ?>) ">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- endcontent -->

            </div>

        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <script>
        $(document).ready(function() {
            $('#tblHinhSP').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });

        function confirmDelete(hsp_ma) {
            var result = confirm("Xóa dòng này?");
            var url = 'delete.php?hsp_ma=' + hsp_ma;
            if (result == true) {

                location.href = url;
            }
        }
    </script>
</body>

</html>