<?php
// Include database connection
include('db.php');

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user information from the database
$userId = $_SESSION['user_id'];

// Check if appointment id is provided in the URL
if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Delete appointment from the database
    $deleteQuery = "DELETE FROM appointments WHERE id='$appointmentId' AND user_id='$userId'";
    mysqli_query($conn, $deleteQuery);

    // Redirect back to dashboard
    header('Location: dashboard.php');
    exit();
} else {
    // Redirect if appointment id is not provided
    header('Location: dashboard.php');
    exit();
}
?>
