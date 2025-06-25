<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

$mail = new PHPMailer(true);

try {
    // === SMTP SETTINGS ===
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dipesh.teque7@gmail.com';  // Your Gmail address
    $mail->Password   = 'mkgoobiheyeaqwra';         // Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // === FORM INPUT ===
    $name  = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid input.");
    }

    // === SEND TO ADMIN ===
    $mail->setFrom('dipesh.teque7@gmail.com', 'Newsletter Signup');
    $mail->addAddress('dipesh@teque7.com'); // Admin/G Suite Email
    $mail->isHTML(true);
    $mail->Subject = "New Newsletter Signup from $name";
    $mail->Body    = "
        <strong>New subscriber details:</strong><br><br>
        <strong>Name:</strong> $name<br>
        <strong>Email:</strong> $email<br>
    ";
    $mail->send();

    // === SEND CONFIRMATION TO SUBSCRIBER ===
    $mail->clearAddresses(); // Clear previous recipient
    $mail->addAddress($email); // Send to subscriber
    $mail->Subject = "Thank you for subscribing to Attesa Coffee!";
    $mail->Body    = "
        Dear $name,<br><br>
        Thank you for subscribing to Attesa Coffee!<br>
        You'll now receive updates, offers, and more straight to your inbox.<br><br>
        Cheers,<br>
        <strong>Attesa Coffee Team</strong>
    ";
    $mail->send();

    echo "<script>alert('Subscription successful.'); window.location.href = 'index.html';</script>";

} catch (Exception $e) {
    echo "<script>alert('Error: {$mail->ErrorInfo}'); history.back();</script>";
}