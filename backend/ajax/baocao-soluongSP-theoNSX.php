  
<?php

include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlquantitySanPham = <<<EOT
    SELECT nsx_ten,COUNT(*) AS soluongSP
    FROM sanpham sp JOIN nhasanxuat nsx
    ON sp.nsx_ma = nsx.nsx_ma
    GROUP BY nsx_ten
EOT;

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlquantitySanPham);

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $dataquantitySanPham[] = array(
        'nsx_ten' => $row['nsx_ten'],
        'soluongSP' => $row['soluongSP']
    );
}

echo json_encode($dataquantitySanPham);

?>