<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" href="CSS-file.css">
</head>

<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test_1';

$conn = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vehicle_id'])) {
    $vehicleId = $_POST['vehicle_id'];

    $sql = "DELETE FROM vehicle_details WHERE vehicle_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vehicleId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Caravan deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting caravan.');</script>";
    }

    $stmt->close();
    // Do not close the connection here if it's needed further down
}

// Fetch caravans
$userId = $_SESSION['id'];
$sql = "SELECT vehicle_id, image_url, video_url, vehicle_summary FROM vehicle_details WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$caravanDetails = [];
while ($row = $result->fetch_assoc()) {
    $caravanDetails[] = $row;
}

$stmt->close();
$conn->close();

function emphasize_keywords($summary) {
    $keywords = ['Make:', 'Model:', 'Body Type:', 'Fuel Type:', 'Mileage:', 'Location:', 'Year:', 'Doors:'];
    foreach ($keywords as $keyword) {
        $summary = str_replace($keyword, "<strong>$keyword</strong>", $summary);
    }
    return $summary;
}

?>
<style>
    

		/* Dashboard Page */

        .caravanListContainer {
    	width: 100%;
    	padding: 20px;
    	box-sizing: border-box;
		}

		.caravanItem {
    	display: flex;
    	background-color: #fff; /* Or any color you prefer */
    	border: 1px solid #ccc;
   		border-radius: 5px;
    	margin-bottom: 20px; /* Space between items */
    	overflow: hidden; /* Keeps the child elements inside the container */
		}
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
			display: flex; 
			align-items: center; 
		}

		.addCaravanPicture {
			width: 5%;
			height:20%;
			margin-left: 10px; 
			background-image: url('Add.png'); 
			background-size: 50%; 
			background-position: center; 
			background-repeat: no-repeat; 
		}

		.caravanListContainer {
			border: 1px black solid;
			border-radius: 5px;
			width: 91.1%;
			height: auto;
			margin: 80px auto;
			display: flex; 
		}

		.caravanDetailsContainer {
			display: flex; 
			align-items: flex-start; 
			margin-bottom: 20px; 
		}

		.caravanImage {
			width: 30%;
			background-size: cover;
			background-position: center;
			position: relative;
		}

		.caravanSummary {
			width: 45%;
			padding: 10px;
		}
		.caravanButtons {
			width: 25%;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			padding: 10px;
		}

		.caravanEditButton {
			background-color: #00DD00;
			color: white;
			margin-bottom: 10px;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.caravanDeleteButton {
			background-color: red;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
</style>

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
    
  <!-- Single Caravan Listing Container -->
<div class="caravanListContainer">
    <?php foreach ($caravanDetails as $caravan): ?>
    <div class="caravanItem">
        <div class="caravanImage" style="background-image: url('<?php echo htmlspecialchars($caravan['image_url']); ?>');">
            <!-- Optional: If you want to add video link or other details, do it here -->
        </div>
        <div class="caravanSummary">
    <p>Summary: <?php echo emphasize_keywords(htmlspecialchars($caravan['vehicle_summary'])); ?></p>
</div>
        <div class="caravanButtons">
            <div class="caravanEditButton" onclick="redirectToCaravanAddPage()">Edit Details</div>
            <div class="caravanDeleteButton" onclick="handleDelete(this)" data-vehicle-id="<?php echo htmlspecialchars($caravan['vehicle_id']); ?>">Delete</div>

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


    function handleDelete(element) {
    var vehicleId = element.getAttribute('data-vehicle-id');
    if (confirm("Are you sure you want to delete this caravan?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "deletecaravan.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(xhr.responseText);
                // Refresh the page to reflect changes
                location.reload(); // This line refreshes the page
            }
        };
        xhr.send("vehicle_id=" + vehicleId);
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