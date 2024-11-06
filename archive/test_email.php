<?php
// Define the recipient email address
$to = "blueg037@bluegumability.com"; // Replace with your actual email address

// Create the email subject and body
$subject = "Test Email from PHP";
$message = "This is a simple test email sent from a PHP script to verify mail configuration.";

// Set the headers with a valid 'From' address belonging to your domain
$headers = "From: rob@bluegumability.com"; // Replace with your domain's email
$headers = "From: Bluegum Ability Services <rob@bluegumability.com>";
$headers .= "CC: taane@bluegumability.com\r\n"; // Add your CC email address


// Send the email using the built-in PHP mail function
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
?>