<?php
    require_once("../../common_files/php/database.php");
   $brands = $_POST['brands'];
   $pdf = $_FILES['pdf'];
   $location = $pdf['tmp_name'];
   $filename = $pdf['name'];
   $message = "";
   // get category name
    $get_cat_name = "SELECT category_name FROM brands WHERE brands = '$brands'";
    $response = $db -> query($get_cat_name);
    if($response)
    {
        $data = $response -> fetch_assoc();
    }
    else{
        echo "unable to get data";
    }
    $check_dir = is_dir("../../stocks/".$data['category_name']."/".$brands."/");
    if($check_dir)
    {
        $file_move = move_uploaded_file($location,"../../stocks/".$data['category_name']."/".$brands."/".$filename);
        if($file_move)
        {
            $message = "success";
            echo $message;
        }
        else{
            echo "unable to upload file";
        }
    }
    else{
        $dir = mkdir("../../stocks/".$data['category_name']."/".$brands."/");
    }
    // end get category name
?>