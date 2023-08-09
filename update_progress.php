<?php
// Replace these with your actual database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "assignment";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
session_start();
if (isset($_SESSION["login_success"]) && $_SESSION["login_success"] === true) {
  $email = $_SESSION["email"];
  $section = $_POST["section"]; // Get the section value from the POST request

  // Update the progress in the database based on the section
  switch ($section) {
    case 1:
      $sql = "UPDATE users SET progress1 = 100 WHERE email = ?";
      break;
    case 2:
      $sql = "UPDATE users SET progress2 = 100 WHERE email = ?";
      break;
    case 3:
      $sql = "UPDATE users SET progress3 = 100 WHERE email = ?";
      break;
    default:
      // Invalid section value, handle accordingly
      echo json_encode(array("error" => "Invalid section value."));
      exit;
  }

  // Prepare and execute the SQL statement
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  if ($stmt->execute()) {
    // Progress update successful
    echo json_encode(array("success" => true));
  } else {
    // Progress update failed
    echo json_encode(array("error" => "Failed to update progress."));
  }

  $stmt->close();
} else {
  // User is not logged in
  echo json_encode(array("error" => "User not logged in."));
}

$conn->close();
?>
