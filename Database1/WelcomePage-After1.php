<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");  // Redirect to the login page
    exit();  // Terminate further script execution
}

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test_1';

$conn = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch caravans belonging to the logged-in user
$userId = $_SESSION['id']; // Assuming this is set upon login
$sql = "SELECT image_url, video_url, vehicle_summary FROM vehicle_details WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId); // "i" denotes the parameter type is integer
$stmt->execute();
$result = $stmt->get_result();

$caravanDetails = [];
while ($row = $result->fetch_assoc()) {
    $caravanDetails[] = $row;
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <?php 
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'test_1';

    $conn = new mysqli("localhost", "root", "root", "test_1");
    ?>
    <link rel="stylesheet" href="CSS-file.css">
    <style>
.logOutButton {
	border: 1px black solid;
	width: 15%;
	float: right;
	text-align: center;
	background-color: #D8D8D8;
	color: #000;
	border: none;
	border-radius: 5px;
	cursor: pointer;    
}

.caravanList{
	border-bottom:1px black solid;
    width: 91.1%;
    height: 20%;
	padding: 10px;
	margin: 10px auto;
	font-weight: 700;
}

.addCaravanButton {
    width: 91.1%;
    float: left;
    height: 20%;
    padding: 10px;
    color: #00DD00;
    margin: 10px auto auto 50px;
    font-weight: 700;
    display: flex; /* Use flexbox for better alignment */
    align-items: center; /* Center items vertically */
}

.addCaravanPicture {
    width: 5%;
	height:20%;
    margin-left: 10px; /* Add some space between the text and the image */
    background-image: url('Add.png'); /* Fix the path and remove alt attribute */
    background-size: 50%; /* Adjust image size as a percentage of the container */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent image from repeating */
}

.caravanListContainer {
    border: 1px black solid;
    border-radius: 5px;
    width: 91.1%;
    height: auto;
    margin: 80px auto;
    display: flex; /* Use flexbox layout */
}

.caravanDetailsContainer {
    display: flex; /* Use flexbox layout */
    align-items: flex-start; /* Align items at the start of the container */
    margin-bottom: 20px; /* Add space between each set of caravan details */
}

.caravanImage {
    /* Remove border and other styling */
    width: 30%;
    height: auto;
    margin-right: 10px;
    padding: 10px;
    cursor: pointer;
    text-align: center;
    font-size: 18px;
    background-size: cover; /* Ensure the image covers the entire container */
    background-position: center; /* Center the image within the container */
}

.caravanSummary {
    border: 1px solid #ccc; 
	border-radius:5px;
    width: 60%;
    height: auto;
    margin: 10px;
    padding: 10px;
}

.caravanButtons{
    width: 18%;
    height: auto;
    margin: 10px;
    padding:0px;
}

.caravanEditButton{
	border: 1px solid #ccc;
	border-radius: 5px;
    width: 50%;
    height: auto;
    padding:5px;
	margin:auto;
	font-size:18px;
	text-align: center;
	background-color: #00DD00;
	color: #fff;
	cursor: pointer;
}

.caravanDeleteButton{
	border: 1px solid #ccc;
	border-radius: 5px;
    width: 50%;
    height: auto;
    padding:5px;
	margin: 10px auto;
	font-size:18px;
	text-align: center;
	background-color: red;
	color: #fff;
	cursor: pointer;
}
        
    </style>
</head>
<body>
<div id="user-id"></div> 
<div class="titleDiv">RentMy Caravan
    <a href="logout.php" class="logOutButton">Log Out</a>
</div>
    <div class="imgWelcome"> 
        <div class="introPara">
            <div class="welcomeText"> Welcome to <b> RentMy Caravan </b> </div>
            a platform for local residents and businesses to advertise their caravans that need to be rented
        </div>
    </div>
    <div class="caravanList"> Your Caravan List </div>
    <div class="addCaravanButton" onclick="redirectToCaravanAddPage()"> Add Caravan 
        <div class="addCaravanPicture">&nbsp;</div>
    </div>
    
    <div class="caravanListContainer">
    <?php foreach ($caravanDetails as $caravan): ?>
    <div class="caravanDetailsContainer"> <!-- Wrap each set of caravan details in a container -->
    <div class="caravanImage" style="background-image: url('<?php echo htmlspecialchars($caravan['image_url']); ?>');">
    <p>Caravan Video: <?php echo htmlspecialchars($caravan['video_url']); ?></p>
</div>
        <div class="caravanSummary">
            <p>Summary: <?php echo htmlspecialchars($caravan['vehicle_summary']); ?></p>
        </div>
        <div class="caravanButtons">
            <div class="caravanEditButton" onclick="redirectToCaravanAddPage()">Edit Details</div>
            <div class="caravanDeleteButton" onclick="handleDelete()">Delete</div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
	
	<script>
	
	function redirectToCaravanAddPage() {
    window.location.href = "caravan_add.php";
	}
	
    function redirectToLogOutPage() {
        window.location.href = '?logout=true';
    }


    function handleDelete() {
        if (confirm("Are you sure you want to delete this caravan?")) {
        console.log("Caravan deleted");
        // Add your code here to delete the caravan
            }
        }
        </script>
        <script>
        const userIdContainer = document.getElementById('user-id');
        if (userIdContainer) {
          const userId = <?php echo isset($_SESSION['id']) ? json_encode($_SESSION['id']) : 'null'; ?>;
          if (userId !== null) {
            userIdContainer.textContent = 'Logged in as user ID: ' + userId;
          } else {
            userIdContainer.textContent = 'Error: No user ID found';
          }
        }
      </script>
</body>
</html>
	
</body>
</html>