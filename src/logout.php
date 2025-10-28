<?php
// 1. Start the session
session_start();

// 2. Clear all session variables
$_SESSION = array();

// 3. Completely destroy the session on the server and in the browser
session_destroy();

// 4. Send the user back to the homepage
header("Location: index.php"); 
exit;
?>