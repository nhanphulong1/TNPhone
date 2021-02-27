<?php session_start(); ?>
<?php if (isset($_SESSION['dangnhap']) && $_SESSION['dangnhap'] == true) : ?>
<?php
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../../../dbconnect.php');

    // Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
    $sp_ma = $_GET['sp_ma'];

    // Xóa hình
    $sqlSelect = "SELECT * FROM sanpham WHERE sp_ma = $sp_ma";
    $resultSelect = mysqli_query($conn, $sqlSelect);
    $row1 = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

    $upload_dir = __DIR__ . '/../../../assets/uploads/';
    $subdir = 'products/';

    $old_file = $upload_dir . $subdir . $row1['sp_hinhdaidien'];

    if (file_exists($old_file)) {
        // Hàm unlink(filepath) dùng để xóa file trong PHP
        unlink($old_file);
    }


    $sqlDelete = "DELETE FROM sanpham WHERE sp_ma= $sp_ma";

    // Thực thi
    $result = mysqli_query($conn, $sqlDelete);
    echo '<script>location.href = "index.php"; alert("Đã xóa thành công");</script>';
    //
?>
<?php else : ?>
<?php echo '<script>alert("Đăng nhập quyền quản trị để truy cập"); location.href ="/TNPhone/frontend/layouts/dangnhap.php";</script>' ?>
<?php endif; ?>