
<?php

require_once("../../common_files/php/database.php");
$brands = $_POST['brands'];
$dir = "";
$message = "";
// get category name
$get_cat_name = "SELECT category_name FROM brands WHERE brands = '$brands'";
$response = $db -> query($get_cat_name);
if($response)
{
    $data = $response -> fetch_assoc();
}
// end get category name
$all_files = [$_FILES['thumb'],$_FILES['front'],$_FILES['top'],$_FILES['bottom'],$_FILES['left'],$_FILES['right']];
$file_path = ['thumb_pic','front_pic','top_pic','bottom_pic','left_pic','right_pic'];
$length = count($all_files);
$check_dir = is_dir("../../stocks/".$data['category_name']."/".$brands."/");
if($check_dir)
{
    echo "product already exist";
}
else{
    $dir = mkdir("../../stocks/".$data['category_name']."/".$brands."/");
}
$select_data = "SELECT * FROM products";
$response = $db -> query($select_data);
if($response)
{
    $store_data = "INSERT INTO products(brands) VALUES('$brands')";
    $response = $db -> query($store_data);
    if($response)
    {
        /* echo "success"; */
        $current_id = $db -> insert_id;
    if($dir)
    {
        for($i=0; $i<$length; $i++)
        {
            $file = $all_files[$i];
            $filename = $file['name'];
            $location = $file['tmp_name'];
            $current_url = "stocks/".$data['category_name']."/".$brands."/".$filename;
            if(move_uploaded_file($location,"../../stocks/".$data['category_name']."/".$brands."/".$filename))
            {
                $update_path = "UPDATE products SET $file_path[$i] = '$current_url' WHERE id = '$current_id'";
                $response = $db ->query($update_path);
                if($response)
                {
                    $message = "success";
                }
                else{
                    $message = "unable to update file path";
                }
            }
        }
        echo $message;

    }
    }
    else{
        echo "unable to storte data in products table";
    }
}
else{
    $create_table = "CREATE TABLE products(
        
        id INT(11) NOT NULL AUTO_INCREMENT,
        thumb_pic VARCHAR(100),
        front_pic VARCHAR(100),
        top_pic VARCHAR(100),
        bottom_pic VARCHAR(100),
        left_pic VARCHAR(100),
        right_pic VARCHAR(100),
        PRIMARY KEY(id)

    )";

    $response = $db -> query($create_table);
    if($response)
    {
        $store_data = "INSERT INTO products(brands) VALUES('$brands')";
        $response = $db -> query($store_data);
        if($response)
        {
            /* echo "success"; */
            $current_id = $db -> insert_id;
        if($dir)
        {
            for($i=0; $i<$length; $i++)
            {
                $file = $all_files[$i];
                $filename = $file['name'];
                $location = $file['tmp_name'];
                $current_url = "stocks/".$data['category_name']."/".$brands."/".$filename;
                if(move_uploaded_file($location,"../../stocks/".$data['category_name']."/".$brands."/".$filename))
                {
                    $update_path = "UPDATE products SET $file_path[$i] = '$current_url' WHERE id = '$current_id'";
                    $response = $db ->query($update_path);
                    if($response)
                    {
                        $message = "success";
                    }
                    else{
                        $message = "unable to update file path";
                    }
                }
            }
            echo $message;
    
        }
        }
        else{
            echo "unable to storte data in products table";
        }
    }
    else{
        echo "unable to create products table";
    }
}

?>