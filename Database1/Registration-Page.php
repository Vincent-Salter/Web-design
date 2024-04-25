<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
	<?php 
    $db_host = 'localhost';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'test_1';

    $conn = new mysqli("localhost", "root", "root", "test_1");
    ?>
    <link rel="stylesheet" href="CSS-file.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="titleDiv">RentMy Caravan</div>
	<div class="formName">Register Form</div>
	<form class="registerForm" action="register.php" method="post">
		<div class="form-content">
			<!-- Input group for T -->
			<div class="input-group">
				<div class="label-group">
					<label for="title">Title<span>*</span> :</label>
				</div>
				<select id="title" name="title" class="small-input" required>
					<option value="" disabled selected>Select</option>
					<option value="Mr.">Mr.</option>
					<option value="Mrs.">Mrs.</option>
					<option value="Miss">Miss</option>
					<option value="Dr.">Dr.</option>
					<option value="Mx.">Mx.</option>
				</select>
			</div>

			<!-- Input group for Gender -->
			<div class="input-group">
				<div class="label-group">
					<label for="gender">Gender :</label>
				</div>
				<select id="gender" name="gender" class="small-input">
					<option value="" disabled selected>Select</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Non-binary">Non-binary</option>
					<option value="Prefer-Not-To-Say">Prefer not to say</option>
				</select>
			</div>


					<!-- Input group for First Name -->
			<div class="input-group">
				<div class="label-group">
					<label for="firstName">First Name<span>*</span> :</label>
				</div>
				<input type="text" id="firstName" name="firstName" class="large-input" placeholder="Enter First Name" required maxlength="50">
			</div>

			<!-- Input group for Last Name -->
			<div class="input-group">
				<div class="label-group">
					<label for="lastName">Last Name<span>*</span> :</label>
				</div>
				<input type="text" id="lastName" name="lastName" class="large-input" placeholder="Enter Last Name" required maxlength="50">
			</div>

			<!-- Input group for Username -->
			<div class="input-group">
				<div class="label-group">
					<label for="username">Username<span>*</span> :</label>
				</div>
				<input type="text" id="username" name="username" class="large-input" placeholder="Choose a Username" required maxlength="50">
			</div>
						
			<!-- Input group for Password -->
			<div class="input-group">
				<div class="label-group">
					<label for="password">Password<span>*</span> :</label>
				</div>
				<input type="password" id="password" name="password" class="large-input" placeholder="Choose a Password"required maxlength="50">
			</div>

			<!-- Input group for Email -->
			<div class="input-group">
				<div class="label-group">
					<label for="email">Email<span>*</span> :</label>
				</div>
				<input type="email" id="email" name="email" class="large-input"placeholder="Enter Email" required maxlength="50">
			</div>

			<!-- Input group for Telephone -->
			<div class="input-group">
				<div class="label-group">
					<label for="telephone">Telephone<span>*</span> :</label>
				</div>
				<input type="tel" id="telephone" name="telephone" class="large-input" placeholder="Enter Telephone"required maxlength="50">
			</div>

			<!-- Input group for Address Line 1 -->
			<div class="input-group">
				<div class="label-group">
					<label for="address1">Address Line 1<span>*</span> :</label>
				</div>
				<input type="text" id="address1" name="address1" class="large-input" placeholder="Enter Address"required maxlength="100">
			</div>

			<!-- Input group for Address Line 2 -->
			<div class="input-group">
				<div class="label-group">
					<label for="address2">Address Line 2 :</label>
				</div>
				<input type="text" id="address2" name="address2" class="large-input" placeholder="" maxlength="150">
			</div>
			
			<!-- Input group for Address Line 3 -->
			<div class="input-group">
				<div class="label-group">
					<label for="address3">Address Line 3 :</label>
				</div>
				<input type="text" id="address3" name="address3" class="large-input" placeholder=""  maxlength="150">
			</div>

			<!-- Input group for Postcode -->
			<div class="input-group">
				<div class="label-group">
					<label for="postcode">Postcode<span>*</span> :</label>
				</div>
				<input type="text" id="postcode" name="postcode" class="large-input"placeholder="Enter a Postcode" required maxlength="50">
			</div>


			<div class="input-group">
				<div class="label-group">
					<label for="profileURL">Profile URL :</label>
				</div>
				<input type="text" id="porofileURL" name="profileURL" class="large-input"placeholder="Enter a Profile URL" maxlength="50">
			</div>

			<!-- Input group for Description -->
			<div class="input-group">
				<div class="label-group">
					<label for="description">Description<span>*</span> :</label>
				</div>
				<textarea id="description" name="description" class="large-input" rows="3" placeholder="Enter a Description"rrequired maxlength="200"></textarea>
			</div>
		<div class="registerButtonContainer">
    <input type="submit" class="registerButton" value="Register" name="Register">
</div>
	</form>
    
</body>
</html>
