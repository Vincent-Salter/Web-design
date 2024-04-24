<?php
// Start a new session
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "root", "test_1");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Clean the data to prevent SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the database for user
    $sql = "SELECT User_ID, password FROM Users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch associative array
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, so start a new session
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['User_ID'];
            $_SESSION['username'] = $username;                            

            // Redirect user to welcome page
            header("location: WelcomePage-After1.php");
            exit();
        } else {
            // Display an error message if password is not valid
            echo "The password you entered was not valid.";
        }
    } else {
        // Display an error message if username doesn't exist
        echo "No account found with that username.";
    }
    $conn->close();
}
?>