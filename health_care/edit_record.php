<?php
session_start();
include 'config.php';
// Ensure the user is logged in as a doctor
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}
// Fetch existing record to edit based on record ID
// Assume record ID is passed via query string
$record_id = $_GET['id'];
$sql = "SELECT * FROM medical_records WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $record_id);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit Medical Record</h1>
        <form action="db.php" method="POST">
            <div class="form-group">
                <label for="record">Record</label>
                <textarea class="form-control" id="record" name="record" required><?= $record['record'] ?></textarea>
            </div>
            <input type="hidden" name="record_id" value="<?= $record['id'] ?>">
            <button type="submit" name="update_record" class="btn btn-primary">Update Record</button>
        </form>
    </div>
</body>
</html>
