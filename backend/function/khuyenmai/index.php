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
                    <h1>DANH SÁCH KHUYẾN MÃI</h1>
                    <hr>
                    <br>
                </div>

                <?php
                // 1.Kết nối database
                include_once(__DIR__ . '/../../../dbconnect.php');

                // 2.Chuẩn bị câu truy vấn sql
                $stt = 1;
                $selectKhuyenMai = <<<EOT
                        SELECT *
                        FROM khuyenmai
EOT;
                // 3.Thực thi câu lệnh
                $resultSelectKhuyenMai = mysqli_query($conn, $selectKhuyenMai);

                // 4.Phân rã dữ liệu truy vấn
                $dsKhuyenMai = [];
                while ($rowKhuyenMai = mysqli_fetch_array($resultSelectKhuyenMai, MYSQLI_ASSOC)) {
                    $dsKhuyenMai[] = array(

                        'km_ma' => $rowKhuyenMai['km_ma'],
                        'km_ten' => $rowKhuyenMai['km_ten'],
                        'km_noidung' => $rowKhuyenMai['km_noidung'],
                        'km_discount' => $rowKhuyenMai['km_discount'],
                        'km_batdau' => $rowKhuyenMai['km_batdau'],
                        'km_ketthuc' => $rowKhuyenMai['km_ketthuc']
                    );
                }
                ?>
                <!-- Thêm sản phẩm mới -->
                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <table id="tblKhuyenMai" width="100%" class="table table-bordered">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">STT</th>
                        <th>Tên KM</th>
                        <th>Nội dung</th>
                        <th>Giảm</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dsKhuyenMai as $km) : ?>
                            <tr>
                                <td class="text-center">
                                    <a href="edit.php?km_ma=<?= $km['km_ma']; ?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="confirmDelete(<?= $km['km_ma']; ?>) ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td class="text-center"><?= $stt;
                                                        $stt += 1; ?>
                                </td>
                                <td><?= $km['km_ten']; ?></td>
                                <td> <?= $km['km_noidung']; ?> </td>
                                <td> <?= $km['km_discount']; ?> %</td>
                                <td><?= date('d/m/Y', strtotime($km['km_batdau'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($km['km_ketthuc'])) ?></td>

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
            $('#tblKhuyenMai').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });

        function confirmDelete(km_ma) {
            var result = confirm("Xóa dòng này?");
            var url = 'delete.php?km_ma=' + km_ma;
            if (result == true) {

                location.href = url;
            }
        }
    </script>
</body>

</html>