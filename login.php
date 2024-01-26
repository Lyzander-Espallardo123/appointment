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
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    // Simple validation checks
    if (empty($email) || empty($password)) {
        echo "Both email and password are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        // Check user credentials in the database
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $con->prepare($sql);

        // Bind parameter and execute the statement
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                header("Location: home.php?msg=log in successfully");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }

    }
}

?>