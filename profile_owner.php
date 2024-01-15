<?php
// Initialize variables with default values
$station_name = '';
$station_location = '';
$start_time = '';
$end_time = '';
$message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $station_name = isset($_POST['station_name']) ? $_POST['station_name'] : '';
    $station_location = isset($_POST['stationLocation']) ? $_POST['stationLocation'] : '';
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';

    // Database connection parameters
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'echarge';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Prepare the SQL query to update the station information
    $query = "UPDATE station_information SET station_location = :station_location, start_time = :start_time, end_time = :end_time WHERE station_name = :station_name";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':station_location', $station_location);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':station_name', $station_name);
    $success = $stmt->execute();

    // Check if the update was successful
    if ($success) {
        // Update successful
        $message = "Station information updated successfully.";
    } else {
        // Update failed
        $message = "Failed to update station information.";
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
    <title>owner Page</title>
</head>
<body>
<nav class="MYnavbar">
    <div class="MYnavbaricon">
        <img src="img/logoNoSlogan-01.png" alt="logo">
    </div>
    <ul class="MYnavbar-nav">
        <li class="MYnav-item">
            <a class="MYnav-link" href="BookAppointment.php"><i class="fas fa-calendar-alt"></i> Booking</a>
        </li>
        <li class="MYnav-item">
            <a class="MYnav-link" href="ownerpage.php"><i class="fas fa-calendar-alt"></i> Booking Information</a>
        </li>
        <li class="MYnav-item">
            <a class="MYnav-link" href="homePage.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
        </li>
    </ul>
</nav>

<div class="wrapper userinfo">
    <div class="form-box">
        <h2>Station Information</h2>
        <div class="profile">
            <form id="profile-form" enctype="multipart/form-data" method="post" action="">
                <img id="preview-image" src="img/profile_picture.jpeg" alt="Preview Image" class="profile-picture">
                <br>
                <label for="profile-picture" style="color: aliceblue;">Profile Picture</label>
                <br>
                <input type="file" id="profile-picture-input" name="profile-picture-input" style="display: none;">
            </form>
        </div>
        <form method="post" id="profileinfo" action="">
            <div class="input-box">
                <input type="text" id="station_name" name="station_name" required>
                <label for="station_name" style="color: aliceblue;">Station Name:</label>
            </div>
            <div class="input-box">
                <input type="text" id="stationLocation" name="stationLocation" required>
                <label for="stationLocation" style="color: aliceblue;">Station Location:</label>
            </div>
            <div class="input-box">
                <input type="time" id="start_time" name="start_time" required>
                <label for="start_time" style="color: aliceblue;">Open Time:</label>
            </div>
            <div class="input-box">
                <input type="time" id="end_time" name="end_time" required>
                <label for="end_time" style="color: aliceblue;">Close Time:</label>
            </div>

            <button type="submit" class="btnLogin">Update</button>
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo "<font color=blue>$message; </font>"?></div>
        <?php endif; ?>
    </div>
</div>

<script>
    function limitNumberInput(event, maxLength) {
        const input = event.target;
        const inputValue = input.value.replace(/\D/g, '');
        const limitedValue = inputValue.substring(0, maxLength);
        input.value = limitedValue;
    }
</script>

<script>
    // Get the preview image and file input elements
    const previewImage = document.getElementById('preview-image');
    const fileInput = document.getElementById('profile-picture-input');

    // Add a click event listener to the preview image
    previewImage.addEventListener('click', function() {
        // Trigger a click event on the file input field
        fileInput.click();
    });

    // Listen for changes in the file input
    fileInput.addEventListener('change', function(event) {
        // Get the selected file
        const file = event.target.files[0];

        // Create a FileReader instance
        const reader = new FileReader();

        // Set the image source when the file is loaded
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
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
</body>
</html>
