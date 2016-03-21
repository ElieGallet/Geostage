<?php
require($_SERVER['DOCUMENT_ROOT'] . '/business-logic/libraries/PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "geostage.ufrstapsmontpellier@gmail.com";

//Password to use for SMTP authentication
$mail->Password ="geostagepsw";

//Set who the message is to be sent from
$mail->setFrom('geostage.ufrstapsmontpellier@gmail.com', 'Geostage');

//Set an alternative reply-to address
$mail->addReplyTo('geostage.ufrstapsmontpellier@gmail.com', 'Geostage');

//Set who the message is to be sent to

/*if (isset($_GET['receiver'])){
	$receiver = $_GET['receiver'];
}*/

$receiver = 'jean-marie.vautrin@univ-montp1.fr';
$mail->addAddress($receiver, $receiver);
$receiver = 'elie.gallet@gmail.com';
$mail->addAddress($receiver, $receiver);

//Set the subject line
$mail->Subject = 'Geostage email';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$content = 'no content';
if (isset($_GET['content'])){
	$content = 'test : ' + $_GET['content'];
}
$mail->Body = $content;

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo "Message sent!";
}

exit();
?>