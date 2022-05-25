<?php

$db = new mysqli("localhost","root","","l_portal");
if($db -> connect_error)
{
    die("database not connected");
}

?>