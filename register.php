<?php
// Include database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        function validateInput($input) {
        $input = trim($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }

    $fullName= validateInput($_POST["fullname"]);
    $phone = validateInput($_POST["phone"]);
    $username =validateInput( $_POST['username']);
    $password = password_hash(validateInput($_POST['password']), PASSWORD_BCRYPT);

    if (empty($fullName) || empty($phone) || empty($username) || empty($password)) {
        echo "All fields are required.";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
        echo "Invalid phone number.";
    } elseif ($_POST["password"] !== $_POST["confirmPassword"]) {
        echo "Password and Confirm Password do not match.";
    }

    // Insert user into database
    $query = "INSERT INTO users (full_name, phone, username, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssss", $fullName, $phone, $username, $password);
    $result = $stmt->execute();

    if($result){
        header("Location: index.php?msg= You have registered successfully!");
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
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<header>
    <h1 style="margin:0; padding:20px;">Registration Page</h1>
</header>
<nav>
    <p>Hello There ! Register now and become our new user !</p>
    <a href="index.php"><i class="fas fa-arrow-left"></i>  Go Back</a>
</nav>
<body>
    <div class="form-container" style=" margin-left:100px; margin-top:25px;">

    <form class="Regform" method="post" action="register.php">
        <h2 style="grid-column:span 2;">Registration Form</h2>
        <div>
        <label for="fullname">Full name:</label>
        <input type="text" name="fullname" required>
        </div>

        <div>
        <label for="phone">Phone:</label>
        <input type="phone" name="phone" required>
        </div>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        </div>

        <div>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" required>
        </div>

        <button type="submit">Register</button>
    </form>

    </div>
    
    
</body>
<?php

include ('footer.php');

?>
</html>
