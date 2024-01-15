<?php
require_once 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chargerNumber = $_POST['chargerNumber'];
    $stationLocation = $_POST['stationLocation'];
    $stationName = $_POST['stationName'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    // Check if the station already exists
    $stmt = $connection->prepare('SELECT id FROM station_information WHERE station_name = ?');
    $stmt->bind_param('s', $stationName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $notification = 'Station already exists!';
    } else {
        // Insert the station information into the database
        $stmt = $connection->prepare('INSERT INTO station_information (charger_number, station_location, station_name, start_time, end_time) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('issss', $chargerNumber, $stationLocation, $stationName, $startTime, $endTime);
        $stmt->execute();

        // Redirect to the "ownerpage.php" page
        header('Location: ownerpage.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Owner Information</title>
</head>
<body>
<nav class="navbar MYnavbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid d-flex justify-content-center">
            <img src="img/logoNoSlogan-01.png" alt="logo" style="height: 50px;    filter: drop-shadow(1px 1px 0px var(--text-color));">
        </div>
    </nav>
    </div>
    <div class="wrapper driverinfo" style="height:75vh;width:35vw;">
        <div class="form-box login">
            <h2>Station Information</h2>
            <form method="POST" action="#">
                <?php if (!empty($notification)) : ?>
                    <div class="notification"><?php echo $notification; ?></div>
                <?php endif; ?>
                <div class="input-box">
                    <label for="chargerNumber">Select charger number:</label><br>
                    <input type="number" id="chargerNumber" name="chargerNumber" title="Please enter a charger number" required min="1" value="1">                 
                </div>
                <div class="input-box">
                    <label for="stationLocation">Select station location:</label><br>
                    <input type="text" id="stationLocation" name="stationLocation" required>
                    <br><br>
                </div>
                <div class="input-box">
                    <label for="stationName">Station name:</label><br>
                    <input type="text" id="stationName" name="stationName" required>
                    <br><br>
                </div>
                <br>
                <label for="startTime" style="color: aliceblue;">Open Time:</label>
                <input type="time" id="startTime" name="startTime" required>
                <br><br>
                <label for="endTime" style="color: aliceblue;">Close Time:</label>
                <input type="time" id="endTime" name="endTime" required>     
                <br/>
                <br/>
                <button type="submit" class="btnLogin">Submit</button>
            </form>
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
