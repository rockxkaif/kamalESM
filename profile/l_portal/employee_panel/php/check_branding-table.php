<?php
require_once("../../common_files/php/database.php");
$check_table = "SELECT id,brand_name,domain_name,email,facebook_url,twitter_url,address,phone,about_us,privacy_policy,cookies_policy,terms_policy FROM branding";
$response = $db -> query($check_table);
$all_data = [];
if($response)
{
    $data = $response -> fetch_assoc();
    array_push($all_data,$data);
    echo json_encode($all_data);
}
?>