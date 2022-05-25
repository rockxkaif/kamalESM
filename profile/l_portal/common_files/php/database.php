<?php
    $db = new mysqli("localhost","root","","l_portal");
    if($db -> connect_error)
    {
        echo "database not connected";
    }
?>