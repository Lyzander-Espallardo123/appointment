<?php
include('db.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function validateInput($input) {
        $input = trim($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }
    $username = validateInput($_POST['username']);
    $password = validateInput($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Both email and password are required.";
    }else{
        $query = "SELECT * FROM users WHERE username= ?";
        $stmt = $conn->prepare($query);

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = mysqli_fetch_assoc($result);
    }

    // Fetch user from database
    

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Set session variable to track user login status
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
</head>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<header>
    <h1 style="margin:0; padding:20px;">Log In Page</h1>
</header>
<nav>
    <p>Log in your account</p>
    <a href="index.php"><i class="fas fa-arrow-left"></i>  Go Back</a>
</nav>
<body>
    <div class="form-container" style="width:400px;">
    <h1>Log In Form</h1>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Log In</button>
    </form>

    </div>
</body>
<?php
include ('footer.php');
?>
</html>
