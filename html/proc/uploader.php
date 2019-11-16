<?php
    require_once('writerObj.php');
    $uname = filter_input(INPUT_POST, 'uname');
    $passcode = filter_input(INPUT_POST, 'weekpasswd');
    $fname =  $_FILES['upfile']['name'];
    $date = date("Y-m-d");
    

?>
