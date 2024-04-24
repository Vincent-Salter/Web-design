<?php
session_start(); // Start the session

// Destroy the session
$_SESSION = array(); // Unset all session values
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy(); // Finally, destroy the session.

header("Location: index.html"); // Redirect to the login page
exit();
?>
