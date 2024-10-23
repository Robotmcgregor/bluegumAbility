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
    $recaptchaSecret = "6Ld_lmkqAAAAADrG6doqJAeXMwJImFhCySXwW21D";  // Use your Secret Key here
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    
    // Make the API request to verify the reCAPTCHA response
    $response = file_get_contents($verifyUrl . "?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse);
    $responseData = json_decode($response);

    if ($responseData->success) {
        // Set the recipient email and subject
        $to = "admin@bluegumability.com";  // Replace with your actual email address
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
            echo "Thank you for your enquiry. We will get back to you soon.";
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
