<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace this with your actual email address
    $yourEmail = 'hanconggoo@gmail.com';

    $fromEmail = $_POST['fromEmail'];
    $toEmail = $_POST['toEmail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Replace [Website URL] with the actual URL of website
    $websiteURL = 'http://localhost/dementia/';

 
    $message = str_replace('[Website URL]', $websiteURL, $message);
    $message = str_replace('[Your Name]', 'Your Name', $message);

    // Send the email
    if (mail($toEmail, $subject, $message, 'From: ' . $fromEmail)) {
 
        echo '<script>';
        echo 'alert("Invitation sent successfully!");';
        echo 'setTimeout(function() { window.location.href = "main.html"; }, 50);'; // Delayed redirection after 2 seconds (2000 milliseconds)
        echo '</script>';
    } else {
        // Failed to send the email
        echo '<h1>Error</h1>';
        echo '<p>Failed to send the invitation email. Please try again later.</p>';
    }
}
?>


