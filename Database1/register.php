<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli("localhost", "root", "root", "test_1");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assign and sanitize input variables directly
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    $address2 = isset($_POST['address2']) ? mysqli_real_escape_string($conn, $_POST['address2']) : '';
    $address3 = isset($_POST['address3']) ? mysqli_real_escape_string($conn, $_POST['address3']) : '';
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an insert statement for all fields
    $sql = "INSERT INTO Users (title, gender, firstName, lastName, username, password, email,
            telephone, address1, address2, address3, postcode, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssss", $title, $gender, $firstName, $lastName, $username, $hashed_password, $email,
                                      $telephone, $address1, $address2, $address3, $postcode, $description);

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect to a new page after successful registration
        header("Location: WelcomePage-Before.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
