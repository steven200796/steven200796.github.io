
<?php

function debug( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

if(isset($_POST["cd-email"])) {
    $recipient="diyang_shi@brown.edu";
    $subject="You have received a new message from your site.";
    $sender=$_POST["cd-name"];
    $senderEmail=$_POST["cd-email"];
    $senderCompany=$_POST["cd-company"];
    $message=$_POST["cd-textarea"];
    $aReasons=$_POST['contactReasons'];
    debug( "pass1");
    if(!empty($aReasons)) {
        $reasons="";
        $N = count($aReasons);
	dbug( "pass2" );
        for($i=0; $i < $N; $i++)
        {
            $reasons .= "{$aReasons}[{$i}] ";
        }
    }

    $mailBody="Name: $sender\nEmail: $senderEmail\n Reasons: $reasons\n\n$message";
    if (mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>")) {
            header('Location: thank-you.html');
            echo '<p>Your message has been sent!</p>';
            debug( "pass3" );
        } else {
            echo '<p>Something went wrong, go back and try again!</p>';
        }
    }
debug( "pass4" );
?>
