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
    <title>Add Record</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Add Medical Record</h1>
        <form action="db.php" method="POST">
            <div class="form-group">
                <label for="patient_id">Patient ID</label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" required>
            </div>
            <div class="form-group">
                <label for="record">Record</label>
                <textarea class="form-control" id="record" name="record" required></textarea>
            </div>
            <button type="submit" name="add_record" class="btn btn-primary">Add Record</button>
        </form>
    </div>
</body>
</html>
