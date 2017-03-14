<?php

if(isset($_POST['site'])&&!empty($_POST["site"])){
    $site = $_POST['site'];
    echo "false%%".file_get_contents("$site");
}

if(isset($_POST['overlay'])&&!empty($_POST["overlay"])){
    $site = $_POST['overlay'];
    echo "true%%".file_get_contents("$site");
}

if(isset($_POST['rooster'])&&!empty($_POST["rooster"])){
    $data = explode("%%",$_POST['rooster']);
    $echo ="?site1=".$data[0]."&site2=".$data[1]."&vak=$data[2]";
    echo $echo;
    }
?>