<?php
require_once("common_files/databases/shop_mg.php");
session_start();
$username = $_SESSION['username'];
if(empty($username))
{
    header("Location:../../index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="common_files/css/bootstrap.min.css">
    <link rel="stylesheet" href="common_files/css/animate.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="common_files/js/bootstrap.min.js"></script>
    <script src="common_files/js/popper.min.js"></script>
    <title> Course Welcome Portal </title>
</head>
<body class="bg-light">
    <?php
    
    include_once("assest/nav.php");

    ?>
    <?php
    include_once("assest/search_body.php");
    ?>
    <div class="container-fluid shadow-lg border p-4 all-pdf d-none" style="width:96%">  
        
    </div>
    <!-- start script link -->
    <script src="common_files/js/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <!-- end script link -->
    <script>
        $(document).ready(function () {
            $(".display-subject").on("change",function(){
                        var slected_cat_name = $(this).val();
                        $.ajax({
                            type: "POST",
                            url: "employee_panel/php/display_subject.php",
                            data: {
                                category_name : slected_cat_name
                            },
                            beforeSend : function()
                            {
                                $(".display-subject-loader").removeClass("d-none");
                            },
                            success: function (response) {
                                if(response.trim() != "<b>no subject has been created yet in this semester</b>")
                                {
                                    $(".btn-search").removeAttr("disabled");
                                    $(".brands-list").removeClass("d-none");
                                    var select = document.createElement("SELECT");
                                    select.name = "brands";
                                    select.required = "required";
                                    select.className = "form-select brands-name";
                                /* console.log(response); */
                                var json_data = JSON.parse(response);
                                var i;
                                for(i=0; i<json_data.length; i++)
                                {
                                    var option = document.createElement("OPTION");
                                    option.innerHTML = json_data[i].brands;
                                    select.append(option);
                                    $(".brands-list").html(select);
                                }
                                $(".display-subject-loader").addClass("d-none");
                                }
                            else{
                                $(".all-pdf").addClass("d-none");
                                $(".btn-search").attr("disabled","disabled");
                                $(".brands-list").removeClass("d-none");
                                $(".brands-list").html(response);
                                $(".brands-list").css("color","red");
                            }
                        }
                        });
                    });
        });
        
        $(document).ready(function () {
            $(".btn-search").click(function(e){
                e.preventDefault();
                var semester_name = $(".display-subject").val();
                var subject_name = $(".brands-name").val();
                $.ajax({
                    type: "POSt",
                    url: "php/get_pdf.php",
                    data: {
                        semester_name : semester_name,
                        subject_name : subject_name
                    },
                    cache : false,
                    xhr : function()
                    {
                        var request = new XMLHttpRequest();
                        request.upload.onprogress = function(e)
                        {
                            var percentage = Math.floor((e.loaded*100/e.total));
                            $(".create-subject-progress .progress-bar").css({
                                width : percentage+"%",
                            });
                            $(".create-subject-progress .progress-bar").html(percentage+"%");
                        };
                        return request;
                    },
                    beforeSend : function()
                    {
                        $(".create-products-progress").removeClass("d-none");
                        $(".btn-search").html("Uploading PDF wait...");
                        $(".btn-search").attr("disabled","disabled");
                        $(".all-pdf").addClass("d-none");
                    },
                    success: function (response) {
                        $(".all-pdf").removeClass("d-none");
                        $(".all-pdf").html(response);
                        $(".btn-search").html("Search");
                        $(".btn-search").removeAttr("disabled");
                    }
                });
            });
        });
    </script>
</body>
</html>