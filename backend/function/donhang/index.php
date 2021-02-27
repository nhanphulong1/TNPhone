<?php session_start(); ?>
<?php if (isset($_SESSION['dangnhap']) && $_SESSION['dangnhap'] == true) : ?>
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

                <div class="col">

                    <!-- content -->
                    <div class="text-center">
                        <br>
                        <h1>DANH SÁCH ĐƠN HÀNG</h1>
                        <hr>
                        <br>
                    </div>

                    <?php
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');

                    // 2. Chuẩn bị câu truy vấn $sql
                    $stt = 1;
                    $sql =  <<<EOT
                    SELECT 
                        dh.dh_ma, dh.dh_ngaylap, dh.dh_trangthai, dh.dh_noigiao,
                        httt.httt_ten,
                        kh.kh_hoten,
                        SUM(ctdh.ctdh_soluong * ctdh.ctdh_gia) AS TongThanhTien
                    FROM donhang dh
                    JOIN chitietdathang ctdh ON dh.dh_ma = ctdh.dh_ma
                    JOIN khachhang kh ON dh.kh_tendangnhap = kh.kh_tendangnhap
                    JOIN hinhthucthanhtoan httt ON dh.httt_ma = httt.httt_ma
                    GROUP BY dh.dh_ma
EOT;

                    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                    $result = mysqli_query($conn, $sql);


                    $ds_donhang = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $ds_donhang[] = array(
                            'dh_ma' => $row['dh_ma'],
                            'dh_ngaylap' => date('d/m/Y H:i:s', strtotime($row['dh_ngaylap'])),
                            'dh_noigiao' => $row['dh_noigiao'],
                            'dh_trangthai' => $row['dh_trangthai'],
                            'httt_ten' => $row['httt_ten'],
                            'kh_hoten' => $row['kh_hoten'],
                            'TongThanhTien' => number_format($row['TongThanhTien'], "0", ".", ",") . ' VND'
                        );
                    }
                    ?>
                    <a href="create.php" class="btn btn-primary">Thêm mới</a>

                    <table id="tblDonHang" width="100%" class="table table-bodered">
                        <thead>
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Tên KH</th>
                                <th>Ngày lập</th>
                                <th>Nơi giao</th>
                                <th>Hình thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Tổng thành tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($ds_donhang as $dh) : ?>
                                <tr>
                                    <td> <?= $dh['dh_ma']; ?> </td>
                                    <td> <?= $dh['kh_hoten']; ?> </td>
                                    <td> <?= $dh['dh_ngaylap']; ?> </td>
                                    <td> <?= $dh['dh_noigiao']; ?> </td>
                                    <td> <span class="badge badge-primary"><?= $dh['httt_ten']; ?></span> </td>
                                    <td>
                                        <?php if ($dh['dh_trangthai'] == 0) : ?>
                                            <span class="badge badge-danger">Chưa thanh toán</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: right;"> <?= $dh['TongThanhTien']; ?> </td>
                                    <td>
                                        <a class="btn btn-primary" href="print.php?dh_ma=<?= $dh['dh_ma']; ?>"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-danger" onclick="confirmDelete(<?= $dh['dh_ma']; ?>)"><i class="fa fa-trash"></i></a>
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
        <!-- end footer -->

        <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
        <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

        <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
        <script>
            $(document).ready(function() {
                $('#tblDonHang').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ]
                });
            });

            function confirmDelete(dh_ma) {
                var result = confirm("Xóa dòng này?");
                var url = 'delete.php?dh_ma=' + dh_ma;
                if (result == true) {

                    location.href = url;
                }
            }
        </script>

    </body>

    </html>
<?php else : ?>
    <?php echo '<script>alert("Đăng nhập quyền quản trị để truy cập"); location.href ="/TNPhone/frontend/layouts/dangnhap.php";</script>' ?>
<?php endif; ?>