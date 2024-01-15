<?php
require_once 'database.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = $_POST['numberInput'];
    $chargingType = $_POST['charging-type'];

    // Check if the car number already exists
    $checkStmt = $connection->prepare('SELECT id FROM car_information WHERE number = ?');
    $checkStmt->bind_param('s', $number);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $errorMessage = 'Car number already exists!';
    } else {
        // Insert the car information into the database
        $insertStmt = $connection->prepare('INSERT INTO car_information (number, charging_type) VALUES (?, ?)');
        $insertStmt->bind_param('ss', $number, $chargingType);
        $insertStmt->execute();
        // Redirect to the "BookAppointment.php" page
        header('Location: BookAppointment.php');
        exit(); // Make sure to exit after the redirect
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
    <title>type of user</title>
</head>
<body>
<nav class="navbar MYnavbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid d-flex justify-content-center">
            <img src="img/logoNoSlogan-01.png" alt="logo" style="height: 50px;    filter: drop-shadow(1px 1px 0px var(--text-color));">
        </div>
    </nav>
        <div class="wrapper userinfo">
            <div class="form-box">
                <img id ="logoIcon" src="img/logoicon-01.png" alt="icon" style="height: 50px;">
                <h2>continue as...</h2>
                <br/>
                <div class="input-box2">
    <a id="button" href="driverinfo.php" class="user-box">
        <img class="user-icon" src="path/to/driver-icon.png" alt="Driver Icon">
        <span class="user-label">Driver</span>
    </a>
    <a id="button" href="ownerinfo.php" class="user-box">
        <img class="user-icon" src="path/to/owner-icon.png" alt="Owner Icon">
        <span class="user-label">Owner</span>
    </a>
</div>

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
