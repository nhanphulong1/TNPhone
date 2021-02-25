<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once(__DIR__.'/../config.php');
        include_once(__DIR__.'/../head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../../assets/frontend/css/dangky.css">
</head>
<body>
    <?php
        include_once(__DIR__.'/../../dbconnect.php');
    ?>
    <div class="container">
        <div id="logoDN"><a href="/TNPhone/"><img src="/TNPhone/shared/logo.png" alt="Logo"></a></div>
        <hr>
        <div id="DangKy">
            <form name="frmDangKy" id="frmDangKy" action="" method="post">
                <h4>Đăng Ký</h4>
                <div class="form-group">
                    <label for="kh_tendangnhap">Tên đăng nhập:</label>
                    <input type="text" class="form-control" name="kh_tendangnhap" id="kh_tendangnhap">
                    <div id="tendangnhap"></div>
                </div>
                <div class="form-group">
                    <label for="kh_hoten">Họ và tên:</label>
                    <input type="text" class="form-control" name="kh_hoten" id="kh_hoten">
                    <div class="thongbao alert alert-danger" id="hoten">Họ và tên không được để trống!</div>
                </div>
                <div class="form-group">
                    <label for="kh_matkhau">Mật khẩu:</label>
                    <input type="password" class="form-control" name="kh_matkhau" id="kh_matkhau">
                    <div class="thongbao alert alert-danger" id="matkhau">Mật khẩu có độ dài từ 5-20 ký tự!</div> 
                </div>
                <div class="form-group">
                    <label for="kh-matkhau">Nhập lại mật khẩu:</label>
                    <input type="password" class="form-control" name="kh_nl_matkhau" id="kh_nl_matkhau">
                    <div class="thongbao alert alert-danger" id="nl_matkhau">Mật khẩu phải trùng nhau và không để trống!</div>
                </div>
                <div class="form-group">
                    <label for="kh_diachi">Địa chỉ:</label>
                    <input type="text" class="form-control" name="kh_diachi" id="kh_diachi">
                    <div class="thongbao alert alert-danger" id="diachi">Địa chỉ không được để trống!</div>
                </div>
                <div class="form-group">
                    <label for="kh_sdt">Số điện thoại:</label>
                    <input type="text" class="form-control" name="kh_sdt" id="kh_sdt">
                    <div class="thongbao alert alert-danger" id="sdt">Vui lòng nhập đúng số điện thoại!</div>
                </div>
                <button name="btnDangKy" type="submit" class="btn btn-primary">Đăng ký</button><br>
            </form>
        </div>
    </div>
    <?php include_once(__DIR__.'/../scripts.php') ?>
    <script>
        // function checkUser() {
        //     let user = document.getElementById("kh_tendangnhap").value;
        //     if(user.length < 5 || user == ""){
        //         document.getElementById("tendangnhap").innerHTML= "Tài khoản phải từ 5 ký tự trở lên";
        //         document.getElementById("tendangnhap").className="thongbao alert alert-danger";
        //         return false;
        //     }else{
        //         Kiemtra_User(user);
        //         debugger;
        //         if(check_tk(document.getElementById("tendangnhap").innerHTML)){
        //             document.getElementById("tendangnhap").className="thongbao alert alert-success";
        //         }else{
        //             document.getElementById("tendangnhap").className="thongbao alert alert-danger";
        //         }
        //     }
        // }

        // function check_tk(str) {
        //     if(str=="Tài khoản được sử dụng!") return true;
        //     return false;
        // }

        // function Kiemtra_User(user) {
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 && this.status == 200) {
        //             document.getElementById("tendangnhap").innerHTML = this.responseText;
        //         }
        //     }
        //     xhttp.open("GET", "checktk.php?kh_tendangnhap="+user, true);
        //     xhttp.send();
        // }

        $(document).ready(function(){
            $(".thongbao").hide();
            $("#kh_tendangnhap").keyup(function(){
                var user = $(this).val();
                if(user.length < 5 || user == ""){
                    document.getElementById("tendangnhap").innerHTML= "Tài khoản phải từ 5 ký tự trở lên";
                    document.getElementById("tendangnhap").className="thongbao alert alert-danger";
                    return false;
                }else{
                    $.ajax({url: "checktk.php?kh_tendangnhap="+user, success: function(data){
                        document.getElementById("tendangnhap").innerHTML= data;
                        if(data=="Tài khoản đã được đăng ký!"){
                            document.getElementById("tendangnhap").className="thongbao alert alert-danger";
                        }
                        else{
                            document.getElementById("tendangnhap").className="thongbao alert alert-success";
                        }
                    }})
                }
            })
            $("#frmDangKy").on("submit",function(){
                var hoten = $("#kh_hoten").val();
                var pass = $("#kh_matkhau").val();
                var repass = $("#kh_nl_matkhau").val();
                var diachi = $("#kh_diachi").val();
                var sdt = $("#kh_sdt").val();
                // Username
                $("#kh_tendangnhap").keyup();
                if($("#tendangnhap").html()=="Bạn có thể sử dụng tài khoản này!"){
                    var check_tk = 1;
                }else{
                    var check_tk = 0;
                }
                // Ho&Ten
                if(hoten == ""){
                    $("#hoten").show();
                    var check_hoten = 0;
                }else{
                    $("#hoten").hide();
                    var check_hoten = 1;
                }
                // Pass
                if(pass.length<=20 && pass.length>=5){
                    $("#matkhau").hide();
                    var check_pass = 1;
                }else{
                    $("#matkhau").show();
                    var check_pass = 0;
                }
                // Repass
                if(repass.length<=20 && repass.length>=5 && repass==pass){
                    $("#nl_matkhau").hide();
                    var check_repass = 1;
                }else{
                    $("#nl_matkhau").show();
                    var check_repass = 0;
                }
                // Diachi
                if(diachi!=""){
                    $("#diachi").hide();
                    var check_diachi = 1;
                }else{
                    $("#diachi").show();
                    var check_diachi = 0;
                }
                // SĐT
                if(/((09|03|07|08|05)+([0-9]{8})\b)/.test(sdt)){
                    $("#sdt").hide();
                    var check_sdt = 1;
                }else{
                    $("#sdt").show();
                    var check_sdt = 0;
                }

                // Kiểm tra submit
                if(check_tk == 0 || check_hoten == 0 || check_pass == 0 || check_repass == 0 || check_diachi == 0 || check_sdt == 0)
                    return false;
                else
                    return true;
            })
        });
    </script>
    <?php
        if(isset($_POST['btnDangKy'])){
            $kh_tendangnhap = $_POST['kh_tendangnhap'];
            $kh_hoten = $_POST['kh_hoten'];
            $kh_matkhau = md5($_POST['kh_matkhau']);
            $kh_diachi = $_POST['kh_diachi'];
            $kh_sdt = $_POST['kh_sdt'];

            // Câu lệnh thêm tài khoản
            $sql = <<<EOT
                INSERT INTO khachhang
                (kh_tendangnhap, kh_hoten, kh_matkhau, kh_diachi, kh_sdt)
                VALUES ('$kh_tendangnhap', '$kh_hoten', '$kh_matkhau', '$kh_diachi', '$kh_sdt')
            EOT;

            //Thực hiện câu lệnh
            $result = mysqli_query($conn,$sql);
            
            //Kiểm tra

            if($result){
                // setcookie("kh_tendangnhap",$kh_tendangnhap,time()+320,"/");
                echo "<script>alert('Đăng ký thành công!');</script>";
                // sleep(3000);
                echo "<script>location.href='dangnhap.php';</script>";
            }else{
                echo "<script>alert('Đăng ký bị lỗi! Xin vui lòng thử lại');</script>";
            }
        }
    ?>
</body>
</html>