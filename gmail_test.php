<?php
$to = "blueg037@bluegumability.com";
$subject = "Test Email";
$message = "This is a test email to check if the PHP mail function is working.";
$headers = "From: admin@bluegumability.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
?>