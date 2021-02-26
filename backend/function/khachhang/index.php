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
            <div class="col">
                <!-- content -->
                <div class="text-center">
                    <br>
                    <h1>DANH SÁCH KHÁCH HÀNG</h1>
                    <hr>
                    <br>
                </div>

                <?php
                // 1.Kết nối database
                include_once(__DIR__ . '/../../../dbconnect.php');

                // 2.Chuẩn bị câu truy vấn sql
                $stt = 1;
                $selectKhachHang = <<<EOT
                        SELECT *
                        FROM khachhang
EOT;

                // 3.Thực thi câu lệnh
                $resultSelectKhachHang = mysqli_query($conn, $selectKhachHang);

                // 4.Phân rã dữ liệu truy vấn
                $dsKhachHang = [];
                while ($rowKhachHang = mysqli_fetch_array($resultSelectKhachHang, MYSQLI_ASSOC)) {
                    $dsKhachHang[] = array(
                        'kh_hoten' => $rowKhachHang['kh_hoten'],
                        'kh_tendangnhap' => $rowKhachHang['kh_tendangnhap'],
                        'kh_diachi' => $rowKhachHang['kh_diachi'],
                        'kh_sdt' => $rowKhachHang['kh_sdt'],
                    );
                }
                ?>

                <!-- Thêm sản phẩm mới -->
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <table id="tblKhachHang" width="100%" class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>STT</th>
                        <th>Tên đăng nhập</th>
                        <th>Họ tên KH</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dsKhachHang as $kh) : ?>
                            <tr>
                                <td class="text-center">
                                    <a class="btn btn-danger" onclick="confirmDelete(<?= $kh['kh_tendangnhap']; ?>) ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td><?= $stt;
                                    $stt += 1; ?> </td>
                                <td><?= $kh['kh_tendangnhap']; ?></td>
                                <td><?= $kh['kh_hoten']; ?></td>
                                <td><?= $kh['kh_diachi']; ?></td>
                                <td><?= $kh['kh_sdt']; ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- end content -->
            </div>
        </div>
    </div>

    <!-- footer -->
    <br>
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- endfooter -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <script>
        $(document).ready(function() {
            $('#tblKhachHang').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });

        function confirmDelete(kh_tendangnhap) {
            var result = confirm("Xóa dòng này?");
            var url = 'delete.php?kh_tendangnhap=' + kh_tendangnhap;
            if (result == true) {

                location.href = url;
            }
        }
    </script>
</body>

</html>