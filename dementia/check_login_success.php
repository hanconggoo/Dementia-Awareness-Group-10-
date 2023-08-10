<?php

session_start();

if (isset($_SESSION["login_success"]) && $_SESSION["login_success"] === true) {
  // Return "true" if the user is logged in
  echo "true";
} else {
  // Return "false" if the user is not logged in or the session variable is not set
  echo "false";
}
?>
