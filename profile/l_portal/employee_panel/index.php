<?php
require_once("../common_files/databases/shop_mg.php");
session_start();
$username = $_SESSION['username'];
if(empty($username))
{
    header("Location:../../../index.html");
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
    <link rel="stylesheet" href="../common_files/css/bootstrap.min.css">
    <link rel="stylesheet" href="../common_files/css/animate.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../common_files/js/bootstrap.min.js"></script>
    <script src="../common_files/js/popper.min.js"></script>
    <title>Learning Portal</title>
    <style>
        /* branding scroll */
        .baranding-area::-webkit-scrollbar{
            width: 10px;

        }
        .baranding-area::-webkit-scrollbar-track{
            background-color: #ddd;
        }
        .baranding-area::-webkit-scrollbar-thumb{
            background-color: deeppink;
        }
        /* end branding area scroll */
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="side-bar">
            <button class="btn btn-success w-100 text-left stock-update-btn" style="font-size: 20px;">
                <i class="fa fa-shopping-cart"></i>
                ESM UPDATE
                <i class="fa fa-angle-down float-end mt-2"></i>
            </button>
            <ul class="collapse stock-update-btn-menu">
                <li class="border-left p-2 collapse-item active" access-link="create_category_design.php">Creat Semester</li>
                <li class="border-left p-2 collapse-item" access-link="create_brand_design.php">Creat Subject</li>
                <li class="border-left p-2 collapse-item" access-link="create_products_design.php">Upload Files</li>
            </ul>
        </div>
        <div class="page">
            
        </div>
    </div>
    <!-- start script link -->
    <script src="../common_files/js/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/display_subject.js"></script>
    <!-- end script link -->
    <!-- start textarea length count -->
</body>
</html>