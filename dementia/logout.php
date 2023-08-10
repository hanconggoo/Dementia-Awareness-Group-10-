<?php
// logout.php

// Start the session (if it's not already started)
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect the user to the login page after logout
header("Location: report.html");
exit;
?>
