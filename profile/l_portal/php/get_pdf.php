<?php
$semester_name = $_POST['semester_name'];
$subjecct_name = $_POST['subject_name'];
$array = scandir("../stocks/".$semester_name."/".$subjecct_name."/");
$length = count($array);
    if($length != 2)
    {
        for($i=2;$i<$length;$i++)
        {
        $link = "stocks/".$semester_name."/".$subjecct_name."/".$array[$i];
        echo "<a href='".$link."' download='".$array[$i]."' title='Click to download pdf'>".$array[$i]."</a>&nbsp &nbsp";
        }
    }
    else{
        echo "<b style='color:red'>no pdf uploaded yet in this subject</b>";
    }
?>