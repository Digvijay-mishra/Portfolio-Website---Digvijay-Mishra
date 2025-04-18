<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $budget = $_POST['budget'];
    $message = $_POST['message'];
    
    // Admin email (where you receive the form submissions)
    $to_admin = "digvijaymishra2122@gmail.com";
    
    // Email subject for admin
    $admin_subject = "New Contact Form Submission: $subject";
    
    // Email content for admin
    $admin_message = "
    <html>
    <head>
        <title>New Contact Form Submission</title>
    </head>
    <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Budget:</strong> $budget</p>
        <p><strong>Message:</strong><br>".nl2br($message)."</p>
    </body>
    </html>
    ";
    
    // User email (reply to the user)
    $user_subject = "Thank you for contacting us!";
    
    $user_message = "
    <html>
    <head>
        <title>Thank you for contacting us</title>
    </head>
    <body>
        <h2>Thank you, $name!</h2>
        <p>We've received your message and will get back to you soon.</p>
        <p>Here's what you submitted:</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>".nl2br($message)."</p>
        <p>We appreciate your interest and will respond within 24-48 hours.</p>
    </body>
    </html>
    ";
    
    // Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    
    // Additional headers for admin email
    $admin_headers = $headers . "From: $email\r\n" . "Reply-To: $email\r\n";
    
    // Additional headers for user email
    $user_headers = $headers . "From: your-email@example.com\r\n" . "Reply-To: your-email@example.com\r\n";
    
    // Send email to admin
    $admin_mail_sent = mail($to_admin, $admin_subject, $admin_message, $admin_headers);
    
    // Send confirmation email to user
    $user_mail_sent = mail($email, $user_subject, $user_message, $user_headers);
    
    if ($admin_mail_sent && $user_mail_sent) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request method.";
}
?>