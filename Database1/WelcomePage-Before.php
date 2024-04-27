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
</head>
<style>

	
	
	.caravan-listing {
  border: 1px solid #ccc; /* Border style */
  width: 300px; /* Width of each listing */
  height: auto; /* Height can adjust based on content */
  margin: 10px; /* Spacing between listings */
  padding: 10px; /* Padding inside each listing */
  cursor: pointer; /* Show pointer cursor on hover */
  display: flex; /* Use flexbox layout */
  flex-direction: column; /* Arrange content vertically */
}

.caravan-listing h3 {
  margin: 0; /* Remove margin for heading */
}

.caravan-listing p {
  margin: 5px 0; /* Adjust spacing for paragraphs */
}

.caravan-listing img {
  max-width: 100%; /* Make sure images don't exceed container width */
  height: auto; /* Maintain aspect ratio */
  margin-top: 10px; /* Spacing between image and other content */
}



.modal {
  display: none; /* Hide the modal by default */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4); /* Black background with opacity */
}

.modal-content {
  background-color: #fefefe;
  margin: 10% auto; /* Center modal on screen */
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* Close button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
	
</style>

<script>
    function redirectToLoginPage() {
        window.location.href = "login.html";
    }
	
	function redirectToRegisterPage() {
        window.location.href = "Registration-Page.html";
    }
	
</script>
	
<body>
    <div class="titleDiv">RentMy Caravan
		<div class="signUpButton" onclick="redirectToRegisterPage()">Get Started</div>
		<div class="loginButton" onclick="redirectToLoginPage()">Log In</div>
			<div id="loginModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <!-- Add your login form here -->
    <form id="loginForm">
      <!-- Your login form fields -->
      <input type="text" placeholder="Username" id="username">
      <input type="password" placeholder="Password" id="password">
      <button type="submit">Login</button>
    </form>
  </div>
</div>
	</div>
	<div class="imgWelcome"> 
		<div class="introPara">
		<div class="welcomeText"> Welcome to <b> RentMy Caravan </b> </div>
		a platform for local residents and businesses to advertise their caravans that need to be rented
		</div>
		<div class="signUpButton2" onclick="redirectToRegisterPage()"><h3>Get Started</h3> </div>
	</div>
	
 <!-- Script to fetch caravan data and dynamically generate listings -->
    <script>
        // Make an AJAX request to fetch the caravans data
        fetch('Fetch_top_caravans.php')
          .then(response => response.json())
          .then(data => {
            // Loop through the fetched data and generate HTML content
            data.forEach(caravan => {
              const container = document.createElement('div');
              container.classList.add('caravan-listing');
              container.onclick = function() {
                redirectToCaravanPage('caravan_details.php?id=' + caravan.id); 
              };
              container.innerHTML = `
                <div class="caravan-details">
                    <h3>Make: ${caravan.vehicle_make}</h3>
                    <p>Model: ${caravan.vehicle_model}</p>
                    <p>Body Type: ${caravan.vehicle_bodytype}</p>
                    <img src="${caravan.image_url}" alt="Caravan Image">
                </div>`;
              document.getElementById('caravans-container').appendChild(container);
            });
          })
          .catch(error => console.error('Error fetching caravans:', error));

        // Function to redirect to caravan details page
        function redirectToCaravanPage(url) {
            window.location.href = url;
        }
    </script>

	<script>
	// Get the modal
var modal = document.getElementById('loginModal');

// Get the login button that opens the modal
var loginButton = document.querySelector('.loginButton');

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
loginButton.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Function to close the modal
function closeModal() {
  modal.style.display = "none";
}

	</script>
	
	
</body>
</html>