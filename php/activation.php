<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require("database.php");
    $code = base64_decode($_POST['code']);
    $username = base64_decode($_POST['username']);
    $check_code = "SELECT activation_code FROM users WHERE username = '$username' AND activation_code = '$code'";
    $response = $db -> query($check_code);
    if($response -> num_rows != 0)
    {
        /* echo "activation code match"; */
        $update_status = "UPDATE users SET status = 'active' WHERE username = '$username' AND activation_code = '$code'";
        if($db -> query($update_status))
        {
            $check_user = "SELECT user_type FROM users WHERE username = '$username' AND user_type = 'admin'";
            $response_user = $db -> query($check_user);
                if($response_user -> num_rows != 0)
                {
                    echo "admin login";
                }
                else{
                    echo "user login";
                }
        }
        else{
            echo "user not verified";
        }
    } 
    else{
        echo "activation code not match";
    }
}

?>