<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>In đơn hàng</title>
    <link rel="stylesheet" href="/Salomon/assets/vendor/paper-css/paper.css">
    <style>
        @page {
            size: A4
        }
    </style>
</head>

<body class="A4">

    <?php
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    include_once(__DIR__ . '/../../../dbconnect.php');

    $dh_ma = $_GET['dh_ma'];
    // 2. Chuẩn bị câu truy vấn $sql
    $sqlThongTinDatHang = <<<EOT
        SELECT 
            dh.dh_ma,dh.dh_ngaylap,dh.dh_noigiao,
            httt.httt_ten,
            kh.kh_hoten,kh_sdt
        FROM donhang dh
        JOIN chitietdathang ctdh ON dh.dh_ma = ctdh.dh_ma
        JOIN khachhang kh ON dh.kh_tendangnhap = kh.kh_tendangnhap
        JOIN hinhthucthanhtoan httt ON dh.httt_ma = httt.httt_ma
        WHERE dh.dh_ma = $dh_ma
        GROUP BY dh.dh_ma  
EOT;

    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
    $resultThongTinDatHang = mysqli_query($conn, $sqlThongTinDatHang);

    $rowThongTinDatHang = mysqli_fetch_array($resultThongTinDatHang, MYSQLI_ASSOC)
    ?>
    <section class="sheet padding-10mm">

        <!-- Write HTML just like a web page -->
        <table width="100%">
            <tr>
                <td width="200px"><img src="/TNPhone/shared/logo-hd.png" alt="Logo" width="100%"></td>
                <td style="text-align: center; vertical-align: middle;">
                    <h1>CỬA HÀNG ĐIỆN THOẠI TNPHONE</h1>
                    <h3>MAKE UP YOUR STYLE</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <h2>HÓA ĐƠN BÁN HÀNG</h2>
                </td>
            </tr>
        </table>
        <p style="font-weight: bold;"><i><u>Thông tin đặt hàng:</u></i></p>
        <table>
            <tr>
                <td width="50%">Khách hàng: </td>
                <td><?= $rowThongTinDatHang['kh_hoten']; ?> (<?= $rowThongTinDatHang['kh_sdt']; ?>) </td>
            </tr>
            <tr>
                <td>Ngày lập: </td>
                <td><?= $rowThongTinDatHang['dh_ngaylap']; ?></td>
            </tr>
            <tr>
                <td>Nơi giao: </td>
                <td><?= $rowThongTinDatHang['dh_noigiao']; ?></td>
            </tr>
            <tr>
                <td>Hình thức thanh toán: </td>
                <td><?= $rowThongTinDatHang['httt_ten']; ?></td>
            </tr>
        </table>

        <?php

        $sqlChiTietDonHang = <<<EOT
            SELECT 
                sp.sp_ten,
                nsx.nsx_ten,
                ctdh.ctdh_soluong, ctdh.ctdh_gia, (ctdh.ctdh_soluong * ctdh.ctdh_gia) AS ThanhTien
            FROM chitietdathang ctdh
            JOIN sanpham sp ON ctdh.sp_ma = sp.sp_ma
            JOIN nhasanxuat nsx ON nsx.nsx_ma = sp.nsx_ma
            WHERE ctdh.dh_ma = $dh_ma
EOT;

        $resultChiTietDonHang = mysqli_query($conn, $sqlChiTietDonHang);
        $ChiTiet = [];
        while ($rowChiTietDonHang = mysqli_fetch_array($resultChiTietDonHang, MYSQLI_ASSOC)) {
            $ChiTiet[] = array(
                'sp_ten' => $rowChiTietDonHang['sp_ten'],
                'nsx_ten' => $rowChiTietDonHang['nsx_ten'],
                'ctdh_soluong' => $rowChiTietDonHang['ctdh_soluong'],
                'ctdh_gia' => $rowChiTietDonHang['ctdh_gia'],
                'ThanhTien' => $rowChiTietDonHang['ThanhTien']
            );
        }
        $stt = 1;
        $tongThanhTien = 0;
        ?>

        <p style="font-weight: bold;"><i><u>Chi tiết đơn hàng:</u></i></p>
        <table width="100%" border="1" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ChiTiet as $ct) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $stt;
                                                        $stt += 1; ?></td>
                        <td style="padding: 5px;">
                            <b><?= $ct['sp_ten']; ?></b> <br>
                            <i><?= $ct['nsx_ten']; ?></i>
                        </td>
                        <td style="text-align: center;padding: 5px;"><?= $ct['ctdh_soluong']; ?></td>
                        <td style="text-align: right;padding: 5px;"><?= number_format($ct['ctdh_gia'], "0", ".", ",") . ' VND'; ?></td>
                        <td style="text-align: right;padding: 5px;"><?= number_format($ct['ThanhTien'], "0", ".", ",") . ' VND';
                                                                    $tongThanhTien += $ct['ThanhTien']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="font-weight: bold;">
                    <td colspan="4" style="text-align: right; padding: 5px; font-size: 20px;">Tổng thành tiền: </td>
                    <td style="text-align: right; padding: 5px; font-size: 20px;"><?= number_format($tongThanhTien, "0", ".", ",") . ' VND'; ?></td>
                </tr>
            </tfoot>
        </table>
        <br>
        <br>
        <table width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center; width:33%">Người nhận hàng</i></th>
                    <th style="text-align: center; width:33%">Người nhận thanh toán</th>
                    <th style="text-align: center; width:33%">Người lập hóa đơn</th>
                </tr>
            </thead>
            <tbody>
                <td style="text-align: center;"><br><br><br>--------------------------</td>
                <td style="text-align: center;"><br><br><br>--------------------------</td>
                <td style="text-align: center;"><br><br><h3>CH TNPHONE</h3></td>
            </tbody>
        </table>
    </section>
</body>

</html>