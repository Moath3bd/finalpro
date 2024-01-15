<?php
require_once 'database.php';

// Fetch the required data from the database
$numberQuery = "SELECT number FROM car_information"; // Assuming you want to fetch the 'number' value for all rows
$timeQuery = "SELECT time FROM register"; // Assuming you want to fetch the 'time' value for all rows

$numberResult = mysqli_query($connection, $numberQuery);
$timeResult = mysqli_query($connection, $timeQuery);

// Check if there are any rows returned from the queries
if (mysqli_num_rows($numberResult) > 0 && mysqli_num_rows($timeResult) > 0) {
    $numberRow = mysqli_fetch_assoc($numberResult);
    $timeRow = mysqli_fetch_assoc($timeResult);
    $number = $numberRow['number'];
    $time = $timeRow['time'];
} else {
    $number = "No cars registered"; // Default value if there are no rows in the table
    $time = "No time available"; // Default value if there are no rows in the table
}

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/StyleExp.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Booking Information</title>
</head>
<body>
<nav class="MYnavbar">
    <div class="MYnavbaricon">
        <img src="img/logoNoSlogan-01.png" alt="logo">
    </div>
    <ul class="MYnavbar-nav">
    <li class="MYnav-item">
                <a class="MYnav-link" href="profile_owner.php"><i class="fas fa-user"></i> Profile</a>
            </li>
        <li class="MYnav-item">
            <a class="MYnav-link" href="homePage.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
        </li>
    </ul>
</nav>

<div class="wrapper userinfo">
    <div class="form-box">
        <h2>Booking Information</h2>

        <form method="post" id="profileinfo" action="bookinginfo.hpp">
            <div class="input-box">
                <input type="text" id="number" name="number" maxlength="8" value="<?php echo $number; ?>">
                <label for="numberInput" style="color: aliceblue;">Car plate</label>
            </div>
            <div class="input-box">
                <input type="text" id="time" name="time" value="<?php echo $time; ?>" />
                <label for="time" style="color: aliceblue;">Time:</label>
            </div>
        </form>
    </div>
</div>
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
</body>
</html>
