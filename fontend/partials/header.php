<nav id="header" >
    <div id="tieudelogo">
        <div  class="row">
            <div class="col-md-3" id="logo">
                <a href="./index.php">
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
            <div id="taikhoan" class="col-md-5">
                <a href="#" class="btn btn-info" id="cartbutton">
                    <i class="fa fa-shopping-cart"></i>
                    Giỏ hàng<span class="badge bg-warning"></span>
                </a>
                <?php if(!isset($_COOKIE['tendangnhap'])): ?>
                    <a href="#đăng nhập">Đăng nhập</a>
                    <a href="#đăng ký">Đăng ký</a>
                <?php else: ?>
                    <img src="/TNPhone/shared/default-avatar.jpg" alt="Avatar">
                    <a href="#đăng xuất">Đăng xuất</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div id="menu">
    <div class="container">
		<div class="row">
			<div class="col">
				<a href="">Trang chủ</a>
			</div>
			<div class="col">
				<a href="">Sản phẩm</a>
			</div>
			<div class="col">
				<a href="">Giới thiệu</a>
			</div>
			<div class="col">
				<a href="">Liên hệ</a>
			</div>
		</div>
	</div>
</div>