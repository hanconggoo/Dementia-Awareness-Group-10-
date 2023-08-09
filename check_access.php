<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["login_success"]) && $_SESSION["login_success"] === true) {
  // Fetch the user's progress from the database
  $email = $_SESSION["email"];
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "assignment";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT progress1, progress2, progress3 FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $progress1 = $row["progress1"]; 
    $progress2 = $row["progress2"]; 
    $progress3 = $row["progress3"]; 
    if ($progress1 === 100 && $progress2 === 100 && $progress3 === 100) {
      echo "grant_access"; // Signal to JavaScript that access is granted
    } else {
      echo "incomplete"; // Signal that progress is incomplete
    }
  } else {
    echo "error"; // Signal an error
  }
  
  $stmt->close();
  $conn->close();
} else {
  echo "not_logged_in"; // Signal that user is not logged in
}
?>
