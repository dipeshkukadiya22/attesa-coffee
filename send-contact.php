<?php
// Microsoft 365 destination email
$to = "dipesh@teque7.com";  // Replace with your Microsoft 365 email

// Sanitize input
$firstname = htmlspecialchars($_POST['firstname']);
$lastname  = htmlspecialchars($_POST['lastname']);
$email     = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$phone     = htmlspecialchars($_POST['phone']);
$company   = htmlspecialchars($_POST['company']);
$vat       = htmlspecialchars($_POST['vat']);
$message   = htmlspecialchars($_POST['message']);

if (!$email) {
    die("Invalid email address.");
}

// Email subject and headers
$subject = "New Contact Form Submission";
$headers = "From: $firstname $lastname <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Email body
$body = "Name: $firstname $lastname\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n";
$body .= "Company: $company\n";
$body .= "VAT: $vat\n\n";
$body .= "Message:\n$message";

// Send mail
if (mail($to, $subject, $body, $headers)) {
    echo "Thank you! Your message has been sent.";
} else {
    echo "Sorry, there was an error sending your message.";
}
?>