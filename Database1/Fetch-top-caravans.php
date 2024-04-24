<?php
// Connection parameters
$db_host = 'localhost';
$db_user = 'root'; 
$db_password = 'root'; 
$db_db = 'test_1'; 

// Set headers for JSON output
header('Content-Type: application/json');

// Create connection using mysqli
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

// Check connection
if ($mysqli->connect_errno) {
    echo json_encode(['error' => 'Failed to connect to MySQL: ' . $mysqli->connect_error]);
    exit(); // Ensure no further execution on connection fail
}

// Query to fetch top 3 caravans
$sql = "SELECT * FROM vehicle_details ORDER BY user_id DESC LIMIT 3";
$result = $mysqli->query($sql);

$caravans = [];

if ($result) {
    // Fetch rows and add to $caravans array
    while ($row = $result->fetch_assoc()) {
        $caravans[] = $row;
    }
    // Free result set
    $result->free();
} else {
    // On query error, output an error message and stop script
    echo json_encode(['error' => 'Query Error: ' . $mysqli->error]);
    $mysqli->close();
    exit();
}

// Close connection
$mysqli->close();

// Encode and output the caravans data
echo json_encode($caravans);
?>
