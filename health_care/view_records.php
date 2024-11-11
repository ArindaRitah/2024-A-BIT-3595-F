<?php
session_start();
include 'config.php';
// Ensure the user is logged in as a patient
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch and display medical records for the patient
$patient_id = $_SESSION['patient_id'];

$sql = "SELECT * FROM medical_records WHERE patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Medical Records</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Your Medical Records</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>Doctor ID</th>
                    <th>Record</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['doctor_id'] ?></td>
                        <td><?= $row['record'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
