<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <style>
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
.btn-appoint {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
    margin-right: 20px;
}
.btn-danger {
    background-color: red;
    color: white;
    border: 1px solid white;
}
.btn-edit{
    background-color: blue;
    color: white;
    border: 1px solid white;
}
.btn-home{
    background-color: aqua;
    color: black;
    border: 1px solid white;
    margin-right: 20px;
}
.thead{
    background-color:grey;
    border:0px;
}
.trow th{
    padding:20px;
    padding-right:30px;
    padding-left:30px;
    text-align:center;
}
.trow td{
    padding:20px;
    padding-right:30px;
    padding-left:30px;
    text-align:center; 
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
            <h1>APPOINTMENTS</h1>
    </div>
        <a class="btn btn-home" href="home.php">Home</a>
        <a class="btn btn-appoint" href="appointments.php">Appointments</a>
        <a class="btn btn-danger" href="logout.php">Log Out</a>
</header>
</head>
<body>
    <div class="container">
    <table>
        <thead class="thead">
            <tr class="trow">
                <th scope="col">ID</th>
                <th scope="col">Tutor</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Message</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
         <tbody>
            <?php
            include "connection.php";
            

                $sql = "SELECT * FROM appointments";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <tr class="trow">
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['tutor']?></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['phone']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['time']?></td>
                        <td><?php echo $row['message']?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-edit"> Edit</a>
                            <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
     </tbody>
    </table>
    
</body>
</html>