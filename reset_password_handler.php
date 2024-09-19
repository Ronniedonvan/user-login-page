<?php
// Include database connection
require 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];

    if ($new_password === $confirm_password) {
        // Verify the reset token
        $sql = "SELECT * FROM users WHERE reset_token = ? AND reset_expires >= ?";
        $stmt = $conn->prepare($sql);
        $current_time = date("U");
        $stmt->bind_param('si', $token, $current_time);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the user's password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $hashed_password, $token);
            $stmt->execute();
            
            echo "Password has been reset successfully.";
        } else {
            echo "Invalid or expired token.";
        }
    } else {
        echo "Passwords do not match.";
    }
} else {
    echo "Invalid request.";
}
?>
