<?php
// var_dump($_SERVER["SCRIPT_NAME"]);die;

// Biến $_SERVER là biến hệ thống do PHP quản lý, dùng để lưu trữ các thông tin về Request gởi đến Server
// Trong đó key: $_SERVER['SCRIPT_NAME']
// Dùng để lưu trữ giá trị thông tin đường dẫn URL
// Tùy theo đường dẫn URL, set giá trị Tên trang và Tiêu đề phù hợp
switch ($_SERVER['SCRIPT_NAME']) {
    // CRUD Danh mục sản phẩm
  case "/TNPhone/backend/function/sanpham/index.php":
    $CURRENT_PAGE = "sanpham";
    $PAGE_TITLE = "Danh sách sản phẩm";
    break;
  case "/TNPhone/backend/function/sanpham/create.php":
    $CURRENT_PAGE = "sanpham.themsp";
    $PAGE_TITLE = "Thêm mới sản phẩm";
    break;
  case "/TNPhone/backend/function/sanpham/edit.php":
    $CURRENT_PAGE = "sanpham.suasp";
    $PAGE_TITLE = "Chỉnh sửa sản phẩm";
    break;

    // Tên trang và Tiêu đề mặc định
  default:
    $CURRENT_PAGE = "index";
    $PAGE_TITLE = "Admin - Trang quản trị";
}
