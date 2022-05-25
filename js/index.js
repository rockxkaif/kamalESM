$(document).ready(function () {
    $(".lock-icon").click(function(){
        if($(".password").attr("type") == "password" && $(".lock-icon").attr("title") == "show password")
        {
            $(this).attr("title","hide password");
            $(".password").attr("type","text");
            $(".lock-icon").addClass("fa fa-unlock");
            $(this).css("color","blue");
        }
        else{
            $(this).attr("title","show password");
            $(".password").attr("type","password");
            $(".lock-icon").removeClass("fa fa-unlock");
            $(".lock-icon").addClass("fa fa-lock");
            $(this).css("color","#2c2d2d");
        }
    });
});