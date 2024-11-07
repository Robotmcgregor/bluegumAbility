function validateRecaptcha() {
    var response = grecaptcha.getResponse();
    console.log("reCAPTCHA Response:", response); // Debugging: Log the reCAPTCHA response
    if (response.length === 0) {
        alert("Please complete the reCAPTCHA.");
        return false;
    }
    document.getElementById('recaptchaResponse').value = response;
    return true;
}

// Remove aria-hidden and add inert attribute to the ancestor element
document.addEventListener("DOMContentLoaded", function() {
    var recaptchaTarget = document.getElementById("rc-imageselect-target");
    if (recaptchaTarget) {
        recaptchaTarget.removeAttribute("aria-hidden");
        recaptchaTarget.setAttribute("inert", "true");
    }
});
