<?php
    $str_search = $_POST['search'];
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSearch = <<<EOT
    SELECT sp_ma, sp_ten, sp_gia,sp_hinhdaidien
        FROM sanpham sp
        WHERE sp_ten LIKE '%$str_search%'
        GROUP BY sp_ma
        LIMIT 5
    EOT;

    $result = mysqli_query($conn,$sqlSearch);

    $ds_sanpham=[];
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $ds_sanpham[] = array(
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'sp_hinhdaidien' => $row['sp_hinhdaidien']
        );
    }

    foreach($ds_sanpham as $sp){
        echo "<li><a href='/TNPhone/frontend/layouts/chitietsp.php?sp_ma=".$sp['sp_ma']."'>";
        if($sp['sp_hinhdaidien']!= ''){
            echo "<img src='/TNPhone/assets/uploads/products/".$sp['sp_hinhdaidien']."'>";
        }else
            echo "<img src='/TNPhone/shared/default-image.jpg'>";
        echo "<h6>".$sp['sp_ten']."</h6>";
        echo "<span class='giasp'>".number_format($sp['sp_gia'],0,".",",")." VNĐ</span>";
        echo "</li>";
    }

?>