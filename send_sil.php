<?php
header("Content-Security-Policy: default-src 'self'; style-src 'self' https://stackpath.bootstrapcdn.com;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIL Enquiry</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $gender = htmlspecialchars($_POST['gender']);
    $other_gender = htmlspecialchars($_POST['otherGender'] ?? '');
    $dob = htmlspecialchars($_POST['dob']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $ndis_plan = htmlspecialchars($_POST['ndisPlan']);

    // Check if "Other" gender is selected
    if ($gender === 'Other' && !empty($other_gender)) {
        $gender = "Other: $other_gender";
    }

    // Verify reCAPTCHA response
    $recaptchaSecret = getenv('RECAPTCHA_SECRET_KEY');  // Use environment variable for Secret Key
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

    // Debugging: Print reCAPTCHA secret key and response
    echo "<pre>reCAPTCHA Secret Key: $recaptchaSecret</pre>";
    echo "<pre>reCAPTCHA Response: $recaptchaResponse</pre>";

    // Check if reCAPTCHA response is set
    if (empty($recaptchaResponse)) {
        echo "reCAPTCHA response is missing.";
        exit();
    }

    // Make the API request to verify the reCAPTCHA response
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyUrl . "?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse);
    $responseData = json_decode($response);

    // Debugging: Echo the response and responseData
    echo "<pre>Response: $response</pre>";
    echo "<pre>Response Data: ";
    print_r($responseData);
    echo "</pre>";

    if ($responseData->success) {
        // Set the recipient email and subject
        $to = "no-reply@bluegum-ability-services.com";  // Replace with your actual email address
        $email_subject = "SIL Enquiry from $first_name $last_name";
        
        // Create the message body
        $email_body = "
        You have received a new enquiry from the SIL form on your website:

        Name: $first_name $last_name
        Gender: $gender
        Date of Birth: $dob
        Email: $email
        Phone: $phone
        NDIS Plan: $ndis_plan
        ";

        // Set the email headers
        $headers = "From: $email";

        // Send the email
        if (mail($to, $email_subject, $email_body, $headers)) {
            // Redirect to the thank-you page after successful form submission
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