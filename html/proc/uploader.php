<?php
    require_once('writerObj.php');
    if(!isset($_SESSION['username']) or ){
        
    }
    else{
        die("There was an issue contact your administrator");
    }

    $uname = filter_input(INPUT_POST, 'uname');
    $passcode = filter_input(INPUT_POST, 'weekpasswd');
    $fname =  $_FILES['upfile']['name'];
    $date = date("Y-m-d");
    $sqlconn;

?>
