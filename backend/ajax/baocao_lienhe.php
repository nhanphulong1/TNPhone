<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSoLuongLienHe = "SELECT COUNT(*) AS soLuongLienHe FROM lienhe";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$resultSoLuongLienHe = mysqli_query($conn, $sqlSoLuongLienHe);

$dataSoLuongLienHe = [];
while($row = mysqli_fetch_array($resultSoLuongLienHe, MYSQLI_ASSOC))
{
    $dataSoLuongLienHe[] = array(
        'soLuongLienHe' => $row['soLuongLienHe']
    );
}
// 5. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($dataSoLuongLienHe[0]);
?>