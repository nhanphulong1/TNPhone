<?php
// var_dump($_SERVER["SCRIPT_NAME"]);die;

// Biến $_SERVER là biến hệ thống do PHP quản lý, dùng để lưu trữ các thông tin về Request gởi đến Server
// Trong đó key: $_SERVER['SCRIPT_NAME']
// Dùng để lưu trữ giá trị thông tin đường dẫn URL
// Tùy theo đường dẫn URL, set giá trị Tên trang và Tiêu đề phù hợp
switch ($_SERVER['SCRIPT_NAME']) {
    // CRUD Danh mục Loại sản phẩm
  case "/TNPhone/fontend/index.php":
    $CURRENT_PAGE = "fontend.index";
    $PAGE_TITLE = "Trang chủ TNPhone";
    break;
  case "/TNPhone/fontend/layouts/lienhe.php":
    $CURRENT_PAGE = "fontend.lienhe";
    $PAGE_TITLE = "Liên Hệ TNPhone";
    break;
  case "/TNPhone/fontend/layouts/gioithieu.php":
    $CURRENT_PAGE = "fontend.gioithieu";
    $PAGE_TITLE = "Giới thiệu về TNPhone";
    break;
  case "/TNPhone/fontend/layouts/giohang.php":
    $CURRENT_PAGE = "fontend.giohang";
    $PAGE_TITLE = "Giỏ hàng";
    break;

    // Tên trang và Tiêu đề mặc định
  default:
    $CURRENT_PAGE = "fontend.index1";
    $PAGE_TITLE = "Chào mừng các bạn đến với TNPhone";
}
