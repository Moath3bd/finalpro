<?php
require_once 'database.php';


// Initialize variables
$email = false;
$password = false;
$a = false;
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $newPassword = $_POST['passwordNew'];
    $confirmPassword = $_POST['passwordCon'];
    $inputEmail = $_POST['email'];

    // Perform input validation
    if ($newPassword === $confirmPassword && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword)) {
        $password = true;
    }

    // Check if email exists in the database
    // Assuming you have a "users" table in your database
    $query = "SELECT COUNT(*) FROM users WHERE email = '$inputEmail'";
    // Execute the query and fetch the result
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    $count = $row[0];

    if ($count > 0) {
        $email = true;
    }

    // Additional conditions if needed
    $a = true;

    if ($email && $password && $a) {
        // Update the user's password in the database
        // Assuming your database connection variable is $connection
        // Update the table and column names according to your database structure
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE email = '$inputEmail'";
        
        // Execute the update query
        // Uncomment the following lines if you have a database connection and want to execute the query
        $result = mysqli_query($connection, $updateQuery);
        if ($result) {
            $successMessage = "Password reset successful!";
        } else {
            $errorMessage = "Failed to update the password. Please try again.";
        }
        
        // Display success message if not using database connection
        $successMessage = "Password reset successful!";
    } elseif (!$email) {
        $errorMessage = "Email not found.";
    } elseif (!$password) {
        $errorMessage = "Invalid password format.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Forget My Password</title>
</head>
<body>
    <nav class="navbar MYnavbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid d-flex justify-content-center">
            <img src="img/logoNoSlogan-01.png" alt="logo" style="height: 50px;    filter: drop-shadow(1px 1px 0px var(--text-color));">
        </div>
    </nav>
    </div>
    <div class="wrapper forgetPass">
        <div class="form-box login">
            <h2>Forgot Password</h2>
            <form method="POST" id="resetPasswordForm">
                <div class="input-box">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" id="passwordNew" name="passwordNew" required />
                    <label for="passwordNew">New Password</label>
                </div>
                <div class="input-box">
                    <input type="password" id="passwordCon" name="passwordCon" required />
                    <label for="passwordCon">New Password (Confirm)</label>
                </div>
                <button type="submit" class="btnSingUp">Reset Password</button>
                <a href="homePage.php">Back to Login</a>
            </form>
            <?php if ($errorMessage !== ""): ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <?php if ($successMessage !== ""): ?>
                <div class="success-message"><?php echo $successMessage; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <footer class="mt-5">
        <div class="FooterContainer">
            <div class="row">
                <div class="col l6 s12">
                    <h5>Links</h5>
                    <ul>
                        <li>
                            <a href="contact.php"><i>Contact Us</i></a>
                        </li>
                        <li>
                            <a href="Aboutus.php"><i>About Us</i></a>
                        </li>
                    </ul>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5>Connect</h5>
                    <ul>
                        <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="FooterContainer copyRight">
            <div class="row">
                <div class="col s12">
                    <p>&copy; 2023 Electric Cars | Address | Phone Number | Email</p>
                </div>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
