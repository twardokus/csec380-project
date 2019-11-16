<?php
session_start();
$uploaded = 0;
$date = date("Y-m-d");
$vidtitle = filter_input(INPUT_POST, 'vidtitle');
require_once('writerObj.php');
//echo var_dump($_SESSION);
if(isset($_SESSION['username'])){
    if(isset($_FILES['upfile']) && $_FILES['upfile']['size'] > 0 && isset($_POST['downloadurl']) && strlen($_POST['downloadurl']) > 0){
        die("Choose one please <meta http-equiv=\"Refresh\" content=\"2; url=/videoupload.php\">");
    }
    $getuid = "SELECT user_id FROM users WHERE email='".$_SESSION['username']."';";
    $uidreturned = $sqlconn->query($getuid);
    $uidinfo = mysqli_fetch_assoc($uidreturned);
    $uid = $uidinfo['user_id'];
    $path = $_SERVER["DOCUMENT_ROOT"]. "/videos/" . $uid ."/";
    if(isset($_FILES['upfile']) && $_FILES['upfile']['size'] > 0){
        try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if(!isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error'])){
                throw new RuntimeException('Invalid parameters.');
            }
            
            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // Again checking file size
            if ($_FILES['upfile']['size'] > 10000000) {
                throw new RuntimeException('Exceeded filesize limit (10mb).');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['upfile']['tmp_name']),
                array(
                    'mp4' => 'video/mp4',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }

            $filename = sprintf('%s.%s', sha1(time()),$ext);
            if(is_dir($path) == false){
                mkdir($path);
            }
            #echo "Info ". $filename;
            $datastorage = $path . $filename;
            //if (file_exists ( $datastorage) == true){
            //    echo('');
            //}
            #echo "Info ". $datastorage;
            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $_FILES['upfile']['tmp_name'],
                "$datastorage"
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
            $uploaded=1;
            
            // Remove, this will be bad
//            echo 'File: '. $_FILES['upfile']['name'] .' is uploaded successfully.';
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }

    }
    if(isset($_POST['downloadurl']) && strlen($_POST['downloadurl']) > 0){
        $filevURL = file_get_contents($_POST['downloadurl']);
        $upfileinfo = pathinfo($_POST['downloadurl']);
        //print_r( pathinfo($_POST['downloadurl']));
        if($upfileinfo['extension'] != 'mp4'){
            die("Must upload mp4 video. <meta http-equiv=\"Refresh\" content=\"2; url=/videoupload.php\">");
        }
        $filename = sprintf('%s.%s', sha1(time()),$upfileinfo['extension']);
        if(is_dir($path) == false){
            mkdir($path);
        }
        $datastorage = $path . $filename;
        if (!file_put_contents($datastorage, $filevURL)) {
            throw new RuntimeException('Failed to move file uploaded via URL.');
        }
        $uploaded=1;
    }
    if($uploaded == 1){
        $filecheck = "SELECT titlehash FROM videos WHERE titlehash='$filename';";
        $checked=$sqlconn->query($filecheck);
        $again = mysqli_fetch_assoc($checked);
        #echo "THIS: ". $again['uniquefn'];
        #echo "THIS AGAIN: ". strcmp($again['uniquefn'], $filename);
        if(strcmp($again['titlehash'], $filename) != 0){
            $sqlfile = "INSERT INTO videos (ownerid, title, titlehash, timestamp) VALUES ('$uid', '$vidtitle', '$filename', '$date')";
            if ($sqlconn->query($sqlfile)){
                echo " File data uploaded to DB sucessfully. <meta http-equiv=\"Refresh\" content=\"2; url=/videoupload.php\">";
            }
            else{
                echo "Error: ". $sqlfile ."
                ". $writeconn->error."";
            }
        }
    }
}
else {
    echo "Bad session";
}
?>
