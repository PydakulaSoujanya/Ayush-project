<?php
// Include database connection
include('config.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $employee_id = $_POST['id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];
    $doj = $_POST['doj'];
    $aadhar = $_POST['aadhar'];
    $police_verification = $_POST['police_verification'];
    $daily_rate = $_POST['daily_rate'];
    $status = $_POST['status'];
    $termination_date = empty($_POST['termination_date']) ? null : $_POST['termination_date'];
    $bank_name = $_POST['bank_name'];
    $bank_account_no = $_POST['bank_account_no'];
    $ifsc_code = $_POST['ifsc_code'];
    $address = $_POST['address'];
    $document = null;

    // Handle file upload (if provided)
    if (!empty($_FILES['document']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['document']['name']);
        if (move_uploaded_file($_FILES['document']['tmp_name'], $target_file)) {
            $document = $target_file;
        }
    }

    // Construct the query
    $query = "UPDATE emp_info 
              SET name = '$name', dob = '$dob', gender = '$gender', phone = '$phone', email = '$email', 
                  role = '$role', qualification = '$qualification', experience = '$experience', 
                  doj = '$doj', aadhar = '$aadhar', police_verification = '$police_verification', 
                  daily_rate = '$daily_rate', status = '$status', termination_date = ?, 
                  bank_name = '$bank_name', bank_account_no = '$bank_account_no', 
                  ifsc_code = '$ifsc_code', address = '$address'";

    // Add document field only if a new file was uploaded
    if ($document) {
        $query .= ", document = '$document'";
    }
    
    $query .= " WHERE id = '$employee_id'";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    if ($termination_date === null) {
        $stmt->bind_param('s', $termination_date); // Bind null if no termination date is provided
    }

    if ($stmt->execute()) {
        header('Location: manage_employee.php?update_success=1'); // Redirect on success
        exit;
    } else {
        die("Error updating employee: " . $stmt->error);
    }
} else {
    die('Invalid request method.');
}
?>
