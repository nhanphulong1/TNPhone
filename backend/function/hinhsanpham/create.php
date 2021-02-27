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
                //
                include_once(__DIR__ . '/../../../dbconnect.php');
                //
                $sqlSelect = "SELECT * FROM sanpham";
                // 
                $resultSelect = mysqli_query($conn, $sqlSelect);
                $ds_sanpham = [];
                while ($row1 = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
                    $ds_sanpham[] = array(
                        'sp_ma' => $row1['sp_ma'],
                        'sp_ten' => $row1['sp_ten']
                    );
                }
                ?>

                <!-- content -->
                <br>
                <h1 class="text-center">THÊM HÌNH SẢN PHẨM</h1>
                <hr>
                <br>
                <form action="" method="post" name="frmHinhSanPham" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Sản phẩm</label> <br>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                            <option value="">-- Chọn sản phẩm --</option>
                            <?php foreach ($ds_sanpham as $sp) : ?>
                                <option value="<?= $sp['sp_ma']; ?>"><?= $sp['sp_ten']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <img src="/TNPhone/shared/default-image.jpg" id="preview-img" width="200px">
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
                    <br>
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

                    $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                    $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin;
                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);

                    if ($_FILES['hsp_tentaptin']['error'] > 0) {
                        echo 'File Upload Bị Lỗi';
                        die;
                    } else {
                        $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                        $tentaptin = date('Ymd') . '_' . $hsp_tentaptin;
                        move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                    }
                    $sqlInsert = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$tentaptin',$sp_ma)";
                    $resultInsert = mysqli_query($conn, $sqlInsert);
                    echo "<script>location.href = 'index.php';alert('Thêm thành công');</script>";
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