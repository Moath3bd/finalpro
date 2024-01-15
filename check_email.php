<?php
// check_email.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Validate email: check if it exists in the database
    $stmt = $connection->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 'valid'; // Email exists, proceed with login
    } else {
        echo 'invalid'; // Email does not exist, display error message or take appropriate action
    }
}
?>
