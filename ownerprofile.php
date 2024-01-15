<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <!-- Add your additional styles or Bootstrap CDN here if needed -->
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    <title>Edit Profile - EVehicles</title>
</head>
<body>

    <div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" src="img/profile_picture.png" width="90" alt="Profile Image">
                    <span class="font-weight-bold">Moath</span>
                    <span class="text-black-50">abdalrheem</span>
                    <span>location</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back">
                            <i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <h6><a href="home.php">Back to home</a></h6>
                        </div>
                     <h6 class="text-right"><button>Edit Profile</button></h6>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="First Name" value="FirstName" id="FirstName"></div>
                        <div class="col-md-6"><input type="text" class="form-control" value="lastname" placeholder="Last Name" id="LastName"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Email" value="Email" id="email"></div>
                        <div class="col-md-6"><input type="text" class="form-control" value="+YourNumber" placeholder="Phone Number" id="phone"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Account" value="Account"></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="location" value="location"></div>

                    </div>

                    <div class="mt-5 text-right"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
                </div>
            </div>
        </div>
    </div>   
    <section id="tableSection" class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Station Name</th>
                    <th scope="col">Number of Charger</th>
                    <th scope="col">Charger Type</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Station 1</td>
                    <td>3</td>
                    <td>Fast Charger</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="editRow(this)">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <!-- Buttons for Adding, Editing, and Deleting Rows -->
        <div class="text-right mt-2">
            <button class="btn btn-success btn-sm mr-2" onclick="addRow()">Add Row</button>
        </div>
    </section>
      
    <!-- JavaScript to handle row actions -->
    <script>
        function addRow() {
            var tableBody = document.querySelector('#tableSection tbody');
            var newRow = document.createElement('tr');
            newRow.innerphp = `
                <th scope="row">${tableBody.children.length + 1}</th>
                <td>New Station</td>
                <td>5</td>
                <td>New Charger</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="editRow(this)">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        }

        var selectedRowForEditing = null;

        function editRow(button) {
            var row = button.closest('tr');
            var stationName = row.cells[1].textContent;
            var numberOfCharger = row.cells[2].textContent;
            var chargerType = row.cells[3].textContent;

            // Assuming you have input fields for editing, update their values
            document.getElementById('editStationName').value = stationName;
            document.getElementById('editNumberOfCharger').value = numberOfCharger;
            document.getElementById('editChargerType').value = chargerType;

            // You can also keep track of the edited row for further processing
            selectedRowForEditing = row;

            // Scroll to the top to focus on the editing fields
            window.scrollTo(0, 0);
        }

        function saveEdit() {
            // Get values from the editing fields
            var editedStationName = document.getElementById('editStationName').value;
            var editedNumberOfCharger = document.getElementById('editNumberOfCharger').value;
            var editedChargerType = document.getElementById('editChargerType').value;

            // Update the row with the edited values
            selectedRowForEditing.cells[1].textContent = editedStationName;
            selectedRowForEditing.cells[2].textContent = editedNumberOfCharger;
            selectedRowForEditing.cells[3].textContent = editedChargerType;

            // Clear the editing fields
            document.getElementById('editStationName').value = '';
            document.getElementById('editNumberOfCharger').value = '';
            document.getElementById('editChargerType').value = '';

            // Reset the selected row for editing
            selectedRowForEditing = null;
        }

        function deleteRow(button) {
            var row = button.closest('tr');
            row.remove();
        }
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
    <!-- Bootstrap JS (includes Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
