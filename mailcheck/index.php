<?php

function emailExists($email)
{
    // Prepare email content
    $to = $email;
    $subject = "Testing email existence";
    $message = "This is a test email to check if the email exists.";
    $headers = "From: hp004086@gmail.com";

    // Send the email
    $result = mail($to, $subject, $message, $headers);

    return $result;
}

// Example usage
$email = "harshpatel4086@gmail.com";

if (emailExists($email)) {
    echo "<script>alert('The email exists.')</script>";
} else {
    echo "<script>alert('The email does not exist or could not be reached.')</script>";
}
