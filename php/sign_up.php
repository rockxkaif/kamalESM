<?php
require("database.php");
$name = base64_decode($_POST['name']);
$number = base64_decode($_POST['number']);
$username = base64_decode($_POST['email']);
$password = base64_decode($_POST['password']);
$signup_choose = base64_decode($_POST['signup_choose']);
$i;
$code = [];

for($i=0; $i<6; $i++)
{
   $code [] = rand(0,9);
}
$activation_code = implode($code);
$header_information = "From:arishasheikh1924@gmail.com \r\nMIME-Version:1.0 \r\ncontent-Type:text/html;charset=ISO-8859-1 \r\n";
  /* $header_information = "From:mohdgulm22@gmail.com \r\nMIME-Version:1.0 \r\nContent-Type:text/html;charset=ISO-8859-1 \r\n"; */
  $message = "<html>
  <body style='background:red;padding:50px'>
  <center>
  <h1>Thank You : <span style='color:white'>".$name."</span></h1>
  <h3>Thank For Choosing Our Website </h3>
  <h3>Your Activation Code Is : <span style='color:white'>".$activation_code."</span></h3>
  <h3>Do'nt Share Your Activation Code !</span></h3>
  <h3>This is a website where you will be supported and guided and will be provided your best resourse needs.</span></h3>
  </center>
  </body>
  </html>";
if($signup_choose == "admin")
{
    $check_email = mail("arishasheikh1924@gmail.com","LEARNING PORTAL",$message,$header_information);
    if($check_email)
    {
        $insert_data = "INSERT INTO users(full_name,username,password,number,activation_code,user_type) VALUES('$name','$username','$password','$number','$activation_code','$signup_choose')";
        if($db -> query($insert_data))
        {
            echo "success";
        }
        else{
            echo "unable to insert";
        }
    }
    else{
        echo "unable to send activation code";
    }
}
else{
    $check_email = mail($username,"LEARNING PORTAL",$message,$header_information);
if($check_email)
{
    $insert_data = "INSERT INTO users(full_name,username,password,number,activation_code,user_type) VALUES('$name','$username','$password','$number','$activation_code','$signup_choose')";
    if($db -> query($insert_data))
    {
        echo "success";
    }
    else{
        echo "unable to insert";
    }
}
else{
    echo "unable to send activation code";
}
}
?>