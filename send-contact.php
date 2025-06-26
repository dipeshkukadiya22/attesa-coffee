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
    $mail->Username   = 'hello@attesa.co'; // Your Gmail address
    $mail->Password   = 'apklnxuppvqdjwgy';        // App password from Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Collect Form Data Securely
    $firstName = htmlspecialchars($_POST['firstname']);
    $lastName  = htmlspecialchars($_POST['lastname']);
    $email     = htmlspecialchars($_POST['email']);
    $phone     = htmlspecialchars($_POST['phone']);
    $pname   = htmlspecialchars($_POST['pname']);
    $weight       = htmlspecialchars($_POST['weight']);
    $message   = htmlspecialchars($_POST['message']);

    // ========================
    // 1. Send email to Admin
    // ========================
    $mail->setFrom('hello@attesa.co', 'Attesa Coffee Contact');
    $mail->addAddress('hello@attesa.co'); // Admin email
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission from $firstName $lastName";
    $mail->Body    = "
        <strong>Name:</strong> $firstName $lastName<br>
        <strong>Email:</strong> $email<br>
        <strong>Phone:</strong> $phone<br>
        <strong>Product Name:</strong> $pname<br>
        <strong>Weight in KG:</strong> $weight<br>
        <strong>Message:</strong><br>$message
    ";
    $mail->send();

    // =============================
    // 2. Send confirmation to client
    // =============================
    $mail->clearAddresses(); // Clear previous recipients
    $mail->addAddress($email); // Client email
    $mail->Subject = "Thank you for contacting Attesa Coffee";
    $mail->Body    = "
        Dear $firstName $lastName,<br><br>
        Thank you for reaching out to us. We have received your message and will get back to you soon.<br><br>
        
        Regards,<br>
        Attesa Coffee Team
    ";
    $mail->send();

    echo "<script>alert('Message sent successfully.'); window.location.href = 'our-coffee.html';</script>";
} catch (Exception $e) {
    echo "<script>alert('Mailer Error: {$mail->ErrorInfo}'); history.back();</script>";
}