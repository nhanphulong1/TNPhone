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
                <div class="col-md-8">
                    <!-- content -->
                    <div class="text-center">
                        <br>
                        <h1>THÊM MỚI SẢN PHẨM</h1>
                        <hr>
                        <br>
                    </div>
                    <form name="frmThemMoiSP" action="" method="POST" enctype="multipart/form-data">
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
                        <br>
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
                                <select name="km_ma" id="km_ma" class="form-control">
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
                                    <label>Hình ảnh đại diện:</label>
                                    <img src="/TNPhone/shared/default-image.jpg" id="preview-img" width="200px" class="form-control">
                                    <input type="file" name="sp_hinhdaidien" id="sp_hinhdaidien" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Mô tả sản phẩm</label>
                                    <textarea name="sp_mota" id="sp_mota" class="form-control" rows="10" placeholder="Viết mô tả sản phẩm"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 text-right">
                                <button name="btnSave" class="btn btn-primary">Lưu sản phẩm</button>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>
                        <br>
                    </form>
                    <!-- endcontent -->
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['btnSave'])) {
            $sp_ten = $_POST['sp_ten'];
            $sp_gia = $_POST['sp_gia'];
            $sp_soluong = $_POST['sp_soluong'];
            $nsx_ma = $_POST['nsx_ma'];
            $km_ma = (empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma']);
            $sp_mota = $_POST['sp_mota'];

            // Kiểm tra ràng buộc dữ liệu (Validation)
            // Tạo biến lỗi để chứa thông báo lỗi
            $errors = [];

            // Validate tên sản phẩm
            // Required
            if (empty($sp_ten)) {
                $errors['sp_ten'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $sp_ten,
                    'msg' => 'Vui lòng nhập tên sản phẩm'
                ];
            }

            // Minlength 5
            if (!empty($sp_ten) && strlen($sp_ten) < 5) {
                $errors['sp_ten'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 5,
                    'value' => $sp_ten,
                    'msg' => 'Tên sản phẩm phải có ít nhất 10 ký tự'
                ];
            }
            // Maxlength 255
            if (!empty($sp_ten) && strlen($sp_ten) > 255) {
                $errors['sp_ten'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 255,
                    'value' => $sp_ten,
                    'msg' => 'Tên sản phẩm không được vượt quá 255 ký tự'
                ];
            }

            // Validate giá sản phẩm
            // Required
            if (empty($sp_gia)) {
                $errors['sp_gia'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $sp_gia,
                    'msg' => 'Vui lòng nhập giá sản phẩm'
                ];
            }

            // Minvalue 1,000,000
            if (!empty($sp_gia) && $sp_gia < 1000000) {
                $errors['sp_gia'][] = [
                    'rule' => 'minvalue',
                    'rule_value' => 1000000,
                    'value' => $sp_gia,
                    'msg' => 'Giá sản phẩm không được nhỏ hơn 1 triệu'
                ];
            }
            // Maxvalue 1000000000
            if (!empty($sp_gia) && $sp_gia > 1000000000) {
                $errors['sp_gia'][] = [
                    'rule' => 'maxvalue',
                    'rule_value' => 1000000000,
                    'value' => $sp_gia,
                    'msg' => 'Giá sản phẩm không được lớn hơn 1 tỷ'
                ];
            }

            // Validate số lượng sản phẩm
            // Required
            if (empty($sp_soluong)) {
                $errors['sp_soluong'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $sp_soluong,
                    'msg' => 'Vui lòng nhập số lượng sản phẩm'
                ];
            }

            // Minvalue 1
            if (!empty($sp_soluong) && $sp_soluong < 1) {
                $errors['sp_soluong'][] = [
                    'rule' => 'minvalue',
                    'rule_value' => 1,
                    'value' => $sp_soluong,
                    'msg' => 'Số lượng sản phẩm không được nhỏ hơn 1'
                ];
            }
            // Maxvalue 1000
            if (!empty($sp_soluong) && $sp_soluong > 1000) {
                $errors['sp_soluong'][] = [
                    'rule' => 'maxvalue',
                    'rule_value' => 1000,
                    'value' => $sp_soluong,
                    'msg' => 'Số lượng sản phẩm không được lớn hơn 1000'
                ];
            }
            // Validate nhà sản xuất
            // Required
            if (empty($nsx_ma)) {
                $errors['nsx_ma'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $nsx_ma,
                    'msg' => 'Vui lòng chọn nhà sản xuất'
                ];
            }

            // Validate mô tả sản phẩm
            // Required
            if (empty($sp_mota)) {
                $errors['sp_mota'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $sp_mota,
                    'msg' => 'Vui lòng nhập mô tả sản phẩm'
                ];
            }

            // Minlength 10
            if (!empty($sp_mota) && strlen($sp_mota) < 10) {
                $errors['sp_mota'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 10,
                    'value' => $sp_mota,
                    'msg' => 'Mô tả sản phẩm phải có ít nhất 10 ký tự'
                ];
            }
            // Maxlength 255
            if (!empty($sp_mota) && strlen($sp_mota) > 5000) {
                $errors['sp_mota'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 5000,
                    'value' => $sp_mota,
                    'msg' => 'Mô tả sản phẩm không được vượt quá 5000 ký tự'
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

            $sp_hinhdaidien = $_FILES['sp_hinhdaidien']['name'];
            $tentaptin = date('YmdHis') . '_' . $sp_hinhdaidien;
            move_uploaded_file($_FILES['sp_hinhdaidien']['tmp_name'], $upload_dir . $subdir . $tentaptin);


            // 2.Chuẩn bị câu truy vấn sql
            $insertSanPham = <<<EOT
        INSERT INTO sanpham (sp_ten, sp_gia, sp_soluong, sp_mota, sp_hinhdaidien, nsx_ma, km_ma)
        VALUES ('$sp_ten', $sp_gia, $sp_soluong, '$sp_mota', '$tentaptin', $nsx_ma, $km_ma)
EOT;
            // 3.Thực thi câu lệnh
            $resultInsertSanPham = mysqli_query($conn, $insertSanPham);
            echo '<script>location.href ="index.php"; alert("Thêm thành công");</script>';
        }
        ?>

        <!-- footer -->
        <br>
        <br>
        <br>
        <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
        <!-- endfooter -->

        <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
        <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

        <!-- Phần script cho trang này -->
        <script>
            // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
            const reader = new FileReader();
            const fileInput = document.getElementById("sp_hinhdaidien");
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
<?php else : ?>
    <?php echo '<script>alert("Đăng nhập quyền quản trị để truy cập"); location.href ="/TNPhone/frontend/layouts/dangnhap.php";</script>' ?>
<?php endif; ?>