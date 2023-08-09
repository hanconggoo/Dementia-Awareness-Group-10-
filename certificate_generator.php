<?php
require('tcpdf/tcpdf.php');

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

    // Retrieve the user's name from the database
    $nameFromDatabase = ""; // Initialize the variable

    // Prepare and execute the query
    $query = "SELECT uName FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nameFromDatabase = $row['uName'];
    }

    $stmt->close();

    // Continue with the certificate generation using the retrieved name

    $date = $_POST['date'];

    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', true);

    $pdf->SetTitle('Certificate of Completion');

    $pdf->AddPage();

    // Set a custom font for the title and content
    $pdf->SetFont('times', 'B', 36);
    $pdf->Cell(0, 15, 'Certificate of Completion', 0, 1, 'C');

    // Set a different font for the rest of the text
    $pdf->SetFont('times', '', 24);

    $pdf->Ln(20);

    $pdf->writeHTML("
    <style>
        * {
            text-align: center;
            font-family: 'Arial', sans-serif;
        }
        h2 {
            font-size: 36px;
            margin: 20px 0;
            font-family: 'Times', serif;
        }
        p {
            font-size: 24px;
            margin: 10px 0;
            font-family: 'Times', serif;
        }
    </style>
    <p>This certifies that</p>
    <h2>$nameFromDatabase</h2>
    <p>has successfully completed the</p>
    <h2>Dementia Awareness</h2>
    <p>on $date</p>
    ");

    // Add a decorative border around the certificate
    $pdf->SetLineStyle(array('width' => 1, 'color' => array(0, 0, 0)));
    $pdf->Rect(10, 40, $pdf->getPageWidth() - 20, $pdf->getPageHeight() - 80);

    // Provide a filename for the generated PDF
    $filename = $nameFromDatabase . '-certificate.pdf';

    // Output the PDF to the browser for download
    $pdf->Output($filename, 'D');
}

$conn->close();
?>
