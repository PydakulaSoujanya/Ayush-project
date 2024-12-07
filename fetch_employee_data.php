<?php
include('config.php');

// Check if the ID is provided via POST
if (isset($_POST['id'])) {
    $employeeId = $_POST['id'];
    
    // Query to fetch employee details by ID
    $query = "SELECT 
                id, 
                name, 
                dob, 
                gender, 
                phone, 
                email, 
                role, 
                qualification, 
                experience, 
                doj, 
                aadhar, 
                police_verification, 
                police_verification_form, 
                status, 
                daily_rate8, 
                daily_rate12, 
                daily_rate24, 
                adhar_upload_doc, 
                document1, 
                document2, 
                document3, 
                document4, 
                bank_name, 
                bank_account_no, 
                ifsc_code, 
                reference, 
                vendor_name, 
                vendor_id, 
                vendor_contact, 
                address 
              FROM emp_info 
              WHERE id = $employeeId";
              
    $result = $conn->query($query);
    
    if ($result && $row = $result->fetch_assoc()) {
        // Return the employee details as JSON
        echo json_encode($row);
    } else {
        // Return error if no employee found
        echo json_encode(['error' => 'Employee not found']);
    }
} else {
    echo json_encode(['error' => 'No employee ID provided']);
}
?>
