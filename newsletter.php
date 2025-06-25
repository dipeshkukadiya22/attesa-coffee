<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    // Basic validation
    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // === Admin Email (G Suite) ===
        $adminEmail = "dipesh@teque7.com"; // Replace with your actual G Suite email

        // === Email Subject & Message ===
        $subject = "New Newsletter Subscription";
        $message = "You have a new subscriber:\n\nName: $name\nEmail: $email";

        // === Email Headers ===
        $headers = "From: dipesh@teque7.com\r\n"; // Replace with your domain email (must exist!)
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // === Send the Email ===
        if (mail($adminEmail, $subject, $message, $headers)) {
            echo "Thank you for subscribing!";
        } else {
            echo "Error sending email. Please try again.";
        }

    } else {
        echo "Invalid input. Please enter a valid name and email.";
    }
} else {
    echo "Invalid request.";
}