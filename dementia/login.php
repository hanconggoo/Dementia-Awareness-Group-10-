<?php

$username = "root";
$password = "";
$dbname = "assignment";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $pWord = $_POST["pWord"]; 

  // Validate user credentials using prepared statements
  $stmt = $conn->prepare("SELECT uName, email, pWord FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["pWord"];
    echo "Hashed Password from Database: " . $hashedPassword . "<br>";
    
    // Verify the password using password_verify()
    if (password_verify($pWord, $hashedPassword)) {
      // Login successful
      session_start();
      $_SESSION["login_success"] = true;
      $_SESSION["email"] = $email;
      header("Location: main.html");
      exit;
    } else {
      // Login failed
      echo "Invalid credentials. Please try again.";
    }

  $stmt->close();
}}

$conn->close();
?>
