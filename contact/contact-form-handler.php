
<?php

function debug($data)
{

    if (is_array($data))
        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
    $secret  = "6LdiEQwTAAAAAGnFT-R2p73n25kyMF--rKDVklB4";
    $ip      = $_SERVER['REMOTE_ADDRESS'];
    $captcha = $_POST['g-recaptcha-response'];
    $rsp     = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");

    $arr = json_decode($rsp, TRUE);
    if ($arr['success']) {
        echo 'You are not a robot';
        sendMail();
    } else {
        echo 'You are a robot, message not sent';
    }
}
function sendMail()
{
    if (isset($_POST["cd-email"])) {
        $recipient     = "diyang_shi@brown.edu";
        $subject       = "You have received a new message from your site.";
        $sender        = $_POST["cd-name"];
        $senderEmail   = $_POST["cd-email"];
        $senderCompany = $_POST["cd-company"];
        $message       = $_POST["cd-textarea"];
        $aReasons      = $_POST['contactReasons'];
        debug("pass1");
        if (!empty($aReasons)) {
            $reasons = "";
            $N       = count($aReasons);
            debug("pass2");
            for ($i = 0; $i < $N; $i++) {
                $reasons .= "{$aReasons}[{$i}] ";
            }
        }

        $mailBody = "Name: $sender\nEmail: $senderEmail\nReasons: $reasons\n\nMessage:$message";
        if (mail($recipient, $subject, $mailBody, "From: Site Contact <admin@stevenshi.me>")) {
            header('Location: thank-you.html');
            echo '<p>Your message has been sent!</p>';
            debug("pass3");
        } else {
            echo '<p>Something went wrong, go back and try again!</p>';
        }
    }
}
debug("pass4");
?>
