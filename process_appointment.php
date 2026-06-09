<?php
// Database Connection
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";      // Change if needed
$database = "hospital_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$appointment_date = $_POST['appointment_date'];
$age = $_POST['age'];
$doctor = $_POST['doctor'];
$opinion = $_POST['opinion'];

// SQL Query to insert data
$sql = "INSERT INTO appointments (name, email, phone, appointment_date, age, doctor, opinion) 
        VALUES ('$name', '$email', '$phone', '$appointment_date', '$age', '$doctor', '$opinion')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Appointment booked successfully!');
            window.location.href = 'index.php';
          </script>";
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
