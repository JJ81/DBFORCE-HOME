<?php

require_once('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.

    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);


    // Check that data was sent to the mailer.
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        AlertMsgAndRedirectTo('/', '이메일 주소를 정확하게 입력해 주세요.');
        exit;
    }

    // Set the recipient email address.
    $recipient = "info@jcorporationtech.com";

    // Build the email content.
    $name="Subscriber";
    $subject="[DBFORCE] Requested to subscribe newsletter";
    $email_content = "Email: $email\n\n";


    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        //echo "Thank You! Your message has been sent.";
        AlertMsgAndRedirectTo('/', '정상적으로 접수되었습니다. 감사합니다.[P]');
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        AlertMsgAndRedirectTo('/', '무언가 문제가 발생한 것 같습니다. 다시 시도해 주세요.[A]');
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    AlertMsgAndRedirectTo('/', '무언가 문제가 발생한 것 같습니다. 다시 시도해 주세요.[B]');
}

?>


