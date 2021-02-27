<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <!-- Nhúng phần file head.php -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>

</head>

<body>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->

            <!-- Content -->
            <div class="col-md-8">
                <?php
                // 1. Tạo kết nối đến csdl
                include_once(__DIR__ . '/../../../dbconnect.php');

                // --- Truy vấn dữ liệu khách hàng --- //

                // 2. Chuẩn bị câu lệnh sql
                $sqlSelectKH = <<<EOT
                    SELECT * FROM khachhang
EOT;
                // 3. Thực thi câu lệnh
                $resultSelectKH = mysqli_query($conn, $sqlSelectKH);

                // 4. Phân rã dữ liệu
                $danhsachKH = [];
                while ($rowKH = mysqli_fetch_array($resultSelectKH, MYSQLI_ASSOC)) {
                    $danhsachKH[] = array(
                        'kh_tendangnhap' => $rowKH['kh_tendangnhap'],
                        'kh_hoten' => $rowKH['kh_hoten'],
                        'kh_sdt' => $rowKH['kh_sdt'],
                        'kh_diachi' => $rowKH['kh_diachi']
                    );
                }


                // --- Truy vấn dữ liệu hình thức thanh toán --- ///

                // 2. Chuẩn bị câu lệnh sql
                $sqlSelectHTTT = <<<EOT
                    SELECT * FROM hinhthucthanhtoan
EOT;

                // 3. Thực thi câu lệnh
                $resultSelectHTTT = mysqli_query($conn, $sqlSelectHTTT);

                // 4. Phân rã dữ liệu
                $danhsachHTTT = [];
                while ($rowHTTT = mysqli_fetch_array($resultSelectHTTT, MYSQLI_ASSOC)) {
                    $danhsachHTTT[] = array(
                        'httt_ma' => $rowHTTT['httt_ma'],
                        'httt_ten' => $rowHTTT['httt_ten']
                    );
                }


                // --- Truy vấn dữ liệu sản phẩm --- ///

                // 2. Chuẩn bị câu lệnh sql
                $sqlSelectSP = <<<EOT
                    SELECT * FROM sanpham
EOT;

                // 3. Thực thi câu lệnh
                $resultSelectSP = mysqli_query($conn, $sqlSelectSP);

                // 4. Phân rã dữ liệu
                $danhsachSP = [];
                while ($rowSP = mysqli_fetch_array($resultSelectSP, MYSQLI_ASSOC)) {
                    $danhsachSP[] = array(
                        'sp_ma' => $rowSP['sp_ma'],
                        'sp_ten' => $rowSP['sp_ten'],
                        'sp_gia' => $rowSP['sp_gia']
                    );
                }

                ?>


                <form name="frmDonHang" method="POST" action="">
                    <div class="text-center">
                        <br>
                        <h1>THÔNG TIN ĐƠN HÀNG</h1>
                        <hr>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="">Khách hàng: </label>
                        <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                            <option value="">-- Chọn khách hàng --</option>
                            <?php foreach ($danhsachKH as $kh) : ?>
                                <option value="<?= $kh['kh_tendangnhap'] ?>"><?= $kh['kh_hoten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Nơi giao:</label>
                        <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control" placeholder="Nhập địa chỉ giao hàng">
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Trạng thái thanh toán:</label> <br>
                            <input type="radio" value="0" name="dh_trangthai" checked> <span> Chưa thanh toán</span> &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" vaule="1" name="dh_trangthai"> <span> Đã thanh toán</span>
                        </div>
                        <div class="form-group col">
                            <label for="">Hình thức thanh toán: </label> <br>
                            <select name="httt_ma" id="httt_ma" class="form-control">
                                <option value="">-- Chọn hình thức thanh toán --</option>
                                <?php foreach ($danhsachHTTT as $httt) : ?>
                                    <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <fieldset id="chiTietDonHangContainer">
                        <div class="text-center">
                            <hr>
                            <h2>CHI TIẾT ĐƠN HÀNG</h2>
                            <hr>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Sản phẩm: </label>
                                <select class="form-control" name="sp_ma" id="sp_ma">
                                    <option value="">--- Chọn sản phẩm ---</option>
                                    <?php foreach ($danhsachSP as $sp) : ?>
                                        <option value="<?= $sp['sp_ma']; ?> " data-sp_gia="<?= $sp['sp_gia']; ?>"><?= $sp['sp_ten']; ?> - <?= $sp['sp_gia']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label> Số lượng:</label>
                                <input type="number" name="ctdh_soluong" id="ctdh_soluong" class="form-control" placeholder="Nhập số lượng">
                            </div>
                            <div class="col">
                                <label>Xử lý:</label> <br>
                                <button type="button" class="btn btn-warning" name="btnAddCart" id="btnThemSP">Thêm vào đơn hàng</button>
                            </div>
                        </div>
                        <br>
                        <table id="tblChiTietDonHang" class="table table-bordered">
                            <thead>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </fieldset>
                    <br>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <button name="btnSave" class="btn btn-primary">Lưu đơn hàng</button>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php" class="btn btn-secondary">Hủy</a>
                        </div>
                    </div>
                    <br><br>
                </form>
            </div>
            <!-- end Content -->
        </div>
    </div>

    <?php
    if(isset($_POST['btnAddCart'])){
        $sp_ma = $_POST['sp_ma'];
        $ctdh_soluong = $_POST['ctdh_soluong'];

        
    }

    if(isset($_POST['btnSave'])){
        $kh_tendangnhap = $_POST['kh_tendangnhap'];
        $dh_noigiao = $_POST['dh_noigiao'];
        $dh_trangthai = $_POST['dh_trangthai'];
        $httt_ma = $_POST['httt_ma'];
        $dh_trangthai = $_POST['dh_trangthai'];
    }
    ?>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->

    <script>
        function formatNumber(nStr, decSeperate, groupSeperate) {
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2;
        }


        $('#btnThemSP').click(function() {
            // Lấy thông tin sản phẩm
            var sp_ma = $('#sp_ma').val();
            var sp_gia = $('#sp_ma option:selected').data('sp_gia');
            var sp_ten = $('#sp_ma option:selected').text();
            var ctdh_soluong = $('#ctdh_soluong').val();
            var thanhtien = (soluong * sp_gia);

            // Tạo mẫu trong html table
            var htmlStr = '<tr>';
            htmlStr += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '" /></td>';
            htmlStr += '<td>' + soluong + '<input type="hidden" name="ctdh_soluong[]" value="' + soluong + '" /></td>';
            htmlStr += '<td class="text-right">' + formatNumber(sp_gia, '.', ',') + '<input type="hidden" name="ctdh_gia[]" value="' + sp_gia + '" /></td>';
            htmlStr += '<td class="text-right">' + formatNumber(thanhtien, '.', ',') + '</td>';
            htmlStr += '<td><button type="button" class="btn btn-danger btn-delete-row"><i class="fa fa-trash"></i></button>';
            htmlStr += '</tr>';
            // Thêm vào table
            $('#tblChiTietDonHang tbody').append(htmlStr);


            //Clear
            $('#sp_ma').val('');
            $('#soluong').val('');

            // Đăng ký sự kiện xóa chi tiết đơn hàng
            $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
                $(this).parent().parent()[0].remove();
            });
        });
    </script>
</body>

</html>