<?php
// Include database connection
include('db.php');

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
function validateInput($input) {
    // Trim whitespace
    $input = trim($input);

    // Remove HTML and PHP tags
    $input = strip_tags($input);

    // Convert special characters to HTML entities
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    // You can add more specific validation or sanitization steps here based on your requirements

    return $input;
}

// Fetch user information from the database
$userId = $_SESSION['user_id'];

// Check if appointment id is provided in the URL
if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Fetch appointment details from the database
    $query = "SELECT * FROM appointments WHERE id='$appointmentId' AND user_id='$userId'";
    $result = mysqli_query($conn, $query);
    $appointment = mysqli_fetch_assoc($result);

    if (!$appointment) {
        // Redirect if the appointment doesn't belong to the current user
        header('Location: dashboard.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $NewTutor = validateInput($_POST['tutor']);
        $NewAppointmentDate = validateInput($_POST['appointment_date']);
        $newDescription = validateInput($_POST['description']);

    if (empty($NewTutor) || empty($NewAppointmentDate) || empty($newDescription)) {
        echo "All fields are required.";
    }
    $updateQuery = "UPDATE appointments SET tutor='$NewTutor', appointment_date='$NewAppointmentDate', description='$newDescription' WHERE id='$appointmentId' AND user_id='$userId'";
    mysqli_query($conn, $updateQuery);
    header('Location: dashboard.php');
    exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<header>
    <a class="btn btn-show" href="dashboard.php"><i class="fas fa-arrow-left"></i>  Back to Dashboard</a>
    <h1 style="margin-left:10%;">Edit Appointment</h1>
</header>
<nav>
    <p style="opacity:0.5;">Don't Forget to click "Update Appointment Button"</p>
</nav>
<body>
    <div class="form-container" style="margin-left:20%;">
    <h2>Edit Appointment</h2>
    <form method="post" action="edit_appointment.php?id=<?php echo $appointmentId; ?>">

        <label for="tutor">Select Tutor:</label>
                <select type= "text" name="tutor" placeholder="<?php echo $appointment['tutor']; ?>" required>
                <option value="Christine Joy Cepeda">Christine Joy Cepeda</option>
                    <option value="Yolly Mae Blanco">Yolly Mae Blanco</option>
                    <option value="Elizabeth Juguan">Elizabeth Juguan</option>
                    <option value="Cristina Moonton">Cristina Moonton</option>
                </select>
                <br>
        <label for="appointment_date">Date:</label>
        <input type="datetime-local" name="appointment_date" placeholder="<?php echo $appointment['appointment_date']; ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $appointment['description']; ?></textarea><br>

        <input type="submit" value="Update Appointment">
    </form>
    </div>
    

    
</body>
</html>
