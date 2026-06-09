<?php
$conn = new mysqli("localhost", "root", "", "hospital_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_value = $_POST['search_value'];

    // Check whether input is phone number or email
    if (filter_var($search_value, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM appointments WHERE email = ?";
    } else {
        $query = "SELECT * FROM appointments WHERE phone = ?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $search_value);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        echo "<p class='error'>No appointment found.</p>";
        exit;
    }
}
?><!DOCTYPE html><html>
<head>
    <title>View & Edit Appointment</title>
    <link rel="stylesheet" type="text/css" href="styless.css">
</head>
<body>
    <div class="container">
        <h2>Search Appointment</h2>
        <form method="post" class="search-form">
            <input type="text" name="search_value" placeholder="Enter Mobile No or Email" required>
            <button type="submit">Search</button>
        </form><?php if (isset($appointment)) { ?>
        <h2>Edit Appointment</h2>
        <form method="post" action="update_appointment.php" class="appointment-form">
            <input type="hidden" name="id" value="<?= $appointment['id'] ?>">
            <input type="text" name="name" value="<?= $appointment['name'] ?>" required>
            <input type="email" name="email" value="<?= $appointment['email'] ?>" required>
            <input type="text" name="phone" value="<?= $appointment['phone'] ?>" required>
            <input type="date" name="appointment_date" value="<?= $appointment['appointment_date'] ?>" required>
            <input type="number" name="age" value="<?= $appointment['age'] ?>" required>
            <input type="text" name="doctor" value="<?= $appointment['doctor'] ?>" required>
            <textarea name="opinion"><?= $appointment['opinion'] ?></textarea>
            <button type="submit">Update Appointment</button>
        </form>
    <?php } ?>
</div>

</body>
</html>