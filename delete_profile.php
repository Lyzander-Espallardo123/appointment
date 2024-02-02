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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete user profile from the database
    $deleteQuery = "DELETE FROM users WHERE id='$userId'";
    mysqli_query($conn, $deleteQuery);

    // Destroy session and redirect to login page
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="form-container" style="margin-left:20%;">
    <h2>Delete Profile</h2>
    <p>Are you sure you want to delete your profile?</p>
    <form method="post" action="delete_profile.php">
        <input class="button" type="submit" value="Delete Profile">
    </form>

    <a style="float:none;" class="btn btn-show" href="dashboard.php">Back to Dashboard</a>
    </div>
    
</body>
</html>
