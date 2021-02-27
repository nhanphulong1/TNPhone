<?php session_start(); ?>
<?php if (isset($_SESSION['dangnhap']) && $_SESSION['dangnhap'] == true) : ?>
<?php
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../../../dbconnect.php');

    // Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
    $kh_tendangnhap = $_GET['kh_tendangnhap'];
    $sqlDelete = "DELETE FROM khachhang WHERE kh_tendangnhap= $kh_tendangnhap";

    // Thực thi
    $result = mysqli_query($conn, $sqlDelete);
    echo '<script>location.href = "index.php"; alert("Đã xóa thành công");</script>';
    //
?>
<?php else : ?>
<?php echo '<script>alert("Đăng nhập quyền quản trị để truy cập"); location.href ="/TNPhone/frontend/layouts/dangnhap.php";</script>' ?>
<?php endif; ?>