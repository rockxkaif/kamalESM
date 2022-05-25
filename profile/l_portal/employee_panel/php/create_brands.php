<?php

require_once("../../common_files/php/database.php");

$category = $_POST['category'];
$json_data = json_decode($_POST['json_data']);
$length = count($json_data);
$message;
$select_brand = "SELECT * FROM brands";
$response = $db -> query($select_brand);
if($response)
{
    for($i=0; $i<$length; $i++)
    {
        $store_data = "INSERT INTO brands(category_name,brands)
        VALUES('$category','$json_data[$i]')
        ";
        if($db -> query($store_data))
        {
            if(mkdir("../../stocks/".$category."/".$json_data[$i]))
            {
                $message = "done";
            }
        }
        else{
            $message = "<b>unable to store data in brands table</b>";
        }
    }
    echo $message;
}
else{

    $create_table = "CREATE TABLE brands(
        id INT(11) NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(50),
        brands VARCHAR(50),
        PRIMARY KEY(id)
    )";
    $response = $db -> query($create_table);
    if($response)
    {
        for($i=0; $i<$length; $i++)
        {
            $store_data = "INSERT INTO brands(category_name,brands)
            VALUES('$category','$json_data[$i]')
            ";
            if($db -> query($store_data))
            {
                if(mkdir("../../stocks/".$category."/".$json_data[$i]))
                {
                    $message = "done";
                }
            }
            else{
                $message = "<b>unable to store data in brands table</b>";
            }
        }
        echo $message;
    }
    else{
        echo "<b>unable to create brands</b>";
    }

}
?>