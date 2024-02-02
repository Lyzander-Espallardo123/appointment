<?php
// Include database connection
include('db.php');

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

function validateInput($input) {
    // Trim whitespace
    $input = trim($input);

    // Remove HTML and PHP tags
    $input = strip_tags($input);

    // Convert special characters to HTML entities
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    // You can add more specific validation or sanitization steps here based on your requirements

    return $input;
}

// Fetch user information from the database
$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and validate user input
    $tutor = validateInput($_POST['tutor']);
    $appointmentDate = $_POST['appointment_date'];
    $description = validateInput($_POST['description']);

    if (empty($tutor) || empty($appointmentDate) || empty($description)) {
        echo "All fields are required.";
    }

    $insertQuery = "INSERT INTO appointments (user_id, tutor, appointment_date, description) VALUES ($userId, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    $stmt->bind_param("sss", $tutor, $appointmentDate, $description);
    $result = $stmt->execute();

    if($result){
        header("Location: dashboard.php?msg= You have appointed successfully!");
    }
    else {
        echo "Error:" . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
</head>
<body>
    <h2>Schedule Appointment</h2>
    <form method="post" action="schedule_appointment.php">

        <label for="tutor">Tutor:</label>
        <input type="text" name="tutor" required><br>

        <label for="appointment_date">Date:</label>
        <input type="datetime-local" name="appointment_date" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <input type="submit" value="Schedule Appointment">
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
