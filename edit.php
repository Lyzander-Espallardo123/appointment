<?php
include "connection.php";

$id = $_GET['id'];

if(isset($_POST['submit'])){
    $tutor = $_POST['tutors'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];

    $sql = "UPDATE `appointments` SET `tutor`='$tutor',`name`='$fullName',
    `email`='$email',`phone`='$phone',`date`='$date',`time`='$time',`message`='$reason' WHERE id=$id";

    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: appointments.php?msg=Updated Successfully!");
    }
    else {
        echo "failed" . mysqli_error($con);
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
</head>
<style>

.carousel-container {
    margin-left: 125px;
    display: inline-block;
    max-width: 500px;
    position: relative;
    text-align: center;
}
.carousel-image {
    width: 100%;
    display: none;
}
.carousel-image img {
    margin-top: 50px;
    height: 350px;
    width: 100%;
}
.carousel-dots {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    bottom: 0;
    width: 100%;
}
.carousel-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: black;
    margin: 0 5px;
    display: inline-block;
    cursor: pointer;
}
.carousel-dot:hover, .carousel-dot.active {
    background-color: white;
}
.carousel-controls {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    display: flex;
    justify-content: space-between;
}
.carousel-control {
    background-color: rgba(0, 0, 0, 0.5);
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    color: #fff;
    cursor: pointer;
}
label {
    display: block;
    margin-bottom: 8px;
    }

input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
        }

button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
        }
header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: right;
}

.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 1px solid green;
    flex-direction: column;
}
@media (min-width: 600px) {
            .container {
                display: flex;
                flex-direction: row;
            }

            .column {
                width: 50%;
            }
        }
.column {
    border: 1px solid green;
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-bottom: 20px;
        }
.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border-radius: 5px;
}
.btn-danger {
    background-color: red;
    color: white;
    border: 1px solid white;
}
</style>
<header>
    <div style="text-align:center;">
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
            <h1>Edit your appointment</h1>
    </div>
        
</header>
<body>
<?php
        $sql = "SELECT * FROM appointments WHERE id = $id LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        
        ?>
    <div class="container">
        <div class="column">
        <h2>Appointment Form</h2>
        <form id="appointmentForm" action="" method="post">
            <label for="tutors">Select Tutor</label>
                <select type= "text" id="tutors" name="tutors">
                    <option value="Lyzander Espallardo">Lyzander Espallardo</option>
                    <option value="Shekinah Ramos">Shekinah Ramos</option>
                    <option value="Paul Jay Doloso">Paul Jay Doloso</option>
                    <option value="Ian Kyle Magbanua">Ian Kyle Magbanua</option>
                </select>

            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="date">Preferred Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Preferred Time:</label>
            <input type="time" id="time" name="time" required>

            <label for="reason">Reason for Appointment:</label>
            <textarea id="reason" name="reason" rows="4" required></textarea>

            <button type="submit" name="submit">Update Appointment</button>
            <a href="appointments.php" class="btn btn-danger">Cancel</a> 
        </form>
    </div>
    <div class="column">
        <div class="carousel-container">
            <h2>Our Tutors</h2>
            <div class="carousel-image">
            <img src="tutors/death note banner.jpg" alt="Image 1">
            <h3>Lyzander Espallardo</h3>
            <p>Math Tutor</p>
            </div>
            <div class="carousel-image">
            <img src="tutors/death note banner.jpg" alt="Image 2">
            <h3>Shekinah Ramos</h3>
            <p>English Tutor</p>
            </div>
            <div class="carousel-image">
            <img src="tutors/death note banner.jpg" alt="Image 3">
            <h3>Paul Jay Doloso</h3>
            <p>Science Tutor</p>
            </div>
            <div class="carousel-image">
            <img src="tutors/death note banner.jpg" alt="Image 4">
            <h3>Ian Kyle Magbanua</h3>
            <p>Physical Education Coach</p>
            </div>
            
            <div class="carousel-controls">
                <div class="carousel-control" onclick="prevImage()">&#10094;</div>
                <div class="carousel-control" onclick="nextImage()">&#10095;</div>
            </div>
            <div class="carousel-dots">
                <div class="carousel-dot" onclick="selectDot(0)"></div>
                <div class="carousel-dot" onclick="selectDot(1)"></div>
                <div class="carousel-dot" onclick="selectDot(2)"></div>
                <div class="carousel-dot" onclick="selectDot(3)"></div>
            </div>  
        </div>
    </div>
    
</body>
<script>
    let currentImage = 0;
    
    function nextImage() {
    currentImage = (currentImage + 1) % 4;
    showImage(currentImage);
    }
    
    function prevImage() {
    currentImage = (currentImage - 1 + 4) % 4;
    showImage(currentImage);
    }
    
    function selectDot(dotIndex) {
    currentImage = dotIndex;
    showImage(currentImage);
    }
    
    function showImage(imageIndex) {
    let carouselImages = document.getElementsByClassName('carousel-image');
    for (let i = 0; i < carouselImages.length; i++) {
    carouselImages[i].style.display = 'none';
    }
    carouselImages[imageIndex].style.display = 'block';
    
    let carouselDots = document.getElementsByClassName('carousel-dot');
    for (let i = 0; i < carouselDots.length; i++) {
    carouselDots[i].classList.remove('active');
    }
    carouselDots[imageIndex].classList.add('active');
    }
    
    showImage(currentImage);
    </script>
</html>
