<?php

/* $string = base64_encode(file_get_contents($file_location));
$complete_src = "data:image/png;base64,".$string;
echo "<img src='".$complete_src."'>"; */
require_once("../../common_files/php/database.php");
$brand_name = $_POST['brand-name'];
$file = $_FILES['brand-logo'];
$logo = "";
$location = "";
if($file['name'] == "")
{
    $logo = "";
    $location = "";
}
else{
    $file_location = $file['tmp_name'];
    $logo = addslashes(file_get_contents($file_location));
}
$domain_name = $_POST['domain-name'];
$email = $_POST['email'];
$facebook_url = $_POST['facebook-url'];
$twitter_url = $_POST['twitter-url'];
$address = addslashes($_POST['address']);
$phone = $_POST['phone'];
$about_us = addslashes($_POST['about-us']);
$privacy_policy = addslashes($_POST['privacy-policy']);
$cookies = addslashes($_POST['cookies']);
$terms = addslashes( $_POST['terms-condition']);

$check_branding_table =  "SELECT * FROM branding";
$response = $db -> query($check_branding_table);
if($response)
{
    /* echo "table found"; */
        if($logo == "")
        {
            $update_data = "UPDATE branding SET brand_name = '$brand_name',brand_logo = '$logo', email = '$email', domain_name = '$domain_name', facebook_url = '$facebook_url', twitter_url = '$twitter_url', address = '$address', phone = '$phone', about_us = '$about_us', privacy_policy = '$privacy_policy', cookies_policy = '$cookies', terms_policy = '$terms'";
            $response = $db -> query($update_data);
            if($response)
            {
                echo "edit success";
            }
            else{
                echo "edit failed";
            }
        }
        else{
            $update_data = "UPDATE branding SET brand_name = '$brand_name',brand_logo = '$logo', email = '$email', domain_name = '$domain_name', facebook_url = '$facebook_url', twitter_url = '$twitter_url', address = '$address', phone = '$phone', about_us = '$about_us', privacy_policy = '$privacy_policy', cookies_policy = '$cookies', terms_policy = '$terms'";
            $response = $db -> query($update_data);
            if($response)
            {
                echo "edit success";
            }
            else{
                echo "edit failed";
            }
        }
        /* $store_data = "INSERT INTO branding(brand_name,brand_logo,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy_policy,cookies_policy,terms_policy)
        VALUES('$brand_name','$logo','$domain_name','$email','$facebook_url','$twitter_url','$address','$phone','$about_us','$privacy_policy','$cookies','$terms')";
            $response = $db -> query($store_data);
            if($response)
            {
                echo "data inserted success";
            }
            else{
                echo "unable to store data";
            } */
}
else{
    $create_branding_table = "CREATE TABLE branding(
        id INT(11) NOT NULL AUTO_INCREMENT,
        brand_name VARCHAR(50),
        brand_logo MEDIUMBLOB,
        domain_name VARCHAR(180),
        email VARCHAR(100),
        facebook_url VARCHAR(255),
        twitter_url VARCHAR(255),
        address VARCHAR(100),
        phone INT(12),
        about_us MEDIUMTEXT,
        privacy_policy MEDIUMTEXT,
        cookies_policy MEDIUMTEXT,
        terms_policy MEDIUMTEXT,
        PRIMARY KEY(id) 
    )";
    $response = $db -> query($create_branding_table);
    if($response)
    {
        /* echo "table created"; */
        $store_data = "INSERT INTO branding(brand_name,brand_logo,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy_policy,cookies_policy,terms_policy)VALUES('$brand_name','$logo','$domain_name','$email','$facebook_url','$twitter_url','$address','$phone','$about_us','$privacy_policy','$cookies','$terms')";
            $response = $db -> query($store_data);
            if($response)
            {
                echo "data inserted success";
            }
            else{
                echo "unable to store data";
            }
    }
    else{
        echo "table not created";
    }
}
?>