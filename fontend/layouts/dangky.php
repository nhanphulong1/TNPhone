<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once(__DIR__.'/../config.php');
        include_once(__DIR__.'/../head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../../../assets/frontend/css/dangky.css">
</head>
<body>
    <?php
        include_once(__DIR__.'/../../dbconnect.php');
    ?>
    <div class="container">
        <div id="logoDN"><a href="/fontend/"><img src="/shared/logo.png" alt="Logo"></a></div>
        <hr>
        <div id="DangKy">
            <form name="frmDangKy" id="frmDangKy" action="" method="post">
                <h4>Đăng Ký</h4>
                <div id="thongbao"></div>
                <div class="form-group">
                    <label for="kh_tendangnhap">Tên đăng nhập:</label>
                    <input type="text" class="form-control" name="kh_tendangnhap" id="kh_tenDangKy">
                </div>
                <div class="form-group">
                    <label for="kh_hoten">Họ và tên:</label>
                    <input type="text" class="form-control" name="kh_hoten" id="kh_hoten">
                </div>
                <div class="form-group">
                    <label for="kh-matkhau">Mật khẩu:</label>
                    <input type="password" class="form-control" name="kh_matkhau" id="kh-matkhau">
                </div>
                <div class="form-group">
                    <label for="kh_diachi">Địa chỉ:</label>
                    <input type="text" class="form-control" name="kh_diachi" id="kh_diachi">
                </div>
                <div class="form-group">
                    <label for="kh_sdt">Số điện thoại:</label>
                    <input type="text" class="form-control" name="kh_sdt" id="kh_sdt">
                </div>
                <button name="btnDangKy" type="submit" class="btn btn-primary">Đăng ký</button><br>
            </form>
        </div>
    </div>
    <script>
        
    </script>
</body>
</html>