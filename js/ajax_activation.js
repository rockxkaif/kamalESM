$(document).ready(function () {
    $(".signup-verify-btn").click(function(e){
        e.preventDefault();
        var name = $("#name").val();
        var code = btoa($("#signup-code").val());
        var username = btoa($("#email").val());
        $.ajax({
            type: "POST",
            url: "php/activation.php",
            data: {
                code : code,
                username : username,
            },
            beforeSend : function()
            {
                $(".signup-verify-btn").html("Proccessing please wait...");
                $(".signup-verify-btn").attr("disabled","disabled");
            },
            success: function (response) {
                if(response.trim() == "admin login")
                {
                    $(".signup-verify-btn").html("Verify Now");
                    $(".signup-verify-btn").removeAttr("disabled");
                    swal("Thank You!", name+" you are verified successfully!", "success");
                    var close_btn = document.getElementById("btn-close");
                    close_btn.click();
                }
                else if(response.trim() == "user login")
                {
                    $(".signup-verify-btn").html("Verify Now");
                    $(".signup-verify-btn").removeAttr("disabled");
                    swal("Thank You!", name+" you are verified successfully!", "success");
                    var close_btn = document.getElementById("btn-close");
                    close_btn.click();
                }
                else{
                    $(".signup-verify-btn").html("Verify Now");
                    $(".signup-verify-btn").removeAttr("disabled");
                    swal({
                        text : response,
                        icon : "warning",
                    });
                }
            }
        });
    });
});