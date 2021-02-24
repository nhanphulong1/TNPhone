<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once(__DIR__.'/../config.php');
        include_once(__DIR__.'/../head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../../../assets/frontend/css/dangnhap.css">
</head>
<body>
    <?php
        include_once(__DIR__.'/../../dbconnect.php');
        $taikhoan="";
        $matkhau="";
        $check="";
        if(isset($_COOKIE['user'])){
            $taikhoan=$_COOKIE['user'];
            $matkhau=$_COOKIE['pass'];
            $check = "checked";
            // echo '<script>
            //     document.getElementById("kh_tendangnhap").value="'.$_COOKIE['user'].'";
            //     document.getElementById("kh_matkhau").value="'.$_COOKIE['pass'].'";
            // </script>';
        }
    ?>
    <div class="container">
        <div id="logoDN"><a href="/TNPhone/frontend/"><img src="/shared/logo.png" alt="Logo"></a></div>
        <hr>
        <div id="DangNhap">
            <form name="frmDangNhap" id="frmDangNhap" action="" method="post">
                <h4>Đăng Nhập</h4>
                <div id="thongbao"></div>
                <div class="form-group">
                    <label for="kh_tendangnhap">Tên đăng nhập:</label>
                    <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" value="<?= $taikhoan ?>">
                </div>
                <div class="form-group">
                    <label for="kh-matkhau">Mật khẩu:</label>
                    <input type="password" name="kh_matkhau" id="kh-matkhau" value="<?= $matkhau ?>">
                </div>
                <div class="form-group" id="ghinho">
                    <input type="checkbox" name="chk_ghinho" id="chk_ghinho" <?= $check ?>> <label for="chk_ghinho">ghi nhớ đăng nhập</label>
                </div>
                <button name="btnDangNhap" type="submit" class="btn btn-primary">Đăng nhập</button><br>
                <a href="dangky.php" id="dangky">Chưa có tài khoản? Đăng ký</a>
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['btnDangNhap'])){
            $kh_tendangnhap = $_POST['kh_tendangnhap'];
            $kh_matkhau = $_POST['kh_matkhau'];
            $password = md5($kh_matkhau);
            $sqlDangNhap = <<<EOT
                SELECT *
                FROM khachhang
                WHERE kh_tendangnhap = '$kh_tendangnhap' AND kh_matkhau = '$password'
            EOT;

            $resultDangNhap = mysqli_query($conn,$sqlDangNhap);

            if(mysqli_num_rows($resultDangNhap)>0){
                $row = mysqli_fetch_array($resultDangNhap,MYSQLI_ASSOC);
                $kh_hoten = $row['kh_hoten'];
                setcookie("kh_tendangnhap",$kh_tendangnhap,time()+320,"/");
                setcookie("kh_hoten",$kh_hoten,time()+320,"/");
                echo "<script>location.href='/TNPhone/frontend/';</script>";
                if(isset($_POST['chk_ghinho'])){
                    setcookie("user",$kh_tendangnhap,time()+(68400*2),"/");
                    setcookie("pass",$kh_matkhau,time()+(68400*2),"/");
                }
            }else{
                echo "<script>
                    document.getElementById('thongbao').className='alert alert-danger';
                    document.getElementById('thongbao').innerHTML='Sai tên đăng nhập hoặc mật khẩu!';
                </script>";
            }

        }
    ?>
</body>
</html>