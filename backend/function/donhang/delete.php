<?php session_start(); ?>
<?php if (isset($_SESSION['dangnhap']) && $_SESSION['dangnhap'] == true) : ?>
<?php
    // Truy vấn database
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../../../dbconnect.php');

    // 2. Chuẩn bị câu truy vấn $sql
    // Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
    $dh_ma = $_GET['dh_ma'];

    // 3. Xóa các dòng con (chi tiết Đơn hàng) trước
    $sqlDeleteChiTietDonHang = "DELETE FROM chitietdathang WHERE dh_ma=" . $dh_ma;

    // 3.1. Thực thi câu lệnh DELETE Chi tiết Đơn hàng
    $resultChiTietDonHang = mysqli_query($conn, $sqlDeleteChiTietDonHang);

    // 4. Xóa dòng Đơn hàng
    $sqlDeleteDonHang = "DELETE FROM donhang WHERE dh_ma=" . $dh_ma;

    // 3.1. Thực thi câu lệnh DELETE Chi tiết Đơn hàng
    $resultDeleteDonHang = mysqli_query($conn, $sqlDeleteDonHang);

    // 4. Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    echo '<script>location.href="index.php"; alert("Đã xóa thành công");</script>'
?>
<?php else : ?>
    <?php echo '<script>alert("Đăng nhập quyền quản trị để truy cập"); location.href ="/TNPhone/frontend/layouts/dangnhap.php";</script>' ?>
<?php endif; ?>
