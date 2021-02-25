<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../../dbconnect.php');

// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
$km_ma = $_GET['km_ma'];
$sqlDelete = "DELETE FROM khuyenmai WHERE km_ma= $km_ma";

// Thực thi
$result = mysqli_query($conn,$sqlDelete);
echo '<script>location.href = "index.php"; alert("Đã xóa thành công");</script>';
//
?>