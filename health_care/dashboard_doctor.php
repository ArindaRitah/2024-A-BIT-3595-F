<?php
session_start();
include 'config.php';
// Ensure the user is logged in as a doctor
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Doctor Dashboard</h1>
        <a href="add_record.php" class="btn btn-primary">Add Record</a>
        <a href="view_records.php" class="btn btn-secondary">View Records</a>
        <h2>Patient Records</h2>
        <!-- Add logic to display patient records -->
    </div>
</body>
</html>
