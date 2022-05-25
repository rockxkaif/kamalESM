<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    require("database.php");
    $username = base64_decode($_POST['username']);
    $password = base64_decode($_POST['password']);

    $check_username = "SELECT username FROM users WHERE username = '$username'";
    $response = $db -> query($check_username);
    if($response -> num_rows != 0)
    {
        $cehck_password = "SELECT username,password FROM users WHERE username = '$username'
         AND password = '$password'";
        $response_password = $db -> query($cehck_password);
        if($response_password -> num_rows != 0)
        {
            $check_status = "SELECT status FROM users WHERE username = '$username' AND status = 'active'";
            $response_status = $db -> query($check_status);
            if($response_status -> num_rows != 0)
            {
                $check_user_type = "SELECT user_type FROM users WHERE username = '$username' AND user_type = 'admin'";
                $response_user_type = $db -> query($check_user_type);
                if($response_user_type -> num_rows != 0)
                {
                    echo "admin login";
                    session_start();
                    $_SESSION['username'] = $username;
                }
                else{
                    echo "user login";
                    session_start();
                    $_SESSION['username'] = $username;
                }

            }
            else{
                $check_admin = "SELECT user_type FROM users WHERE username = '$username' AND user_type = 'admin'";
                $response_admin = $db -> query($check_admin);
                if($response_admin -> num_rows != 0)
                {
                    
                /* echo "login pendding"; */
                $get_activation_code = "SELECT full_name,activation_code FROM users WHERE username = '$username'";
                $code_response = $db -> query($get_activation_code);
                $data = $code_response -> fetch_assoc();
                $activation_code = $data['activation_code'];
                $name = $data['full_name'];
                $header_information = "From:arishasheikh1924@gmail.com \r\nMIME-Version:1.0 \r\ncontent-Type:text/html;charset=ISO-8859-1 \r\n";
                /* $header_information = "From:mohdgulm22@gmail.com \r\nMIME-Version:1.0 \r\nContent-Type:text/html;charset=ISO-8859-1 \r\n"; */
                $message = "<html>
                <body style='background:red;padding:50px'>
                <center>
                <h1>Thank You : <span style='color:white'>".$name."</span></h1>
                <h3>Thank For Choosing Our Product </h3>
                <h3>Your Activation Code Is : <span style='color:white'>".$activation_code."</span></h3>
                <h3>Do'nt Share Your Activation Code !</span></h3>
                <h3>This is a website where you can create your business account and manage your all business with our web application.</span></h3>
                </center>
                </body>
                </html>";
                $check_mail = mail("arishasheikh1924@gmail.com","LEARNING PORTAL",$message,$header_information);
                if($check_mail)
                {
                    echo "login pending";
                }
                }
                else{
                    
                /* echo "login pendding"; */
                $get_activation_code = "SELECT full_name,activation_code FROM users WHERE username = '$username'";
                $code_response = $db -> query($get_activation_code);
                $data = $code_response -> fetch_assoc();
                $activation_code = $data['activation_code'];
                $name = $data['full_name'];
                $header_information = "From:arishasheikh1924@gmail.com \r\nMIME-Version:1.0 \r\ncontent-Type:text/html;charset=ISO-8859-1 \r\n";
                /* $header_information = "From:mohdgulm22@gmail.com \r\nMIME-Version:1.0 \r\nContent-Type:text/html;charset=ISO-8859-1 \r\n"; */
                $message = "<html>
                <body style='background:red;padding:50px'>
                <center>
                <h1>Thank You : <span style='color:white'>".$name."</span></h1>
                <h3>Thank For Choosing Our Product </h3>
                <h3>Your Activation Code Is : <span style='color:white'>".$activation_code."</span></h3>
                <h3>Do'nt Share Your Activation Code !</span></h3>
                <h3>This is a website where you can create your business account and manage your all business with our web application.</span></h3>
                </center>
                </body>
                </html>";
                $check_mail = mail($username,"LEARNING PORTAL",$message,$header_information);
                if($check_mail)
                {
                    echo "login pending";
                }
                }
            }
        }
        else{
            echo "wrong password";
        }
    }
    else{
        echo "wrong username please register first";
    }
}

?>