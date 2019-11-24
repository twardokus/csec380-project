<!DOCTYPE HTML>
<html>
	<head>
		<title>PHP Info</title>
		<?php include("proc/head.php"); ?>
	</head>
	<body>
	<?php echo get_current_user() ."<br>";echo exec('whoami'); ?>
	</body>
</html>
