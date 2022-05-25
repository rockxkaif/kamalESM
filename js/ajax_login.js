$(document).ready(function () {
    $(".login-form").on("submit",function(e){
        e.preventDefault();
        var username =  btoa($("#login-username").val());
        var password = btoa($("#login-password").val());
        $.ajax({
            type: "POST",
            url: "php/login.php",
            data: {username:username,password:password},
            beforeSend : function()
            {
                $(".login-btn").html("please wait...");
                $(".login-btn").attr("disabled","disabled");
            },
            success: function (response) {
                if(response.trim() == "admin login")
                {   
                    $(".login-btn").html("Login Now");
                    $(".login-btn").removeAttr("disabled");
                    window.location = "profile/l_portal/employee_panel/index.php";
                }
                else if(response.trim() == "user login")
                {
                    $(".login-btn").html("Login Now");
                    $(".login-btn").removeAttr("disabled");
                    window.location = "profile/l_portal/index.php";
                }
                else if(response.trim() == "login pending")
                {
                    $(".login-form").fadeOut(500,function(){
                        $(".login-verification-form").removeClass("d-none");
                    });
                    $(".login-verification-form").on("submit",function(e){
                        e.preventDefault();
                        var code = btoa($("#login-code").val());
                        $.ajax({
                            type: "POST",
                            url: "php/activation.php",
                            data: {
                                code:code,
                                username:username
                            },
                            success: function (response) {
                                if(response.trim() == "admin login")
                                {
                                    window.location = "profile/l_portal/employee_panel/index.php";
                                }
                                else if(response.trim() == "user login")
                                {
                                    window.location = "profile/l_portal/index.php";
                                }
                                else{
                                    swal({
                                        text : response,
                                        icon : "warning",
                                    });
                                }
                            }
                        });
                    });
                }
                else{
                    $(".login-btn").html("Login Now");
                    $(".login-btn").removeAttr("disabled");
                    swal({
                        text : response,
                        icon : "warning",
                    });
                }
            }
        });
    });
});