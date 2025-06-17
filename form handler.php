<?php
// Basic validation
if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $visitor_email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if ($name && $visitor_email && $subject && $message) {
        $email_from = 'designerclint5@gmail.com';
        $email_subject = 'New Form Submission';
        $email_body = "User Name: $name.\n" .
            "User Email: $visitor_email.\n" .
            "Subject: $subject.\n" .
            "User Message: $message.\n";

        $to = 'clintnowino@gmail.com';
        $headers = "From: $email_from\r\n";
        $headers .= "Reply-To: $visitor_email\r\n";

        if (mail($to, $email_subject, $email_body, $headers)) {
            header("Location: contact.html?success=1");
            exit();
        } else {
            header("Location: contact.html?error=mailfail");
            exit();
        }
    } else {
        header("Location: contact.html?error=invalid");
        exit();
    }
} else {
    header("Location: contact.html?error=missing");
    exit();
}
?>