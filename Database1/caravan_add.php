<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Caravan - RentMyCaravan.io</title>
    <?php 
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'test_1';

    $conn = new mysqli("localhost", "root", "root", "test_1");
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="header">
        <a href="logout.php" class="logOutButton">Log Out</a>
        <!-- Your other header content -->
    </header>
    <section class="add-caravan-section">
        <div class="container">
            <h2 class="heading">Add Caravan</h2>
            <form action="addvehicledetails.php" method="POST" class="add-caravan-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="make">Make</label>
                        <input type="text" id="make" name="vehicle_make" required> <!-- Changed name to 'vehicle_make' -->
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" id="model" name="vehicle_model" required> <!-- Changed name to 'vehicle_model' -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="body_type">Body Type</label>
                        <input type="text" id="body_type" name="vehicle_bodytype" required>
                    </div>
                    <div class="form-group">
                        <label for="fuel_type">Fuel Type</label>
                        <input type="text" id="fuel_type" name="fuel_type" required>
                    </div>
                </div> <!-- This closing tag was missing -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="mileage">Mileage</label>
                        <input type="number" id="mileage" name="mileage" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" id="year" name="year" required pattern="\d{4}"> <!-- If you want exactly 4 digits -->
                </div>
                <div class="form-group">
                    <label for="doors">Doors</label>
                    <input type="number" id="doors" name="num_doors" required>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL</label>
                    <input type="url" id="image_url" name="image_url" required placeholder="http://example.com/image.jpg">
                </div>                
              
                <div class="form-group">
                    <button type="submit" class="btn-add-caravan">Add Caravan</button>
                </div>
            </form>
        </div>
    </section>
    <footer class="footer">
        <!-- Footer content -->
    </footer>
</body>
</html>
