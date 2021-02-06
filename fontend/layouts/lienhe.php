<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include_once(__DIR__.'/../config.php');
        include_once(__DIR__.'/../head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="../../../assets/frontend/css/lienhe.css">
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../partials/header.php') ?>

    <div class="container">
    <?php include_once(__DIR__.'/../../dbconnect.php') ?>
        <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
        <hr>
        <form id="frmLienHe" name="frmLienHe" onsubmit="return validateForm()" action="" method="post">
            <div class="form-group">
                <label for="email">Email của bạn</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email của bạn" require>
            </div>
            <hr>
            <div class="form-group">
                <label for="title">Tiêu đề của bạn</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề của bạn" require>
            </div>
            <hr>
            <div class="form-group">
                <label for="message">Lời nhắn của bạn</label>
                <textarea name="message" class="form-control"></textarea>
            </div>
            <button class="btn btn-info" name="btnGoiLoiNhan">Gởi lời nhắn</button>
        </form>
        <?php
            if(isset($_POST['btnGoiLoiNhan'])){
                $tieude = $_POST['title'];
                $email = $_POST['email'];
                $noidung = $_POST['message'];
                if(!empty($tieude) && !empty($email) && !empty($noidung)){
                    // Cau lenh SQL
                    $sql = <<<EOT
                    INSERT INTO lienhe
                    (lh_tieude, lh_email, lh_noidung)
                    VALUES ('$tieude', '$email', '$noidung')
EOT;

                    // Thuc thi cau lenh
                    $result = mysqli_query($conn,$sql);
                    //Kiem tra
                    if($result == 1){
                        echo "<script>alert('Gởi liên hệ thành công!');</script>";
                    }else{
                        echo "<script>alert('Gởi liên hệ thất bại! Xin vui lòng thử lại sau vài phút');</script>";
                    }
                }
            }
        ?>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8414543437398!2d105.76842661474039!3d10.02993897527015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zxJDhuqFpIGjhu41jIEPhuqduIFRoxqE!5e0!3m2!1svi!2s!4v1612583968676!5m2!1svi!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <!-- Footer -->
    <?php include_once(__DIR__.'/../partials/footer.php') ?>
    <!-- Scripts -->
    <?php include_once(__DIR__.'/../scripts.php') ?>
    <script>
        function validateForm(){
            var title = document.getElementById('title').value;
            var email = document.getElementById('email').value;
            var message = document.getElementById('message').value;
            alert (title);
            if(title == "" || email == "" || message == ""){
                return false;
            }else {
                return true;
            }
        }
    </script>
</body>
</html>