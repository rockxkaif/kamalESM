<?php

    require_once("../../common_files/php/database.php");
    $jason_data = json_decode($_POST['json_data']);
    $length = count($jason_data);
    $message = "";
    $select_category_table = "SELECT * FROM category";
    if($db -> query($select_category_table))
    {
        for($i=0;$i<$length;$i++)
            {
                $store_data = "INSERT INTO category(category_name)values('$jason_data[$i]')";
                if($db -> query($store_data))
                {
                    if(mkdir("../../stocks/".$jason_data[$i]))
                    {
                        $message = "done";
                    }
                }
                else{
                    $message = "failed to inserted";
                }
            }
            echo $message;
    }
    else{
        $create_table = "CREATE TABLE category(

            id INT(11) NOT NULL AUTO_INCREMENT,
            category_name VARCHAR(50),
            PRIMARY KEY(id)

        )";
        if($db -> query($create_table))
        {
            /* echo "table created"; */
            for($i=0;$i<$length;$i++)
            {
                $store_data = "INSERT INTO category(category_name)values('$jason_data[$i]')";
                if($db -> query($store_data))
                {
                    if(mkdir("../../stocks/".$jason_data[$i]))
                    {
                        $message = "done";
                    }
                }
                else{
                    $message = "failed to inserted";
                }
            }
            echo $message;
        }
        else{
            echo "unable to create table";
        }
    }
?>