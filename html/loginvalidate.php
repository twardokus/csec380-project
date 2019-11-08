<?php
	session_start();
	$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/tempvuln/config.ini");
    $sqlconn = mysqli_connect($config['server'], $config['username'], $config['password'], $config['dbname']);
    if ($sqlconn === false){
        die('Connect fail ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
    }
    if ($sqlconn->connect_error) {
        die("connect error: ". $sqlconn->connect_error);
    }
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
<html>
	<head>
		<title>Bad Login</title>
	</head>
	<body>
		<p>
		Bad credentials!
		</b>
		<br>
		Retry: <a href="login.php">login</a> </p>
	</body>
</html>