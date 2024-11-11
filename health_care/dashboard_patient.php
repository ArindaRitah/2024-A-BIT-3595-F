<?php
session_start();
include 'config.php';
// Ensure the user is logged in as a patient
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Patient Dashboard</h1>
        <h2>Your Medical Records</h2>
        <!-- Add logic to display and download records -->
    </div>
</body>
</html>
