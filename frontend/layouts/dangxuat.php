<?php
    if(isset($_COOKIE['kh_tendangnhap'])){
        setcookie('kh_tendangnhap','',time()-320,"/");
        unset($_COOKIE['kh_tendangnhap']);
    }
    header("Location: /TNPhone/frontend")
?>