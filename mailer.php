<?php
    // Only process POST requests.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the form fields and remove whitespace.
        $name = trim($_POST["name"]);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $cont_subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);

        // Validate the form data.
        if (empty($name) || empty($message) || empty($cont_subject) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            exit("Oops! There was a problem with your submission. Please complete the form and try again.");
        }

        // Set the recipient email address.
        $recipient = "info.itihaasafoods@gmail.com";

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Subject: $cont_subject\n";
        $email_content .= "Message:\n$message\n";

        // Set the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);
            exit("Thank You! Your message has been sent.");
        } else {
            http_response_code(500);
            exit("Oops! Something went wrong and we couldn't send your message.");
        }
    } else {
        http_response_code(403);
        exit("There was a problem with your submission, please try again.");
    }
?>
