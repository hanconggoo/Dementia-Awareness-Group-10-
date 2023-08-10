<?php

// Connect to the database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "assignment";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();
if (isset($_SESSION["login_success"]) && $_SESSION["login_success"] === true) {
  $email = $_SESSION["email"];
  
  // Get the topic and score from the POST request
  $chosenTopic = $_POST['topic'];
  $percentageScore = $_POST['score'];

  // Determine the column to update based on the chosen topic
  $updateColumn = "";
  if ($chosenTopic === "symptoms") {
    $updateColumn = "score_topic1";
  } elseif ($chosenTopic === "behaviors") {
    $updateColumn = "score_topic2";
  } elseif ($chosenTopic === "communication") {
    $updateColumn = "score_topic3";
  }

  if (empty($updateColumn)) {
    $response['success'] = false;
    $response['error'] = "Invalid topic";
  } else {
    $sql = "UPDATE users SET $updateColumn='$percentageScore' WHERE email='$email'";
    if ($conn->query($sql) !== TRUE) {
      $response['success'] = false;
      $response['error'] = "Error updating score";
    } else {
      $response['success'] = true;
    }
  }

  // Send the JSON response
  header("Content-Type: application/json");
  // Log the response before sending it
  error_log(json_encode($response));

  // Send the JSON response
  echo json_encode($response);

  // Terminate the script
  exit();
}

$conn->close();
?>
