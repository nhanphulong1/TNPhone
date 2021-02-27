<?php session_start(); ?>
<?php if (isset($_SESSION['dangnhap']) && $_SESSION['dangnhap'] == true) : ?>
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
                        <h1>DANH SÁCH SẢN PHẨM</h1>
                        <hr>
                        <br>
                    </div>

                    <?php
                    // 1.Kết nối database
                    include_once(__DIR__ . '/../../../dbconnect.php');

                    // 2.Chuẩn bị câu truy vấn sql
                    $stt = 1;
                    $selectSanPham = <<<EOT
                        SELECT *
                        FROM sanpham AS sp
                        JOIN nhasanxuat AS nsx ON sp.nsx_ma = nsx.nsx_ma
                        LEFT JOIN khuyenmai AS km ON sp.km_ma = km.km_ma
EOT;

                    // 3.Thực thi câu lệnh
                    $resultSelectSanPham = mysqli_query($conn, $selectSanPham);

                    // 4.Phân rã dữ liệu truy vấn
                    $dsSanPham = [];
                    while ($rowSanPham = mysqli_fetch_array($resultSelectSanPham, MYSQLI_ASSOC)) {
                        $km_tomtat = '';
                        if (!empty($rowSanPham['km_ten'])) {
                            $km_tomtat = sprintf(
                                "Khuyến mãi %s, %s từ %s đến %s",
                                $rowSanPham['km_ten'],
                                $rowSanPham['km_noidung'],
                                date('d/m/Y', strtotime($rowSanPham['km_batdau'])),
                                date('d/m/Y', strtotime($rowSanPham['km_ketthuc']))
                            );
                        }

                        $dsSanPham[] = array(
                            'sp_ma' => $rowSanPham['sp_ma'],
                            'sp_ten' => $rowSanPham['sp_ten'],
                            'sp_gia' => $rowSanPham['sp_gia'],
                            'sp_giacu' => $rowSanPham['sp_giacu'],
                            'sp_ngaycapnhat' => $rowSanPham['sp_ngaycapnhat'],
                            'sp_soluong' => $rowSanPham['sp_soluong'],
                            'km_ma' => $rowSanPham['km_ma'],
                            'nsx_ten' => $rowSanPham['nsx_ten'],
                            'sp_hinhdaidien' => $rowSanPham['sp_hinhdaidien'],
                            'km_tomtat' => $km_tomtat
                        );
                    }
                    ?>

                    <!-- Thêm sản phẩm mới -->
                    <a href="create.php" class="btn btn-primary">Thêm mới</a>
                    <table id="tblSanPham" width="100%" class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>STT</th>
                            <th>Tên SP</th>
                            <th>Giá</th>
                            <th>Giá cũ</th>
                            <th>Ngày CN</th>
                            <th>Số lượng</th>
                            <th>NSX</th>
                            <th>Hình ảnh</th>
                            <th>Khuyến mãi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($dsSanPham as $sp) : ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="edit.php?sp_ma=<?= $sp['sp_ma'] ?>" class="btn btn-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger" onclick="confirmDelete(<?= $sp['sp_ma']; ?>) ">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td><?= $stt;
                                        $stt += 1; ?>
                                    </td>
                                    <td><?= $sp['sp_ten']; ?></td>
                                    <td class="text-right"><?= number_format($sp['sp_gia'], "0", ".", ","); ?></td>
                                    <td class="text-right"><?= number_format($sp['sp_giacu'], "0", ".", ","); ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($sp['sp_ngaycapnhat'])) ?></td>
                                    <td><?= $sp['sp_soluong']; ?></td>
                                    <td><?= $sp['nsx_ten']; ?></td>
                                    <td width="120px">
                                        <?php if (!$sp['sp_hinhdaidien']) : ?>
                                            <img src="/TNPhone/shared/default-image.jpg" width="100%">
                                        <?php else : ?>
                                            <img src="/TNPhone/assets/uploads/products/<?= $sp['sp_hinhdaidien']; ?>" width="100%">
                                        <?php endif; ?>
                                    </td>
                                    <td width="250px">
                                        <?php if (isset($sp['km_ma'])) : ?>
                                            <?= $sp['km_tomtat']; ?>
                                        <?php else : ?>
                                            <?= '<span>Không có khuyến mãi áp dụng</span>' ?>
                                        <?php endif; ?>
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
                $('#tblSanPham').DataTable({
                    dom: 'Blfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ]
                });
            });

            function confirmDelete(sp_ma) {
                var result = confirm("Xóa dòng này?");
                var url = 'delete.php?sp_ma=' + sp_ma;
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