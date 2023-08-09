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


// Check if the email session variable is set before using it
if (isset($_SESSION["email"])) {
  $user_email = $_SESSION["email"];

  // Retrieve user's scores from the database
  $sql = "SELECT score_topic1, score_topic2, score_topic3 FROM users WHERE email = '$user_email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $score_topic1 = $row["score_topic1"];
      $score_topic2 = $row["score_topic2"];
      $score_topic3 = $row["score_topic3"];
  } else {
      $score_topic1 = 0;
      $score_topic2 = 0;
      $score_topic3 = 0;
  }
} else {
  // Handle the case when the user is not logged in
  $score_topic1 = 0;
  $score_topic2 = 0;
  $score_topic3 = 0;
}

// Check if the user is logged in and scores are 100%
$loggedIn = isset($_SESSION["login_success"]) && $_SESSION["login_success"] === true;
$scoresAreValid = $score_topic1 == 100 && $score_topic2 == 100 && $score_topic3 == 100;
$current_topic_scores = array(
  "Dementia Symptoms" => $score_topic1,
  "Dealing with Dementia Behaviors" => $score_topic2,
  "Communication Tips" => $score_topic3
);?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="certificate.css" />
<head>
  <title>Certificate Generator</title>

</head>
<body>
<div class="container">
    <h2 style="margin-bottom: 20px;">Certificate Generator</h2>
    <?php if ($loggedIn && $scoresAreValid) : ?>
      <form method="post" action="certificate_generator.php">
        <div class="form-group">
          <label class="form-label">Date:</label>
          <input class="form-input" type="date" name="date">
        </div>
        <button class="form-button" type="submit">Generate Certificate</button>
      </form>
    <?php elseif (!$loggedIn) : ?>
      <p style="color: red;"><strong>Please log in before using the certificate generator.</p>
    <?php elseif (!$scoresAreValid) : ?>
      <p style="color: red;"><strong>You must achieve 100% scores in all topics to access the certificate generator.</p>
      <p style="color: red;"><strong>Your current topic scores:</p>
      <ul>
        <?php foreach ($current_topic_scores as $topic => $score) : ?>
          <li style="color: red; text-align:left;"><strong><?php echo "$topic: $score%"; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</body>
</html>
