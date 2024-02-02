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
$query = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body style="background-color:#007bff;">
<div class="dashContainer" style="margin:auto;">
    <h2 style="grid-column: span 2;">Hello, <?php echo $user['full_name']; ?>!</h2>
    <p style="grid-column:span 2;"><i class="fas fa-user"></i> Profile</p>
    <table style="grid-column:span 2; width:100%;">
        <tr>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        <tr>
            <td><?php echo $user['full_name']; ?></td>
            <td><?php echo $user['phone']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><a href="edit_profile.php" class="btn btn-up" style="padding:2px;"><i class="fas fa-pen-to-square"></i>  Edit Profile</a>
    <a href="delete_profile.php" onclick="return confirm('Are you sure you want to delete your profile?')" 
    class="btn btn-out" style="padding:2px;">
    <i class="fas fa-trash"></i>  Delete Profile</a>
   
    </td>
        </tr>
    </table>
    <a href="dashboard.php" class="btn btn-show" style="border-radius:0%; grid-column:span 2;"><i class="fas fa-home"></i>  Back to Dashboard</a>

</div>


    
</body>
</html>