<?php

require_once("../../common_files/php/database.php");
$id = $_POST['id'];
$changed_name =  $_POST['changed_name'];

$update_category_table = "UPDATE category SET category_name = '$changed_name' WHERE id = '$id'";
if($db -> query($update_category_table))
{
    echo "success";
}
else{
    echo "unable to change category name";
}
?>