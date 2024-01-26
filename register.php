<?php

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize and validate input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and validate form data
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $email = test_input($_POST["email"]);
    $address = test_input($_POST["address"]);
    $phone = test_input($_POST["phone"]);
    $password = password_hash(test_input($_POST["password"]), PASSWORD_DEFAULT); // Hash the password

    // Simple validation checks
    if (empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($phone) || empty($password)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
        echo "Invalid phone number.";
    } elseif ($_POST["password"] !== $_POST["confirmPassword"]) {
        echo "Password and Confirm Password do not match.";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO users (first_name, last_name, email, address, phone, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $address, $phone, $password);
        $result = $stmt->execute();

        if($result){
            header("Location: index.php?msg=registered successfully!");
        }
        else {
            echo "Error:" . $stmt->error;
        }
    }
}

?>