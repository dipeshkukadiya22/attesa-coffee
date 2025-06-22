<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dipesh@teque7.com';     // Microsoft 365 email
    $mail->Password   = 'mkgoobiheyeaqwra';                 // Or app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Required by Microsoft 365
    $mail->Port       = 587;

    // Sender and recipient
    $mail->setFrom('dipesh@teque7.com', 'Attesa Coffee Contact');
    $mail->addAddress('dipesh@teque7.com'); // where email will be received

    // Get form data
    $firstName = htmlspecialchars($_POST['firstname']);
    $lastName  = htmlspecialchars($_POST['lastname']);
    $email     = htmlspecialchars($_POST['email']);
    $phone     = htmlspecialchars($_POST['phone']);
    $company   = htmlspecialchars($_POST['company']);
    $vat       = htmlspecialchars($_POST['vat']);
    $message   = htmlspecialchars($_POST['message']);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "New Contact from $firstName $lastName";
    $mail->Body    = "
        <strong>Name:</strong> $firstName $lastName<br>
        <strong>Email:</strong> $email<br>
        <strong>Phone:</strong> $phone<br>
        <strong>Company:</strong> $company<br>
        <strong>VAT:</strong> $vat<br>
        <strong>Message:</strong><br>$message
    ";

    $mail->send();
    echo "<script>alert('Message sent successfully.'); window.location.href = 'thank-you.html';</script>";
} catch (Exception $e) {
    echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); history.back();</script>";
}