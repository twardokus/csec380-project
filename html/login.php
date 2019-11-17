<html>
<head>
	<title>Login</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php include("proc/head.php"); ?>
</head>
<body>
	<?php $headtext = "<h1>CSEC 380 Final Auth Page</h1>"; include("proc/header.php"); ?>
	<div class="vcenter text">
		<div class="vcenterholder center">
			<h1>Login</h1>
			<form method="POST" action="loginvalidate.php">
				<p>Username: <input id="softfield" type="text" name="username" size="20"><br>
				Password: <input id="softfield" type="password" name="password" size="20"><br>
				(Cookies in use) <br>
				<input id="loginbtn" type="submit" value="Login">
				</p>
			</form>
		</div>
	</div>
	</div>
<footer>
</footer>
</div>
</body>
</html>
 
