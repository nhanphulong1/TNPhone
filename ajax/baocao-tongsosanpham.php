<?php

include_once(__DIR__.'/../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlquantitySanPham = "select sum(sp_soluong) as quantity from `sanpham`";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlquantitySanPham);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $dataquantitySanPham[] = array(
        'quantity' => $row['quantity']
    );
}

echo json_encode($dataquantitySanPham);

?>