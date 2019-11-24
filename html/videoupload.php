<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Video Uploader</title>
		<?php include("proc/head.php"); ?>
	</head>
	<body>
	<?php $headtext = "<h1>Video Uploader</h1>"; include("proc/header.php"); ?>
	
	<div class="vcenter text">
		<div class="vcenterholder center">
			<h1>Enter details of video</h1>
			<form action="proc/uploader.php" method="post">
				<p>Title: <input id="softfield" type="text" name="vidtitle" placeholder="catz" required>
                <br>
                <input type="textarea" id="description" name="description"
                <br>
                Select video file (mp4) to upload:
				<input type="file" name="upfile" id="upfile">
                OR Enter URL of video to download:
                <input type="text" name="downloadurl" id="downloadurl">
                <br>
				<input type="submit" value="Submit Video" name="submit">
                </p>
			</form>
		</div>
	</div>
	<footer>
</footer>
	</body>
</html>
