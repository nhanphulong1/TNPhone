<?php

include_once(__DIR__.'/../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlquantityKhachHang = "select count(*) as quantity from `khachhang`";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlquantityKhachHang);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $dataquantityKhachHang[] = array(
        'quantity' => $row['quantity']
    );
}

echo json_encode($dataquantityKhachHang);

?>