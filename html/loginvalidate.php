<?php
	session_start();
	$config = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/../private/config.ini"); 	
	mysql_connect($config['serverread'], $config['usernameread'], $config['passwordread']) or DIE('Unable to connect to NAS, check if SQL server is enabled');
	mysql_select_db($config['dbnameread']) or DIE('Database is not available!');
	// query DB for username and password entery given by input. Note output from MD5 function passed as password:
	$login = mysql_query("SELECT * FROM users WHERE (email = '" . mysql_real_escape_string($_POST['username']) . "') and (password = '" . mysql_real_escape_string(md5($_POST['password'])) . "')");
	// Check username and password match
	if (mysql_num_rows($login) == 1) {
		// Set username session variable
		$_SESSION['username'] = $_POST['username'];
		//Go to secured page
		header('Location: videos.php');
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
