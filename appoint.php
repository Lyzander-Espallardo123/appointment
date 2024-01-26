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
    $tutor = test_input($_POST["tutors"]);
    $fullName = test_input($_POST["fullName"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $date  = test_input($_POST["date"]);
    $time  = test_input($_POST["time"]);
    $reason = test_input($_POST["reason"]);

    // Simple validation checks
    if (empty($tutor) || empty($fullName) || empty($email) || empty($phone) || empty($date) || empty($time) || empty($reason)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
        echo "Invalid phone number.";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO appointments (tutor, name, email, phone, date, time, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("sssssss", $tutor, $fullName, $email, $phone, $date, $time, $reason);
        $result = $stmt->execute();

        if($result){
            header("Location: home.php?msg=Appointed Successfully!");
        }
        else {
            echo "Error:" . $stmt->error;
        }
    }
}

?>