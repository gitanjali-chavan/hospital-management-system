<?php
$conn = new mysqli("localhost", "root", "", "hospital_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $appointment_date = $_POST['appointment_date'];
    $age = $_POST['age'];
    $doctor = $_POST['doctor'];
    $opinion = $_POST['opinion'];

    $query = "UPDATE appointments SET name=?, email=?, phone=?, appointment_date=?, age=?, doctor=?, opinion=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssissi", $name, $email, $phone, $appointment_date, $age, $doctor, $opinion, $id);

    if ($stmt->execute()) {
        // Redirect to the main page after successful update
        header("Location: index.php"); 
        exit();
    } else {
        echo "Error updating record.";
    }
}
?>