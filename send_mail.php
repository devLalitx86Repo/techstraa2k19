<?php     
$to_email = 'techstra2k19@gmail.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: lalitguptax64@gmail.com';
mail($to_email,$subject,$message,$headers);
?>