<?php
session_start(); // Start the session
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_by = $_POST['search_by']; // email or phone
    $search_value = $_POST['search_value'];

    if ($search_by == "email") {
        $column = "email";
    } elseif ($search_by == "phone") {
        $column = "phone";
    } else {
        $_SESSION['error'] = "Invalid search option.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Fetch appointment history
    $sql = "SELECT * FROM appointments WHERE $column='$search_value' ORDER BY appointment_date DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['appointments'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $_SESSION['appointments'] = [];
    }

    $_SESSION['search_by'] = $search_by;
    $_SESSION['search_value'] = $search_value;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History</title>
    <link rel="stylesheet" href="appointment.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Check Your Appointment History</h2>
        <form method="post" action="" class="mt-4">
            <label>Select Search Option:</label>
            <select name="search_by" class="form-select mb-3" required>
                <option value="email" <?php echo (isset($_SESSION['search_by']) && $_SESSION['search_by'] == "email") ? "selected" : ""; ?>>Email</option>
                <option value="phone" <?php echo (isset($_SESSION['search_by']) && $_SESSION['search_by'] == "phone") ? "selected" : ""; ?>>Phone Number</option>
            </select>
            <label>Enter Your Email or Phone Number:</label>
            <input type="text" name="search_value" class="form-control mb-3" required value="<?php echo isset($_SESSION['search_value']) ? $_SESSION['search_value'] : ''; ?>">
            <button type="submit" class="btn btn-primary">View History</button>
        </form>

        <?php
        if (isset($_SESSION['appointments'])) {
            if (!empty($_SESSION['appointments'])) {
                echo "<h3 class='mt-4'>Appointment History</h3>";
                echo "<table class='table table-bordered mt-3'>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Appointment Date</th>
                                <th>Doctor</th>
                                <th>Opinion</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($_SESSION['appointments'] as $row) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['appointment_date']}</td>
                            <td>{$row['doctor']}</td>
                            <td>{$row['opinion']}</td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='text-warning mt-3'>No appointment history found.</p>";
            }
            unset($_SESSION['appointments']); // Clear session data after displaying
        }
        ?>

        <button class="btn btn-secondary mt-3" onclick="history.back()">Go Back</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>