<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header('Location: login.php');
	}
?>
<html>
<head>
	<title>Login</title>
	<?php include("proc/head.php"); ?>
</head>
<body>
	<?php $headtext = "<h1>Videos</h1>"; include("proc/header.php"); ?>
	<div class="vcenter text">
		<div class="vcenterholder center">
			<h1>Movies</h1>
			<article class="video">
				<video width="320" height="240" controls>
					<source src="assets/movies/cloth_ball.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<p>Uploaded by: USERNAME</p>
			</article>
			<article class="video">
				<video width="320" height="240" controls>
					<source src="assets/movies/cloth_ball.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<p>Uploaded by: USERNAME</p>
			</article>
			<article class="video">
				<video width="320" height="240" controls>
					<source src="assets/movies/cloth_ball.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<p>Uploaded by: USERNAME</p>
			</article>
			<article class="video">
				<video width="320" height="240" controls>
					<source src="assets/movies/cloth_ball.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<p>Uploaded by: USERNAME</p>
			</article>
			<article class="video">
				<video width="320" height="240" controls>
					<source src="assets/movies/cloth_ball.mp4" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<p>Uploaded by: USERNAME</p>
			</article>
		</div>
	</div>
	</div>
<footer>
</footer>
</div>
</body>
</html>
 