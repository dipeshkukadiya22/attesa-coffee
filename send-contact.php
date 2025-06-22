<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer autoload for PHPMailer

$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dipesh.teque7@gmail.com'; // Your Gmail address
    $mail->Password   = 'mkgoobiheyeaqwra';   // App password from Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender and Receiver
    $mail->setFrom('dipesh.teque7@gmail.com', 'Attesa Coffee Contact');
    $mail->addAddress('dipesh@teque7.com'); // Receiver email

    // Collect Form Data Securely
    $firstName = htmlspecialchars($_POST['firstname']);
    $lastName  = htmlspecialchars($_POST['lastname']);
    $email     = htmlspecialchars($_POST['email']);
    $phone     = htmlspecialchars($_POST['phone']);
    $company   = htmlspecialchars($_POST['company']);
    $vat       = htmlspecialchars($_POST['vat']);
    $message   = htmlspecialchars($_POST['message']);

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission from $firstName $lastName";
    $mail->Body    = "
        <strong>Name:</strong> $firstName $lastName<br>
        <strong>Email:</strong> $email<br>
        <strong>Phone:</strong> $phone<br>
        <strong>Company:</strong> $company<br>
        <strong>VAT:</strong> $vat<br>
        <strong>Message:</strong><br>$message
    ";

    $mail->send();
    echo "<script>alert('Message sent successfully.'); window.location.href = 'index.html';</script>";
} catch (Exception $e) {
    echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); history.back();</script>";
}