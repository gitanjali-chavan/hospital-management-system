<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $age = $_POST["age"];
    $doctor = $_POST["doctor"];
    $message = $_POST["message"];

    $sql = "INSERT INTO appointments (name, email, phone, date, age, doctor, message)
            VALUES ('$name', '$email', '$phone', '$date', '$age', '$doctor', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>