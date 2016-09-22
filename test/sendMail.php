<?php



$to = '9069262984@globe.com.ph';

$from = 'mrjesuserwinsuarez@gmail.com';

$message = "This is the message ";
$message = wordwrap($message,70);
$headers = "From: $from\n";

if(mail($to,"Hi test",$message)){
    print "sent to $to";
} else {
    print "not sent to $to ";
}


exit;
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
if(mail("mrjesuserwinsuarez@gmail.com","My subject",$msg)){
  print "sent";
} else {
    print "not sent";
}