<?php
session_start();
include 'config.php'; // Include the config file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register_doctor'])) {
        // Registration logic for doctors
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO doctors (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();
        header("Location: login.php");
    }

    if (isset($_POST['register_patient'])) {
        // Registration logic for patients
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO patients (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();
        header("Location: login.php");
    }

    if (isset($_POST['login'])) {
        // Login logic
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM doctors WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($doctor_id, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['doctor_id'] = $doctor_id;
                header("Location: dashboard_doctor.php");
                exit();
            }
        }

        $stmt->close();
        
        $stmt = $conn->prepare("SELECT id, password FROM patients WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($patient_id, $hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                $_SESSION['patient_id'] = $patient_id;
                header("Location: dashboard_patient.php");
                exit();
            }
        }

        $stmt->close();
        echo "Invalid email or password.";
    }

    if (isset($_POST['add_record'])) {
        // Add medical record
        $patient_id = $_POST['patient_id'];
        $doctor_id = $_SESSION['doctor_id'];
        $record = $_POST['record'];

        $stmt = $conn->prepare("INSERT INTO medical_records (patient_id, doctor_id, record) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $patient_id, $doctor_id, $record);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard_doctor.php");
    }

    if (isset($_POST['update_record'])) {
        // Update medical record
        $record_id = $_POST['record_id'];
        $record = $_POST['record'];

        $stmt = $conn->prepare("UPDATE medical_records SET record = ? WHERE id = ?");
        $stmt->bind_param("si", $record, $record_id);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard_doctor.php");
    }
}
?>
