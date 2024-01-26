<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<link rel="stylesheet" href="style.css">
<style>
     .container {
        margin-left:450px;
    max-width:600px;
    background-color: rgba(0, 0, 0, 0.7);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border:1px solid black;
    color:white;
    
}
</style>
<body>

<div class="container">

<form action="login.php" method="post">
<?php
        if(isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div style="padding: 20px;
            border: 3px solid green;
            background-color:rgba(0, 128, 0, 0.3);
            font-size: 20px;">
            '.$msg.'
          </div>';
        }
        
        ?>
    <div style="grid-column: span 2;"><h2>User Login</h2></div>
    <div>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    </div>
    <div>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    </div>
    <input type="submit" value="Login">
</form>
</div>
</body>
</html>
