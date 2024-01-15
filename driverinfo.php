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
    <link rel="stylesheet" href="style/StyleExp.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Driver Information</title>
</head>
<body>
<nav class="navbar MYnavbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid d-flex justify-content-center">
            <img src="img/logoNoSlogan-01.png" alt="logo" style="height: 50px;    filter: drop-shadow(1px 1px 0px var(--text-color));">
        </div>
    </nav>
    <div class="wrapper driverinfo">
        <div class="form-box login">
            <h2>Car Information</h2>
            <?php if (isset($successMessage)): ?>
                <div class="notification success">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errorMessage)): ?>
                <div class="notification error">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="#">
                <div class="input-box">
                    <label>Enter Number:</label><br>
                    <input type="text" name="numberInput" maxlength="8" title="Please enter a number in the format XX-XXXXX" required placeholder="XX-XXXXX">
                </div>
                <div class="input-box">
                    <label>Select charging type:</label>
                    <br><br>
                    <select name="charging-type">
                        <option value="fast">Fast</option>
                        <option value="slow">Slow</option>
                    </select>
                </div>
                <button type="submit" class="btnLogin">Submit</button>
            </form>
        </div>
    </div>

    <script>
        const numberInput = document.querySelector('input[name="numberInput"]');

        numberInput.addEventListener('input', (event) => {
            const inputValue = event.target.value;
            const formattedValue = inputValue.replace(/\D/g, '').replace(/^(\d{2})(\d{0,5})/, '$1-$2');
            event.target.value = formattedValue;
        });
    </script>
   
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
<!-- car type      car number     battery capacite-->
