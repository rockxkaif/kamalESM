$(document).ready(function () {
    $(".btn-register").click(function(e){
        e.preventDefault();
        var name = btoa($("#name").val());
        var number = btoa($("#number").val());
        var email = btoa($("#email").val());
        var password = btoa($("#password").val());
        var signup_choose = btoa($("#singup-choose").val());
        if(name != "" && number != "" && email != "" && password != "")
        {
            if($("#singup-choose").val() != "Choose Type")
            {
                $.ajax({
                    type : "POST",
                    url : "php/sign_up.php",
                    data : {
                        name : name,
                        number : number,
                        email : email,
                        password : password,
                        signup_choose : signup_choose
                    },
                    catch : false,
                    beforeSend : function()
                    {
                        $(".btn-register").html("Proccessing please wait...");
                        $(".btn-register").attr("disabled","disabled");
                    },
                    success : function (response) { 
                        if(response.trim() == "success")
                        {
                            $(".signup-form").fadeOut(500,function(){
                            $(".signup-verification-form").removeClass("d-none");
                            });
                        }
                        else{
                            $(".btn-register").html("Register Now");
                            $(".btn-register").removeAttr("disabled");
                            swal({
                                text : response,
                                icon : "warning",
                            });
                        }
                     }
                });
            }
            else{
                swal({
                    text : "Please choose user type",
                    icon : "warning",
                });
            }
        }
        else{
            swal({
                text : "Please fill all the fields",
                icon : "warning",
            });
        }
    });
});