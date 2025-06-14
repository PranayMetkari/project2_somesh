<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Function to sanitize form inputs
function sanitize($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form inputs
    $name = sanitize($_POST['username']);
    $email = sanitize($_POST['useremail']);
    $mobile = sanitize($_POST['userphone']);
    $subject = sanitize($_POST['usersubject']);
    $message = sanitize($_POST['user_msg']);

    // Send email using PHPMailer
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'estoniahandloom2025@gmail.com';
    $mail->Password = 'olewdbcamrqinomy';
    $mail->setFrom('estoniahandloom2025@gmail.com', 'Estonia Handloom');
    $mail->addAddress('pranay.metkari204@gmail.com', 'Recipient Name');
    $mail->addAddress('pranay.metkari204@gmail.com', 'Recipient Name');
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body = "Name: $name\nMobile Number: $mobile\nEmail ID: $email\nSubject: $subject\n\nMessage: $message";

    if ($mail->send()) {
        echo 'Email sent successfully.';
        // header('Location: thankyou.php');
    } else {
        echo 'Error: ' . $mail->ErrorInfo;
    }
} else {
    echo 'CAPTCHA verification failed.';
}
