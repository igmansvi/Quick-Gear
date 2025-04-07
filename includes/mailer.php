<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\SMTP.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$contactResult = null; // Initialize the variable to avoid undefined variable notices
if (isset($_POST['footer_contact_submit'])) {
    $message = isset($_POST['footer_message']) ? $_POST['footer_message'] : '';
    $name = isset($_POST['footer_name']) ? $_POST['footer_name'] : '';
    $email = isset($_POST['footer_email']) ? $_POST['footer_email'] : '';

    if (empty($message)) {
        $contactResult = ['success' => false, 'message' => 'Please enter a message'];
    } else {
        $contactResult = sendContactEmail($message, $name, $email);
    }
}

// Function to send contact form emails
function sendContactEmail($userMessage, $userName = '', $userEmail = '')
{
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get user details from session if available
    if (empty($userName) && isset($_SESSION['user_name'])) {
        $userName = $_SESSION['user_name'];
    }
    if (empty($userEmail) && isset($_SESSION['user_email'])) {
        $userEmail = $_SESSION['user_email'];
    }

    // Default values if still empty
    $userName = !empty($userName) ? $userName : 'Website Visitor';
    $userEmail = !empty($userEmail) ? $userEmail : 'no-email@provided.com';

    // Sanitize inputs
    $userName = htmlspecialchars($userName);
    $userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
    $userMessage = htmlspecialchars($userMessage);

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mansviku@gmail.com';
        $mail->Password = 'xupcidvhrewjnols';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('mansviku@gmail.com', 'Quick Gear Contact Form');
        $mail->addAddress('mansviku@gmail.com', 'Mansvi');
        $mail->addReplyTo($userEmail, $userName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message from ' . $userName;

        // Prepare HTML message
        $htmlMessage = "
        <h2>New Contact Form Submission</h2>
        <p><strong>From:</strong> {$userName}</p>
        <p><strong>Email:</strong> {$userEmail}</p>
        <p><strong>Message:</strong></p>
        <div style='background-color: #f5f5f5; padding: 10px; border-left: 4px solid #007bff;'>
            " . nl2br($userMessage) . "
        </div>
        <p>This message was sent from the Quick Gear website contact form.</p>
        ";

        $mail->Body = $htmlMessage;
        $mail->AltBody = "From: $userName\nEmail: $userEmail\n\nMessage:\n$userMessage";

        $mail->send();
        return ['success' => true, 'message' => 'Your message has been sent successfully!'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => "Message could not be sent. Error: {$mail->ErrorInfo}"];
    }
}
?>