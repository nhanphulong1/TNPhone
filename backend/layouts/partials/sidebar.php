<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <!-- #################### Menu các trang Quản lý #################### -->
            <li class="nav-item">
                <a href="/backend/pages/dashboard.php">Bảng tin <span class="sr-only">(current)</span></a>
            </li>
            <hr style="border: 1px solid red; width: 80%;" />
            <!-- #################### End Menu các trang Quản lý #################### -->

            <!-- #################### Menu chức năng Danh mục #################### -->
            <li class="nav-item sidebar-heading">
                <span>Danh mục</span>
            </li>
            <!-- Menu Chuyên mục sản phẩm -->
            <li class="nav-item">
                <a href="#danhmucSanPham" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    Sản phẩm
                </a>
                <ul class="collapse" id="danhmucSanPham">
                    <li class="nav-item">
                        <a href="/TNPhone/backend/function/sanpham/index.php">Danh sách</a>
                    </li>
                    <li class="nav-item">
                        <a href="/TNPhone/backend/function/sanpham/create.php">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <!-- End Menu Chuyên mục sản phẩm -->

            <!-- Menu Chuyên mục khách hàng -->
            <li class="nav-item">
                <a href="#danhmucKhachHang" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    Khách hàng
                </a>
                <ul class="collapse" id="danhmucKhachHang">
                    <li class="nav-item">
                        <a href="/TNPhone/backend/function/khachhang/index.php">Danh sách</a>
                    </li>
                    <li class="nav-item">
                        <a href="/TNPhone/backend/function/khachhang/create.php">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <!-- End Menu Chuyên mục khách hàng -->

            <!-- Menu Chuyên mục khuyến mãi -->
            <li class="nav-item">
                <a href="#danhmucKhuyenMai" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    Khuyến mãi
                </a>
                <ul class="collapse" id="danhmucKhuyenMai">
                    <li class="nav-item">
                        <a href="/TNPhone/backend/function/khuyenmai/index.php">Danh sách</a>
                    </li>
                    <li class="nav-item">
                        <a href="/TNPhone/backend/function/khuyenmai/create.php">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <!-- End Menu Chuyên mục khuyến mãi -->



            <!-- #################### End Menu chức năng Danh mục #################### -->
        </ul>
    </div>
</nav>