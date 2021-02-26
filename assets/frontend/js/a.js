// Lưu file
$(document).ready(function(){
    $("#searchIP").keyup(function(){
        var str = $(this).val();
        $.ajax({
            type: "POST",
            url: "/TNPhone/frontend/api/search-sanpham.php",
            data: {"search":str},
            success: function(data){
                $("#search-ajax").html(data);
            }
        });
    });
    $("#btnSearch").click(function(){
        var tensp = $("#searchIP").val();
        location.href="/TNPhone/frontend/layouts/sanpham.php?tensp="+tensp;
    });
    $("#searchIP").keypress(function(e){
        if(e.keyCode==13)
        $('#linkadd').click();
    });
})