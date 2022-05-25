<?php

require_once("../../common_files/php/database.php");
$id = $_POST['id'];

$delete_row = "DELETE FROM category WHERE id = '$id'";
if($db -> query($delete_row))
{
    echo "success";
}
else{
    echo "unabel to delete category name";
}

?>