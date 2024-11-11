<?php
session_start();
include 'config.php';
// Ensure the user is logged in as a doctor
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

// Handle deletion logic here
if (isset($_POST['record_id'])) {
    $record_id = $_POST['record_id'];
    $sql = "DELETE FROM medical_records WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $record_id);
    
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
