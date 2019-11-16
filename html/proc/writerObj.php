<?php
    $config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/tempvuln/config.ini");
    $sqlconn = mysqli_connect($config['server'], $config['username'], $config['password'], $config['dbname']);
    if ($sqlconn === false){
        die('Connect fail ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
    }
    if ($sqlconn->connect_error) {
        die("connect error: ". $sqlconn->connect_error);
    }
?>
