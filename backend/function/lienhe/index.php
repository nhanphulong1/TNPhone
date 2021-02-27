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
                    <h1>DANH LIÊN HỆ</h1>
                    <hr>
                    <br>
                </div>

                <?php
                // 1.Kết nối database
                include_once(__DIR__ . '/../../../dbconnect.php');

                // 2.Chuẩn bị câu truy vấn sql
                $stt = 1;
                $selectLienHe = <<<EOT
                        SELECT *
                        FROM lienhe
EOT;
                // 3.Thực thi câu lệnh
                $resultSelectLienHe = mysqli_query($conn, $selectLienHe);

                // 4.Phân rã dữ liệu truy vấn
                $danhsachLH = [];
                while ($rowLH = mysqli_fetch_array($resultSelectLienHe, MYSQLI_ASSOC)) {
                    $danhsachLH[] = array(
                        'lh_ma' => $rowLH['lh_ma'],
                        'lh_tieude' => $rowLH['lh_tieude'],
                        'lh_email' => $rowLH['lh_email'],
                        'lh_noidung' => $rowLH['lh_noidung']
                    );
                }
                ?>

                <table id="tblLienHe" width="100%" class="table table-bordered">
                    <thead>
                        <th class="text-center">STT</th>
                        <th>Tiêu đề</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        <?php foreach ($danhsachLH as $lh) : ?>
                            <tr>
                                <td class="text-center"><?= $stt;
                                                        $stt += 1; ?>
                                </td>
                                <td><?= $lh['lh_tieude']; ?></td>
                                <td><?= $lh['lh_email']; ?></td>
                                <td> <?= $lh['lh_noidung']; ?> </td>
                                <td class="text-center">
                                    <a class="btn btn-danger" onclick="confirmDelete(<?= $lh['lh_ma']; ?>) ">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
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
            $('#tblLienHe').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });

        function confirmDelete(lh_ma) {
            var result = confirm("Xóa dòng này?");
            var url = 'delete.php?lh_ma=' + lh_ma;
            if (result == true) {

                location.href = url;
            }
        }
    </script>
</body>

</html>