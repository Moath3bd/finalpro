<?php
// Handle registration form submission
require_once 'database.php';
$successMessage = '';
$errorMessage = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['name'], $_POST['password1'], $_POST['password2'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    // Validate form data
    $errors = array();
    if ($password1 !== $password2) {
        $errors[] = 'Passwords do not match.';
    }
    // Validate username: must consist of letters only
    if (!preg_match('/^[a-zA-Z]+$/', $name)) {
        $errors[] = 'Username must consist of letters only.';
    }

    // Validate email: must end with @, then any name, then .com
    if (!preg_match('/^.*@.*\.com$/', $email)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate password: at least 8 characters long, contains a capital letter and any symbol
    if (strlen($password1) < 8 || !preg_match('/[A-Z]/', $password1) || !preg_match('/[^a-zA-Z0-9]/', $password1) || !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password1)) {
        $errors[] = 'Password must be at least 8 characters long and contain a capital letter and any symbol.';
    }

    if (count($errors) === 0) {
        $stmt = $connection->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = 'User with the same email already exists.';
        } else {
        // Hash the password
        $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);

        // Prepare and bind the insert statement
        $stmt = $connection->prepare('INSERT INTO users (email, name, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $email, $name, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful
            $successMessage = 'Registration successful!';
        } else {
            // Error occurred during registration
            $errorMessage = 'Error: ' . $stmt->error;
        }
    }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            $errorMessage .= $error . '<br>';
        }
    }
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    // Login form handling
    $loginEmail = $_POST['email'];
    $loginPassword = $_POST['password'];

    // Prepare and bind the select statement
    $stmt = $connection->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $loginEmail);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows === 1) {
            // User exists, verify the password
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            if (password_verify($loginPassword, $hashedPassword)) {
                // Password is correct, login successful
                $successMessage = 'Login successful!';
                // Redirect or perform any necessary actions
                // For example, you can redirect to a dashboard page:
                header('Location: home.php');
                exit();
            } else {
                // Password is incorrect
                $errorMessage = 'Invalid password.';
            }
        } else {
            // User does not exist
            $errorMessage = 'Invalid email.';
        }
    } else {
        // Error occurred during execution
        $errorMessage = 'Error: ' . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <title>Login & Signup Forms</title>
</head>
<body>
    <header>
        <nav>
            <div><a class="logo" href="home.php">EVehicles</a> </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="vehicles.php">Vehicles</a></li>
                <li><a href="chargestation.php">Charging Stations</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <section class="forms-section">
        <h1 class="section-title">Login & Signup</h1>
        <div class="forms">
          <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
              Login
              <span class="underline"></span>
            </button>
            <form class="form form-login">
              <fieldset>
                <legend>Please, enter your email and password for login.</legend>
                <div class="input-block">
                  <label for="login-email">E-mail</label>
                  <input id="login-email" type="email" required>
                </div>
                <div class="input-block">
                  <label for="password">Password</label>
                  <input id="password" type="password" required>
                </div>
              </fieldset>
              <button type="submit" class="btn-login">Login</button>
            </form>
          </div>
          <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
              Sign Up
              <span class="underline"></span>
            </button>
            <form class="form form-signup">
              <fieldset>
                <legend>Please, enter your email, password, and password confirmation for sign up.</legend>
                <div class="input-block">
                  <label for="signup-username">Username</label>
                  <input id="signup-email" type="text" required>
                </div>
                <div class="input-block">
                  <label for="email">E-mail</label>
                  <input id="email" type="email" required>
                </div>
                <div class="input-block">
                  <label for="password1">Password</label>
                  <input id="password1" type="password" required>
                </div>
                <div class="input-block">
                    <label for="password2">Confirm Password</label>
                    <input id="password2" type="password" required>
                  </div>
              </fieldset>
              <button type="submit" class="btn-signup">Sign Up</button>
            </form>
          </div>
        </div>
    </section>
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


<script src="javascript.js"></script>
</body>
</html>
