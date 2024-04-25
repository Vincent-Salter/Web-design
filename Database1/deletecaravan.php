<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "You are not logged in.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'test_1';
    $vehicleId = $_POST['vehicle_id'];
    $userId = $_SESSION['id'];

    $conn = new mysqli($db_host, $db_user, $db_password, $db_db);

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        exit;
    }

    // Make sure the vehicle belongs to the user
    $stmt = $conn->prepare("SELECT * FROM vehicle_details WHERE vehicle_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $vehicleId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "No such caravan found or you don't have permission to delete this caravan.";
        $stmt->close();
        $conn->close();
        exit;
    }

    // Perform the deletion
    $stmt = $conn->prepare("DELETE FROM vehicle_details WHERE vehicle_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $vehicleId, $userId);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        echo "Error deleting caravan.";
    } else {
        echo "Caravan deleted successfully.";
    }

    $stmt->close();
    $conn->close();
}
?>
