<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Tutoring Site</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header>
    <?php
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div style="padding: 20px;
        border: 1px solid white;
        background-color:#18da5c88;
        font-size: 10px;">
        '.$msg.'
      </div>';
    }
    ?>
    <a class="btn btn-in" href="login.php">Sign in</a>
    <a class="btn btn-up" href="register.php">Sign up</a>
    <h1>Online Tutoring Site</h1>  
</header>

<nav>
        
    <a href="index.php#homeSection">Home</a>
    <a href="index.php#tutorsSection">Tutors</a>
    <a href="index.php#aboutSection">About Us</a>
</nav>
