 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Appointment Form</title>
    <link rel="stylesheet" href="styles.css">  <!-- External CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="test.php"></a>
    <a href="index.php"></a>
    <div class="container">
        <h2>Book an Appointment</h2>
        <form action="process_appointment.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label> 
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="appointment_date">Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="doctor">Select Doctor:</label>
            <select id="doctor" name="doctor" required>
                <option value="Dr. Sharma">Dr. Sharma</option>
                <option value="Dr. Mehta">Dr. Mehta</option>
                <option value="Dr. Verma">Dr. Verma</option>
            </select>

            <label for="opinion">Your Opinion:</label>
            <textarea id="opinion" name="opinion" rows="4" required></textarea>

            <button type="submit">Submit Appointment</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 