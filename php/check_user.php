<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require("database.php");
    $email = $_POST['email'];
    $check_user = "SELECT username FROM users WHERE username = '$email'";
    $response = $db -> query($check_user);
    if($response -> num_rows != 0)
    {
        echo "user match";
    }
    else{
        echo "user not match";
    }
}

?>