$(document).ready(function () {
    $("#email").on("change",function(){
        var email = $(this).val();
        if(email != "")
        {
            $.ajax({
                type: "POST",
                url: "php/check_user.php",
                data: {
                    email : email,
                },
                beforeSend : function()
                {
                    $(".email-loader").removeClass("d-none");
                    $(".envelope").addClass("d-none");

                },
                success: function (response) {
                    if(response.trim() == "user match")
                    {
                        $(".email-loader").removeClass("fa fa-circle-o-notch fa-spin");
                        $(".email-loader").removeClass("fa fa-check-circle text-primary");
                        $(".email-loader").addClass("fa fa-times-circle text-warning");
                        $(".btn-register").attr("disabled","disabled");
                    }
                    else{
                        $(".email-loader").removeClass("fa fa-circle-o-notch fa-spin text-warning");
                        $(".email-loader").addClass("fa fa-check-circle text-primary");
                        $(".btn-register").removeAttr("disabled");
                    }
                }
            });
        }
        else{
            swal({
                text : "Please fill all the fields",
                icon : "warning",
            });
        }
    });
});