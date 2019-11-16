<?php

  require_once('recaptchalib.php');
  $privatekey = "6Le_F8MUAAAAAKDvC0PXwY7MI5E-vNwp0Dgh9giK";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
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
}
?>
<meta http-equiv="Refresh" content="0; url=http://localhost/login.php" />
