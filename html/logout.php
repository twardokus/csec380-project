<?php
    session_start();
    session_unset();
    session_destroy();
    session_start();
	header('Location: /index.php');
?>
