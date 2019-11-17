<?php
session_start();
require_once('writerObj.php');
if (!isset($_SESSION['username'])) {
     die("You hafta login <meta http-equiv=\"Refresh\" content=\"2; url=/login.php\">");
}
$vidtitle = filter_input(INPUT_POST, 'videoHash');
$vidtitle = substr($vidtitle, 0, -1);
echo $vidtitle;

$getvideouid = "SELECT ownerid FROM videos WHERE titlehash='$vidtitle';";
$uidreturned = $sqlconn->query($getvideouid);
echo "<br>";
$uidarray = mysqli_fetch_assoc($uidreturned);
$viduid = $uidarray['ownerid'];
echo $viduid;

$fullpath = $_SERVER["DOCUMENT_ROOT"]. "/videos/".$viduid."/".$vidtitle;
echo $fullpath."<br>";


$getemail = "SELECT email FROM users WHERE user_id='$viduid';";
$emailreturned = $sqlconn->query($getemail);
$emailarray = mysqli_fetch_assoc($emailreturned);
$videmail = $emailarray['email'];
echo "<br>";
echo $videmail;

if($_SESSION['username'] == $videmail){
    $deletevid = "DELETE FROM videos WHERE titlehash='$vidtitle';";
    if($sqlconn->query($deletevid)){
        unlink($fullpath);
        echo "File Deleted <meta http-equiv=\"Refresh\" content=\"2; url=/videos.php\">";
    }
}


?>
