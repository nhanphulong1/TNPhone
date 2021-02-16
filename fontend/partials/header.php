<nav id="header" >
    <div id="tieudelogo">
        <div  class="row">
            <div class="col-md-3" id="logo">
                <a href="/fontend/index.php">
                    <img src="/shared/logo.png" alt="Logo TNPhone"><span>TN</span>PHONE
                </a>
            </div>
            <div id="search" class="col-md-4">
                <div>
                    <input type="text" class="searchTerm" placeholder="Search for ...">
                    <button type="submit" class="searchbtn">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div id="taikhoan" class="col-md-5 text-right">
                <a href="/fontend/thanhtoan/giohang.php" class="btn btn-info" id="cartbutton">
                    <i class="fa fa-shopping-cart"></i>
                    Giỏ hàng<span class="badge bg-warning"></span>
                </a>
                <?php if(!isset($_COOKIE['kh_tendangnhap'])): ?>
                    <a href="/fontend/layouts/dangnhap.php">Đăng nhập</a>
                    <a href="/fontend/layouts/dangky.php">Đăng ký</a>
                <?php else: ?>
                    <img src="/TNPhone/shared/default-avatar.jpg" alt="Avatar">
                    <label><?=$_COOKIE['kh_hoten'] ?></label>
                    <a href="/fontend/layouts/dangxuat.php">Đăng xuất</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div id="menu">
    <div class="container">
		<div class="row">
			<div class="col">
				<a href="/fontend/index.php">Trang chủ</a>
			</div>
			<div class="col">
				<a href="/fontend/layouts/sanpham.php">Sản phẩm</a>
			</div>
			<div class="col">
				<a href="/fontend/layouts/gioithieu.php">Giới thiệu</a>
			</div>
			<div class="col">
				<a href="/fontend/layouts/lienhe.php">Liên hệ</a>
			</div>
		</div>
	</div>
</div>