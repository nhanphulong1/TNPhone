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

            <div class="col-md-8">
                <?php
                // 1. Tạo kết nối đến csdl
                include_once(__DIR__ . '/../../../dbconnect.php');

                $hsp_ma = $_GET['hsp_ma'];
                // --- Truy vấn dữ liệu sản phẩm --- //

                // 2. Chuẩn bị câu lệnh truy vấn sql

                $sqlSelectSP = "SELECT * FROM sanpham";

                // 3. Thực thi câu lệnh
                $resultSelectSP = mysqli_query($conn, $sqlSelectSP);

                // 4. Phân rã dữ liệu
                $ds_sanpham = [];
                while ($rowSP = mysqli_fetch_array($resultSelectSP, MYSQLI_ASSOC)) {
                    $ds_sanpham[] = array(
                        'sp_ma' => $rowSP['sp_ma'],
                        'sp_ten' => $rowSP['sp_ten']
                    );
                }

                // --- Truy vấn dữ liệu hình sản phẩm --- //

                // 2. Chuẩn bị câu lệnh truy vấn sql
                $sqlSelectHSP = "SELECT * FROM hinhsanpham WHERE hsp_ma = $hsp_ma";

                // 3. Thực thi câu lệnh
                $resultSelectHSP = mysqli_query($conn, $sqlSelectHSP);

                // 4. Phân rã dữ liệu
                $rowHSP = mysqli_fetch_array($resultSelectHSP, MYSQLI_ASSOC);
                ?>

                <!-- content -->
                <br>
                <h1 class="text-center">SỬA HÌNH SẢN PHẨM</h1>
                <hr>
                <br>
                <form action="" method="post" name="frmHinhSanPham" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Sản phẩm</label> <br>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                            <option value="">-- Chọn sản phẩm --</option>
                            <?php foreach ($ds_sanpham as $sp) : ?>
                                <?php if ($rowHSP['sp_ma'] == $sp['sp_ma']) : ?>

                                    <option value="<?= $sp['sp_ma']; ?>" selected><?= $sp['sp_ten']; ?></option>

                                <?php else : ?>

                                    <option value="<?= $sp['sp_ma']; ?>"><?= $sp['sp_ten']; ?></option>

                                <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <img src="/TNPhone/assets/uploads/products/<?= $rowHSP['hsp_tentaptin']; ?>" id="preview-img" width="200px">
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label> <br>
                        <input type="file" name="hsp_tentaptin" id="hsp_tentaptin" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <button name="btnSave" class="btn btn-primary">Lưu hình</button>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-secondary">Hủy</a>
                        </div>
                    </div>
                    <br>
                </form>
                <!-- endcontent -->
                <?php
                if (isset($_POST['btnSave'])) {
                    $sp_ma = $_POST['sp_ma'];

                    $errors = [];
                    // Validate sản phẩm
                    // Require
                    if (empty($sp_ma)) {
                        $errors['sp_ma'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_ma,
                            'msg' => 'Vui lòng chọn sản phẩm'
                        ];
                    }
                }
                ?>

                <?php if (
                    isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                    && isset($errors)         // Nếu biến $errors có tồn tại
                    && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
                ) : ?>
                    <div id="errors-container" class="alert alert-danger face my-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            <?php foreach ($errors as $fields) : ?>
                                <?php foreach ($fields as $field) : ?>
                                    <li><?php echo $field['msg']; ?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php
                if (
                    isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                    && (!isset($errors) || (empty($errors))) // Nếu biến $errors không tồn tại Hoặc giá trị của biến $errors rỗng
                ) {

                    $upload_dir = __DIR__ . '/../../../assets/uploads/';
                    $subdir = 'products/';

                    if (empty($_FILES['hsp_tentaptin']['name'])) {

                        // 2.Chuẩn bị câu truy vấn sql
                        $updateHinhSanPham = <<<EOT
                            UPDATE hinhsanpham
                            SET
                                sp_ma = $sp_ma
                            WHERE hsp_ma = $hsp_ma
EOT;
                        // 3.Thực thi câu lệnh
                        $resultUpdateHinhSanPham = mysqli_query($conn, $updateHinhSanPham);
                        echo '<script>location.href ="index.php"; alert("Sửa thành công");</script>';
                    } else {

                        $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                        $tentaptin = date('Ymd') . '_' . $hsp_tentaptin;
                        move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);

                        $old_file = $upload_dir . $subdir . $rowHSP['hsp_tentaptin'];
                        if (file_exists($old_file)) {
                            // Hàm unlink(filepath) dùng để xóa file trong PHP
                            unlink($old_file);
                        }

                        // 2.Chuẩn bị câu truy vấn sql
                        $updateHinhSanPham = <<<EOT
                            UPDATE hinhsanpham
                            SET
                                hsp_tentaptin = '$tentaptin',
                                sp_ma = $sp_ma
                            WHERE hsp_ma = $hsp_ma
EOT;

                        // 3.Thực thi câu lệnh
                        $resultUpdateHinhSanPham = mysqli_query($conn, $updateHinhSanPham);
                        echo '<script>alert("Sửa thành công");location.href ="index.php"; </script>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <script>
        // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("hsp_tentaptin");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
</body>

</html>