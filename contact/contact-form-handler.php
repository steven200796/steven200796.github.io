
<?php

if($_POST["submit"]) {
    $recipient="steven@stevenshi.me";
    $subject="You have received a new message from your site.";
    $sender=$_POST["cd-name"];
    $senderEmail=$_POST["cd-email"];
    $senderCompany=$_POST["cd-company"];
    $message=$_POST["cd-textarea"];
    $aReasons=$_POST['contactReasons'];
    if(!empty($aReasons)) {
        $reasons="";
        $N = count($aReasons);
        for($i=0; $i < $N; $i++)
        {
            $reasons .= "$aReasons[$i] ";
        }
    }

    $mailBody="Name: $sender\nEmail: $senderEmail\n Reasons: $reasons\n\n$message";

    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

    header('Location: contact-form-thank-you.html');}

?>
