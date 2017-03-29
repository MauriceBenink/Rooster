<?php

if(isset($_POST['site'])&&!empty($_POST["site"])){
    $holder = explode('%&%',$_POST['site']);
    $site = file_get_contents("$holder[0]");
    $site2 = file_get_contents("$holder[1]");
    if(isset($site)&&!empty($site)&&isset($site2)&&!empty($site2)){
        echo "false%%".$site.'%&%&'.$site2;
    }
}

if(isset($_POST['rooster'])&&!empty($_POST["rooster"])){
    $data = explode("%%",$_POST['rooster']);
    $echo ="?site1=".$data[0]."&site2=".$data[1]."&vak=$data[2]";
    echo $echo;
    }
?>