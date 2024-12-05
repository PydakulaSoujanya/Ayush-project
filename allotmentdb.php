<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "config.php"; // Include database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $employee_id = $_POST['employee_id'];
    $patient_name = $_POST['patient_name'];
    $service_type = $_POST['service_type'];
    $shift = $_POST['shift'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $no_of_hours = $_POST['no_of_hours'];

    // Validate form fields (basic example)
    // if (empty($employee_id) || empty($service_type) || empty($shift) || empty($start_date) || empty($status) || empty($no_of_hours)) {
    //     echo "All required fields must be filled out!";
    //     exit;
    // }

    // Insert into database
    $sql = "INSERT INTO allotment (employee_id, patient_name, service_type, shift, start_date, end_date, status, no_of_hours)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssss", $employee_id, $patient_name, $service_type, $shift, $start_date, $end_date, $status, $no_of_hours);

    if ($stmt->execute()) {
        echo "Allotment successfully created!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method!";
    exit;
}
?>
