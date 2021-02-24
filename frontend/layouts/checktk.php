<?php
    $kh_tendangnhap = $_GET['kh_tendangnhap'];
    include_once(__DIR__.'/../../dbconnect.php');
    $sql=<<<EOT
        select * FROM khachhang WHERE kh_tendangnhap="$kh_tendangnhap"
    EOT;

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        echo "Tài khoản đã được đăng ký!";
        // echo json_encode(['status' => 'error', 'message' => 'Tài khoản đã được đăng ký!']);
    }else{
        echo "Bạn có thể sử dụng tài khoản này!";
        // echo json_encode(['status' => 'success']);
    }
?>