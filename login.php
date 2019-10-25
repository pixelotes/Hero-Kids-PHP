<?php
	include './functions.php'; //Necesario para conectarse a la BD
	
	// First start a session. This should be right at the top of your login page.
	session_start();

	// Check to see if this run of the script was caused by our login submit button being clicked.
	if (isset($_POST['login-submit'])) {

		// Also check that our email address and password were passed along. If not, jump
		// down to our error message about providing both pieces of information.
		if (isset($_POST['emailaddress']) && isset($_POST['pass'])) {
			$email = $_POST['emailaddress'];
			$pass = $_POST['pass'];

			
			// Connect to the database and select the user based on their provided email address.
			// Be sure to retrieve their password and any other information you want to save for the user session.

			$db = getDatabase();
			$result = $db->query("select id, email, password, name, level FROM users WHERE email='".$email."' LIMIT 1"); 
			$db = null;			
			foreach($result as $row)
			{

					//echo $email;
					//echo $pass;
					// If the user record was found, compare the password on record to the one provided hashed as necessary.
					// If successful, now set up session variables for the user and store a flag to say they are authorized.
					// These values follow the user around the site and will be tested on each page.
					if (($row !== false)) {
						if ($row['password'] == hash('sha256', $pass)) {

							// is_auth is important here because we will test this to make sure they can view other pages
							// that are needing credentials.
							$_SESSION['is_auth'] = true;
							$_SESSION['user_level'] = $row['level'];
							$_SESSION['user_id'] = $row['id'];
							$_SESSION['name'] = $row['name'];

							// Once the sessions variables have been set, redirect them to the landing page / home page.
							header('location: index.php');
							exit;
						}
						else {
							$error = "Usuario o contraseña inválidos. Inténtalo de nuevo.";
						}
					}
					else {
						$error = "Usuario o contraseña inválidos. Inténtalo de nuevo.";
					}
			}
		}
		else {
			$error = "Introduce tu usuario y contraseña para iniciar sesión.";
		}
	}
?>
<!-- This form will post to current page and trigger our PHP script. -->
<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="css/estilos.css" />
<style>
body {
		background-image: url("assets/fondo1.jpg");
		 background-repeat: no-repeat;
		 background-size: cover;
	}
</style>
</head>
<body>
<center><div id="login-title"><img src="./resources/logo.png"></img></div></center>
<center><form method="post" action="">
	<div class="login-body">
		<?php
			if (isset($error)) {
				echo "<div class='errormsg'>$error</div>";
			}
		?>
		<div class="form-row">
			<label for="emailaddress">Usuario:</label>
			<input type="text" name="emailaddress" id="emailaddress" placeholder="Usuario" maxlength="100">
		</div>
		<div class="form-row">
			<label for="pass">Contraseña:</label>
			<input type="password" name="pass" id="pass" placeholder="Contraseña" maxlength="100">
		</div>
		<br/>
		<div class="login-button-row">
			<center><input type="submit" name="login-submit" id="login-submit" value="Login" title="Login now"></center>
		</div>
	</div>
</form>
</center>
</body>
</html>