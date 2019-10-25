<?php

session_start();

// Test the session to see if is_auth flag was set (meaning they logged in successfully)
// If test fails, send the user to login.php and prevent rest of page being shown.
if (!isset($_SESSION["is_auth"])) {
	header("location: login.php");
	exit;
}
else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == "true") {
	// At any time we can logout by sending a "logout" value which will unset the "is_auth" flag.
	// We can also destroy the session if so desired.
	unset($_SESSION['is_auth']);
	session_destroy();

	// After logout, send them back to login.php
	header("location: login.php");
	exit;
}

?>