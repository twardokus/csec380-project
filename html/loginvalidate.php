<?php
    session_start();
    require_once('proc/writerObj.php');
    $stmt = "SELECT user_id FROM users WHERE email='". $_POST['username'] ."' and password='".md5($_POST['password'])."';";
    $output = mysqli_query($sqlconn,$stmt);
    if(!$output){
        die("Error - Issue executing prepared statement: " . mysqli_error($sqlconn));
    }
    
    if($res = $output->get_result()){
        $row = $res->fetch_assoc();
        if($row){
            session_destroy();
            session_start();
            // Set username session variable
            $_SESSION['username'] = $_POST['username'];
            //Go to secured page
            header('Location: videos.php');
        }
    }else{
        die("Error - Getting results: " . mysqli_error($sqlconn));
    }

?>
<html>
    <head>
        <title>Bad Login</title>
    </head>
    <body>
        <p>
        <?php echo "Bad credentials for user:" . $_POST['username'] ; ?>
        </b>
        <br>
        Retry: <a href="login.php">login</a> </p>
    </body>
</html>
