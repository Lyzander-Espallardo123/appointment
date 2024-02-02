<?php
include('db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
function validateInput($input) {
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NewfullName = validateInput($_POST['fullname']);
    $Newphone = validateInput($_POST['phone']);
    $newUsername = validateInput($_POST['username']);
    $newPass = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (empty($NewfullName) || empty($Newphone) || empty($newUsername) || empty($newPass)) {
        echo "All fields are required.";
    } elseif (!preg_match("/^[0-9]{11}$/", $Newphone)) {
        echo "Invalid phone number.";
    } elseif ($_POST["password"] !== $_POST["confirmPassword"]) {
        echo "Password and Confirm Password do not match.";
    }

    $updateQuery = "UPDATE users SET full_name='$NewfullName', phone='$Newphone', username='$newUsername', password='$newPass' WHERE id='$userId'";
    mysqli_query($conn, $updateQuery);

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<header>
    <a class="btn btn-show" href="dashboard.php"><i class="fas fa-arrow-left"></i>  Back to Dashboard</a>
    <h1 style="margin-left:10%;">Edit Profile</h1>
</header>
<nav>
    <p style="opacity:0.5;">Don't Forget to click "Update Profile Button"</p>
</nav>
<body>
<div class="form-container" style="margin-left:20%;">
    <h2>Edit Profile</h2>
    <form method="post" action="edit_profile.php">

        <label for="fullname">Full name:</label>
        <input type="text" name="fullname" value="<?php echo $user['full_name']; ?>"><br>
        
        <label for="phone">Phone:</label>
        <input type="phone" name="phone"  value="<?php echo $user['phone']; ?>"><br>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $user['password']; ?>" required><br>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" required>

        <input type="submit" value="Update Profile">
    </form>
</div>

</body>
</html>
