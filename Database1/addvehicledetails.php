<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "root", "test_1");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Clean the data to prevent SQL injection and gather data

    $vehicle_make = filter_input(INPUT_POST, 'vehicle_make', FILTER_SANITIZE_STRING);
    $vehicle_model = filter_input(INPUT_POST, 'vehicle_model', FILTER_SANITIZE_STRING);
    $vehicle_bodytype = filter_input(INPUT_POST, 'vehicle_bodytype', FILTER_SANITIZE_STRING);
    $fuel_type = filter_input(INPUT_POST, 'fuel_type', FILTER_SANITIZE_STRING);
    $mileage = filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_STRING);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING); // year as string according to your SQL schema
    $num_doors = filter_input(INPUT_POST, 'num_doors', FILTER_SANITIZE_NUMBER_INT);
    $video_url = filter_input(INPUT_POST, 'video_url', FILTER_SANITIZE_URL);
    $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);
    $vehicle_summary = "Make: {$vehicle_make}, Model: {$vehicle_model}, Body Type: {$vehicle_bodytype}, Fuel Type: {$fuel_type}, Mileage: {$mileage}, Location: {$location}, Year: {$year}, Doors: {$num_doors}";
    
    // Start a new session (if not already started)
    session_start();

    // Fetch user ID from session
    $user_id = $_SESSION['id'];

    // Basic validation (you can expand this based on your requirements)
    if (empty($vehicle_make) || empty($vehicle_model) || empty($year)) {
        echo "Please fill in all required fields.";
    } else {
        // Prepare an insert statement
        $sql = "INSERT INTO vehicle_details (user_id, vehicle_make, vehicle_model, vehicle_bodytype, fuel_type, mileage, location, year, num_doors, video_url, image_url, vehicle_summary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (false === $stmt) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind variables to the prepared statement as parameters
        $bind = $stmt->bind_param("isssssssisss", $user_id, $vehicle_make, $vehicle_model, $vehicle_bodytype, $fuel_type, $mileage, $location, $year, $num_doors, $video_url, $image_url, $vehicle_summary);

        if (false === $bind) {
            die('Bind param failed: ' . htmlspecialchars($stmt->error));
        }

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Vehicle details successfully inserted.";
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        // Close statement
        $stmt->close();
    }
    $conn->close();
}
?>
