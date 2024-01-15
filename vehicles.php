<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>EVehicles Store</title>
</head>
<body>

<header>
        <nav>
            <div><a class="logo-icon" href="home.php"><img src="img/logo-no-background.png" alt="logo Icon"></a> </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="vehicles.php">Vehicles</a></li>
                <li><a href="chargestation.php">Charging Stations</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="profile-icon"><a href="profile.php"><img src="img/profile.png" alt="Profile Icon"></a></div>
            <div class="profile-icon"><a href="typeofuser.php"><img src="img/login.png" alt="login Icon"></a></div>
        </nav>
    </header>

    <section id="vehicles" class="container">
        <h2>Electric Vehicles</h2>
        <div class="vehicle">
            <img src="img/electric-car1.webp" alt="Electric Car 1">
            <div class="vehicle-details">
                <h2>Electric Car Model 1</h2>
                <p>An eco-friendly electric car with advanced features.</p>
                <a href="shopin.php"><button>View Details </button></a>
            </div>
        </div>

        <div class="vehicle">
            <img src="img/electric-car2.jpg" alt="Electric Car 2">
            <div class="vehicle-details">
                <h2>Electric Car Model 2</h2>
                <p>Experience the future of transportation with this electric car.</p>
                <a href="shopin.php"><button>View Details </button></a>
            </div>
        </div>
        <!-- Add more vehicle entries as needed -->
    </section>
    <section id="chargers" class="container">
        <h2>Electric Vehicle Chargers</h2>
    

        <div class="charger">
            <h2>Solar-Powered (Type 1 Ev)</h2>
            <p>Charge your electric vehicle using clean energy from our solar-powered charging station. Supports multiple international charging connectors.</p>
            <a href="shopin.php"><button>View Details </button></a>
        </div>

        <div class="charger">
            <h2>Fast Charging (Type 2 EV)</h2>
            <p>Charge your electric vehicle quickly and efficiently at our fast charging station. Compatible with various international charging standards.</p>
            <a href="shopin.php"><button>View Details </button></a>
        </div>
    

    
        <!-- Add more charging station entries as needed with information about compatibility -->
    </section>
    
    <footer class="mt-5">
    <div class="FooterContainer">
    <div class="row">
        <div class="col l6 s12 footer-links">
            <ul>
                <li>
                    <a href="contact.php"><i>Contact Us</i></a>
                </li>
                <li>
                    <a href="Aboutus.php"><i>About Us</i></a>
                </li>
            </ul>
        </div>
    </div>
</div>

                <div class="col l4 offset-l2 s12 social-icons">
    <ul class="social-list">
        <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i><img src="img/facebook.png" alt="facebook Icon"></a></li>
        <li><a href="https://twitter.com/"><i class="fab fa-twitter"></i> <img src="img/twitter.png" alt="twitter Icon"></a></li>
        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i> <img src="img/instagram.png" alt="instagram Icon"></a></li>
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
