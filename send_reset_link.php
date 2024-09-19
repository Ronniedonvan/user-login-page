<?php
// Include database connection
require 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique reset token
        $reset_token = bin2hex(random_bytes(32));
        $reset_url = "http://yourwebsite.com/reset_password.php?token=" . $reset_token;

        // Save the token in the database with an expiry time
        $expires = date("U") + 1800; // Token valid for 30 minutes
        $sql = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sis', $reset_token, $expires, $email);
        $stmt->execute();

        // Send the reset email
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: " . $reset_url;
        $headers = "From: no-reply@yourwebsite.com\r\n";
        
        if (mail($email, $subject, $message, $headers)) {
            echo "Password reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "No account found with that email.";
    }
} else {
    echo "Invalid request.";
}
?>
