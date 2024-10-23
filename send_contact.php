<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Verify reCAPTCHA response
    $recaptchaSecret = "6LdYnmkqAAAAAL2gsQ7-K0l4oERbBsqognbyO-eJ";
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    
    // Make the API request to verify the reCAPTCHA response
    $response = file_get_contents($verifyUrl . "?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse);
    $responseData = json_decode($response);

    if ($responseData->success) {
        // Set the recipient email and subject
        $to = "admin@bluegumability.com"; // Change to your actual email
        $email_subject = "Contact Form Submission from $name";
        
        // Create the message body
        $email_body = "
        You have received a new message from the contact form on your website:

        Name: $name
        Email: $email
        Message: $message
        ";

        // Set the email headers
        $headers = "From: $email";

        // Send the email
        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "Thank you for contacting us. We will get back to you soon.";
        } else {
            echo "Sorry, there was an error sending your message. Please try again.";
        }
    } else {
        // reCAPTCHA verification failed
        echo "reCAPTCHA verification failed. Please go back and try again.";
    }
} else {
    // If the request method is not POST, deny access
    echo "Access denied.";
}
?>