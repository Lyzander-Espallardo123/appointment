<?php
include('db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$appointmentsQuery = "SELECT * FROM appointments WHERE user_id='$userId'";
$appointmentsResult = mysqli_query($conn, $appointmentsQuery);
$appointments = mysqli_fetch_all($appointmentsResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<header>
    <a class="btn btn-out" href="logout.php">Logout</a>
    <a class="btn btn-up" href="user_profile.php">Profile</a>
    <h1>Welcome, <?php echo $user['full_name']; ?>!</h1>
    
</header>
<nav>
    <p>Let The Learning Begin !</p>
</nav>
<body>
    
    <div class="Regform">
        <div class="dashContainer">
            <form style="grid-column: span 2;" method="post" action="schedule_appointment.php">
            <h2>Schedule Appointment</h2>
                <label for="tutor">Select Tutor:</label>
                <select type= "text" name="tutor" required>
                    <option value="Christine Joy Cepeda">Christine Joy Cepeda</option>
                    <option value="Yolly Mae Blanco">Yolly Mae Blanco</option>
                    <option value="Elizabeth Juguan">Elizabeth Juguan</option>
                    <option value="Cristina Moonton">Cristina Moonton</option>
                </select>
               
                <label for="appointment_date">Date:</label>
                <input type="datetime-local" name="appointment_date" required>

                <label for="description">Description:</label>
                <textarea name="description" required></textarea>

                <input type="submit" value="Schedule Appointment">
            </form>
            <h2 style="grid-column: span 2"> Your Appointments</h2>

            <table id="myTable">
        <tr>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Tutor</th>
            <th>Date & Time</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?php echo $user['full_name']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $appointment['tutor']; ?></td>
                <td><?php echo $appointment['appointment_date']; ?></td>
                <td><?php echo $appointment['description']; ?></td>
                <td>
                <a href="edit_appointment.php?id=<?php echo $appointment['id']; ?>"><i class="fas fa-pen-to-square"></i></a>
                <a href="delete_appointment.php?id=<?php echo $appointment['id']; ?>" onclick="return confirm('Are you sure you want to delete this appointment?')">
                <i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
        </div>
        <div class="Regform">
               <div class="dashContainer">
                <h2 style="grid-column:span 2;">Our Tutors</h2>
                    <div class="img-container">
                    <img src="img/teacher1.png" alt="image1">
                    <h4>Christine Joy Cepeda</h4>
                    <p>Math Tutor</p>
                    </div>
                    <div class="img-container">
                    <img src="img/teacher2.jpg" alt="image2">
                    <h4>Yolly Mae Blanco</h4>
                    <p>English Tutor</p>
                    </div>
                    <div class="img-container">
                    <img src="img/teacher3.jpg" alt="image3">
                    <h4>Elizabeth Juguan</h4>
                    <p>Science Tutor</p>
                    </div>
                    <div class="img-container">
                    <img src="img/teacher4.jpg" alt="image4">
                    <h4>Cristina Moonton</h4>
                    <p>Physical Education Coach</p>
                    </div>
               </div>
        </div>
            
    

   
</body>
<?php

include ('footer.php');

?>
</html>
