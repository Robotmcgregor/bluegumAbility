<?php
header("Content-Security-Policy: default-src 'self'; style-src 'self' https://stackpath.bootstrapcdn.com;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required. Please go back and fill out the form.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please go back and enter a valid email.";
        exit();
    }

    // Verify reCAPTCHA response
    $recaptchaSecret = getenv('RECAPTCHA_SECRET_KEY');  // Use environment variable for Secret Key
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    
    // Make the API request to verify the reCAPTCHA response
    $response = file_get_contents($verifyUrl . "?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse);
    $responseData = json_decode($response);

    // Debugging: Echo the response and responseData
    echo "<pre>Response: $response</pre>";
    echo "<pre>Response Data: ";
    print_r($responseData);
    echo "</pre>";

    if ($responseData->success) {
        // Set the recipient email and subject
        $to = "no-reply@bluegum-ability-services.com"; // Change to your actual email
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
            // Redirect to thank-you page after successful form submission
            header("Location: thank_you.php");
            exit();
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
</body>
</html>