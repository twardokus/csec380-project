<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header('Location: login.php');
	}
    require_once('proc/writerObj.php');
?>
<html>
<head>
	<title>Videos</title>
	<?php include("proc/head.php"); ?>
</head>
<body>
	<?php $headtext = "<h1>Videos</h1>"; include("proc/header.php"); ?>
    <div class=" text">
    <div class=" center">
        <?php
            $getvideos = "SELECT * FROM videos;";
            $returnedvids = $sqlconn->query($getvideos);
//            print_r($returnedvids);
            $videos = array();
            while ($row = mysqli_fetch_assoc($returnedvids)) {
                $videos[] = $row;
            }
//            print_r($videos);
            foreach($videos as $value){
                $getemail = "SELECT email FROM users WHERE user_id='".$value['ownerid']."';";
                $emailreturned = $sqlconn->query($getemail);
                $theuploader = mysqli_fetch_assoc($emailreturned);
                $uploaderEmail = $theuploader['email'];
                $title = $value['title'];
                echo "<article class=\"video\"><video width=\"320\" height=\"240\" controls><source src=\"/videos/". $value['ownerid'] ."/". $value['titlehash']."\" type=\"video/mp4\">Your browser does not support the video tag.</video><p>Title: " . $title . "<br>Uploaded by: ". $uploaderEmail."</p>";
                if($_SESSION['username'] == $uploaderEmail){
                    echo "<form action=\"proc/deletevideo.php\" method=\"post\"><input type=\"hidden\" id=\"videoHash\" name=\"videoHash\" value=". $value['titlehash'] ."/><input type=\"submit\" name=\"deletevid\" value=\"Delete Video\" /></form>";
                }
                echo "</article>";
            }
        ?>
		</div>
	</div>
	</div>
<footer>
</footer>
</div>
</body>
</html>
 
