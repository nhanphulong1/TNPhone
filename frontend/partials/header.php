<nav id="header" >
    <div id="tieudelogo">
        <div  class="row">
            <div class="col-md-3" id="logo">
                <a href="/TNPhone/index.php">
                    <img src="/TNPhone/shared/logo.png" alt="Logo TNPhone"><span>TN</span>PHONE
                </a>
            </div>
            <div id="search" class="col-md-4">
                <div>
                    <input type="text" id="searchIP" class="searchTerm" placeholder="Search for ...">
                    <button type="submit" class="searchbtn" id="btnSearch">
                        <i class="fa fa-search"></i>
                    </button>
                    <ul id="search-ajax">
                    </ul>
                </div>
            </div>
            <div id="taikhoan" class="col-md-5 text-right">
                <a href="/TNPhone/frontend/thanhtoan/giohang.php" class="btn btn-info" id="cartbutton">
                    <i class="fa fa-shopping-cart"></i>
                    Giỏ hàng<span class="badge bg-warning"></span>
                </a>
                <div id="account">
                    <?php if(!isset($_COOKIE['kh_tendangnhap'])): ?>
                        <a href="/TNPhone/frontend/layouts/dangnhap.php">Đăng nhập</a>
                        <a href="/TNPhone/frontend/layouts/dangky.php">Đăng ký</a>
                    <?php else: ?>
                        <img src="/TNPhone/shared/default-avatar.jpg" alt="Avatar" id="avatar-img">
                        <label><?=$_COOKIE['kh_hoten'] ?></label>
                        <a href="/TNPhone/frontend/layouts/dangxuat.php">Đăng xuất</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="menu">
    <div class="container">
		<div class="row">
			<div class="col">
				<a href="/TNPhone/index.php">Trang chủ</a>
			</div>
			<div class="col">
				<a href="/TNPhone/frontend/layouts/sanpham.php">Sản phẩm</a>
			</div>
			<div class="col">
				<a href="/TNPhone/frontend/layouts/gioithieu.php">Giới thiệu</a>
			</div>
			<div class="col">
				<a href="/TNPhone/frontend/layouts/lienhe.php">Liên hệ</a>
			</div>
		</div>
	</div>
</div>