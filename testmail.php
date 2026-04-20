<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP setup
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thevaibhav.ai@gmail.com';
    $mail->Password = 'tetf wuqp xqom lcfe'; // replace
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender & Receiver
    $mail->setFrom('thevaibhav.ai@gmail.com', 'Test Mail');
    $mail->addAddress('thevaibhav.ai@gmail.com');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body = '<h2>This is test email from PHPMailer</h2>';

    $mail->send();

    echo "Email Sent Successfully!";
} catch (Exception $e) {
    echo "Error: " . $mail->ErrorInfo;
}