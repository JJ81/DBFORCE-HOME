<?php
require_once('../../autoload.php');
require_once('../../commons/config.php');
require_once('../../commons/utils.php');

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = "$name 님의 디비포스 서비스 요청";
    $message = trim($_POST["message"]);
    $phone = trim($_POST["tel"]);

    // Check that data was sent to the mailer.
    if ( empty($name) OR empty($subject) OR empty($message) OR empty($phone) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo '입력폼을 빠짐없이 입력해 주세요.';
        exit;
    }

    // Set the recipient email address.
    $recipient = "info@jcorporationtech.com";

    // Set the email subject.
    $subject = "[DBFORCE] New contact from New Client";

    // Build the email content.
    $email_content = "name: $name\n";
    $email_content .= "Email: $email\n\n";
    //$email_content .= "Subject: $subject\n\n";
    $email_content .= "Phone:$phone\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo '정상적으로 접수되었습니다. 감사합니다.[P]';
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo '무언가 문제가 발생한 것 같습니다. 다시 시도해 주세요.[A]';
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo '무언가 문제가 발생한 것 같습니다. 다시 시도해 주세요.[B]';
}

?>


