<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "assignment";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch progress data from the users table
session_start();
if (isset($_SESSION["login_success"]) && $_SESSION["login_success"] === true) {
  $email = $_SESSION["email"];
  $sql = "SELECT progress1, progress2, progress3 FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $progressData = array(
      "progress1" => $row["progress1"],
      "progress2" => $row["progress2"],
      "progress3" => $row["progress3"]
    );
    echo json_encode($progressData);
  } else {
    // User not found in the database
    echo json_encode(array("progress1" => 0, "progress2" => 0, "progress3" => 0));
  }

  $stmt->close();
} else {
  // User is not logged in
  echo json_encode(array("progress1" => 0, "progress2" => 0, "progress3" => 0));
}

$conn->close();
?>
