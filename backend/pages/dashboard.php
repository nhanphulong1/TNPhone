<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Nhúng file quản lý phần HEAD -->
    <?php include_once(__DIR__ . '/../layouts/head.php'); ?>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->

            <div class="col-md-9">
                <br>
                <h1 class="text-center">BẢNG TIN QUẢN LÝ</h1>
                <hr>
                <br>
                <!-- content -->
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div id="baocao_SLSP" class="bg-primary">
                            <h1>0</h1>
                            <p>Tổng số sản phẩm</p>
                        </div>
                        <button id="refresh_baocaoSLSP" class="btn btn-primary">Refresh số lượng sản phẩm</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <div id="baocao_SLDH" class="bg-warning">
                            <h1>0</h1>
                            <p>Tổng số lượng đơn hàng</p>
                        </div>
                        <button id="refresh_baocaoSLDH" class="btn btn-primary">Refresh số lượng đơn hàng</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <div id="baocao_SLKH" class="bg-success">
                            <h1>0</h1>
                            <p>Tổng số lượng khách hàng</p>
                        </div>
                        <button id="refresh_baocaoSLKH" class="btn btn-primary">Refresh số lượng khách hàng</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <div id="baocao_SLGY" class="bg-danger">
                            <h1>0</h1>
                            <p>Tổng số lượng góp ý</p>
                        </div>
                        <button id="refresh_baocaoSLGY" class="btn btn-primary">Refresh số lượng góp ý</button>
                    </div>

                </div>
                <br>
                <div class="row">
                    <!-- Biểu đồ thống kê sản phẩm -->
                    <div class="col-sm-6 col-lg-6">
                        <canvas id="chartOfobjChartThongKeSanPhamTheoNSX"></canvas>
                        <br>
                        <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeSanPhamTheoNSX">Refresh dữ liệu</button>
                    </div><!-- col -->
                </div>
                
                <!-- end content -->

            </div>

        </div>
    </div>

    <!-- footer -->
    <br><br><br>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            // Hàm refresh SLSP
            function getDataSLSP() {
                $.ajax('/TNPhone/backend/ajax/baocao_hanghoa.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = '<h1>' + dataObj.soLuongSP + '</h1><p>Tổng số sản phẩm</p>';
                        $('#baocao_SLSP').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Có lỗi xảy ra, vui lòng thực hiện lại' + errorThrown);
                    }
                });
            }
            // Hàm refresh SLDH
            function getDataSLDH() {
                $.ajax('/TNPhone/backend/ajax/baocao_donhang.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = '<h1>' + dataObj.soLuongDH + '</h1><p>Tổng số đơn hàng</p>';
                        $('#baocao_SLDH').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Có lỗi xảy ra, vui lòng thực hiện lại' + errorThrown);
                    }
                });
            }

            // Hàm refresh SLKH
            function getDataSLKH() {
                $.ajax('/TNPhone/backend/ajax/baocao_khachhang.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = '<h1>' + dataObj.soLuongKH + '</h1><p>Tổng số khách hàng</p>';
                        $('#baocao_SLKH').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Có lỗi xảy ra, vui lòng thực hiện lại' + errorThrown);
                    }
                });
            }
            // Hàm refresh SLGY
            function getDataSLGY() {
                $.ajax('/TNPhone/backend/ajax/baocao_lienhe.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = '<h1>' + dataObj.soLuongLienHe + '</h1><p>Tổng số liên hệ</p>';
                        $('#baocao_SLGY').html(htmlString);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Có lỗi xảy ra, vui lòng thực hiện lại' + errorThrown);
                    }
                });
            }


            // ------------------ Vẽ biểu đồ thống kê Loại sản phẩm -----------------
            // Vẽ biểu đổ Thống kê Loại sản phẩm sử dụng ChartJS
            var $objChartThongKeSanPhamTheoNSX;
            var $chartOfobjChartThongKeSanPhamTheoNSX = document.getElementById("chartOfobjChartThongKeSanPhamTheoNSX").getContext("2d");

            function renderChartThongKeSanPhamTheoNSX() {
                $.ajax({
                    url: '/TNPhone/backend/ajax/baocao-soluongSP-theoNSX.php',
                    type: "GET",
                    success: function(response) {
                        var data = JSON.parse(response);
                        var myLabels = [];
                        var myData = [];
                        $(data).each(function() {
                            myLabels.push((this.nsx_ten));
                            myData.push(this.soluongSP);
                        });
                        myData.push(0); // tạo dòng số liệu 0
                        if (typeof $objChartThongKeSanPhamTheoNSX !== "undefined") {
                            $objChartThongKeSanPhamTheoNSX.destroy();
                        }
                        $objChartThongKeSanPhamTheoNSX = new Chart($chartOfobjChartThongKeSanPhamTheoNSX, {
                            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                            type: "bar",
                            data: {
                                labels: myLabels,
                                datasets: [{
                                    data: myData,
                                    borderColor: "#9ad0f5",
                                    backgroundColor: "#9ad0f5",
                                    borderWidth: 1
                                }]
                            },
                            // Cấu hình dành cho biểu đồ của ChartJS
                            options: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: "Thống kê sản phẩm theo nhà sản xuất"
                                },
                                responsive: true
                            }
                        });
                    }
                });
            };

            $('#refresh_baocaoSLSP').click(function() {
                getDataSLSP();
            });
            $('#refresh_baocaoSLDH').click(function() {
                getDataSLDH();
            });

            $('#refresh_baocaoSLKH').click(function() {
                getDataSLKH();
            });

            $('#refresh_baocaoSLGY').click(function() {
                getDataSLGY();
            });
            $('#refreshThongKeSanPhamTheoNSX').click(function(event) {
                event.preventDefault();
                renderChartThongKeSanPhamTheoNSX();
            });
            getDataSLSP();
            getDataSLDH();
            getDataSLKH();
            getDataSLGY();
            renderChartThongKeSanPhamTheoNSX()
        });
    </script>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- <script src="..."></script> -->
</body>

</html>