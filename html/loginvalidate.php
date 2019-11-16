<?php
	session_start();
    require_once('proc/writerObj.php');
    $stmt = mysqli_prepare($sqlconn, "SELECT password, user_id FROM users WHERE email=?");
    mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
    if(!$stmt->execute()){
        die("Error - Issue executing prepared statement: " . mysqli_error($sqlconn));
    }
    if($res = $stmt->get_result()){
        $row = $res->fetch_assoc();
        if(mysqli_num_rows($res) == 1) {
            if(md5($_POST['password']) === $row['password']){
                session_destroy();
                session_start();
                // Set username session variable
                $_SESSION['username'] = $_POST['username'];
                //Go to secured page
                header('Location: videos.php');
            }
        }
    }else{
        die("Error - Getting results: " . mysqli_error($sqlconn));
    }
?>
<meta http-equiv="Refresh" content="0; url=http://localhost/login.php" />