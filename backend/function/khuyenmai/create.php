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
                            <input type="number" name="km_discount" class="form-control" placeholder="Phần trăm khuyến mãi">
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

        // Kiểm tra ràng buộc dữ liệu (Validation)
        // Tạo biến lỗi để chứa thông báo lỗi
        $errors = [];

        // Validate khuyen mai
        // Required
        if (empty($km_ten)) {
            $errors['km_ten'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $km_ten,
                'msg' => 'Vui lòng nhập tên khuyến mãi'
            ];
        }

        // Minlength 10
        if (!empty($km_ten) && strlen($km_ten) < 10) {
            $errors['km_ten'][] = [
                'rule' => 'minlength',
                'rule_value' => 10,
                'value' => $km_ten,
                'msg' => 'Tên khuyến mãi phải có ít nhất 10 ký tự'
            ];
        }
        // Maxlength 255
        if (!empty($km_ten) && strlen($km_ten) > 255) {
            $errors['km_ten'][] = [
                'rule' => 'maxlength',
                'rule_value' => 255,
                'value' => $km_ten,
                'msg' => 'Tên Loại sản phẩm không được vượt quá 255 ký tự'
            ];
        }

        // Validate nội dung khuyến mãi
        // Required
        if (empty($km_noidung)) {
            $errors['km_noidung'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $km_noidung,
                'msg' => 'Vui lòng nhập nội dung khuyến mãi'
            ];
        }

        // Minlength 10
        if (!empty($km_noidung) && strlen($km_noidung) < 10) {
            $errors['km_noidung'][] = [
                'rule' => 'minlength',
                'rule_value' => 10,
                'value' => $lsp_mota,
                'msg' => 'Nội dung khuyến mãi phải có ít nhất 10 ký tự'
            ];
        }

        // Maxlength 1000
        if (!empty($km_noidung) && strlen($km_noidung) > 1000) {
            $errors['km_noidung'][] = [
                'rule' => 'maxlength',
                'rule_value' => 1000,
                'value' => $km_noidung,
                'msg' => 'Nội dung khuyến mãi không được vượt quá 1000 ký tự'
            ];
        }

        // Validate phần trăm khuyến mãi
        // Maxlength 2
        if (!empty($km_discount) && strlen($km_discount) > 2) {
            $errors['km_discount'][] = [
                'rule' => 'maxlength',
                'rule_value' => 2,
                'value' => $km_discount,
                'msg' => 'Phần trăm khuyến mãi không được quá 70%'
            ];
        }

        // Maxvalue 70
        if (!empty($km_discount) && $km_discount > 70) {
            $errors['km_discount'][] = [
                'rule' => 'maxvalue',
                'rule_value' => 70,
                'value' => $km_discount,
                'msg' => 'Phần trăm khuyến mãi không được quá 70%'
            ];
        }

        // Validate ngày bắt đầu và ngày kết thúc
        // Require
        if (empty($km_batdau)) {
            $errors['km_batdau'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $km_batdau,
                'msg' => 'Vui lòng chọn ngày bắt đầu khuyến mãi'
            ];
        }

        // Validate ngày kết thúc
        if (empty($km_ketthuc)) {
            $errors['km_ketthuc'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $km_ketthuc,
                'msg' => 'Vui lòng chọn ngày kết thúc khuyến mãi'
            ];
        }

        if (!empty($km_ketthuc) && !empty($km_batdau)  && $km_ketthuc < $km_batdau){
            $errors['km_ketthuc'][] = [
                'rule' => 'sosanh',
                'rule_value' => true,
                'value' => $km_ketthuc,
                'msg' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu'
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