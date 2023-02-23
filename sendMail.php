<?php
$subject = 'MY TEST EMAIL';
echo '============' . "\n";
echo $subject . "\n";
echo '============' . "\n";
$firstName = 'Andrey';
$text1 = "firstName : {$firstName}" . "\n";
$lastName = 'Ivanov';
$text2 = "lastName: {$lastName}" . "\n";
$email = 'andreyivanov@email.com';
$text3 = "email: {$email}" . "\n";
$phone = '123-456-7890';
$text4 = "phone: {$phone}" . "\n";
$message = $text1 . $text2 . $text3. $text4;
$text5 = "This is a test email." . "\n";
$message .= $text5;
$headers = 'From: student.528st.SMTP@gmail.com';
ini_set('SMTPSecure', 'tls');
mail('d.r.lutsenko@student.khai.edu', $subject, $message, $headers);
echo $message;
?>
