<?php
// Database connection
include('config.php');

// Get employee ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch employee details
$query = "SELECT * FROM emp_info WHERE id = $id";
$result = $conn->query($query);

// Check if employee exists
if ($result && $result->num_rows > 0) {
    $employee = $result->fetch_assoc();
} else {
    die("Employee not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .input-field-container {
      position: relative;
      margin-bottom: 15px;
    }

    .input-label {
      position: absolute;
      top: -10px;
      left: 10px;
      background-color: white;
      padding: 0 5px;
      font-size: 14px;
      font-weight: bold;
      color: #A26D2B;
    }

    .styled-input {
      width: 100%;
      padding: 10px;
      font-size: 12px;
      outline: none;
      box-sizing: border-box;
      border: 1px solid #A26D2B;
      border-radius: 5px;
    }

    .styled-input:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    h1, h2, h3, h4 {
      color: #A26D2B;
    }
  </style>
    <title>Employee Details</title>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-7">
<h3 class="mb-4">view Employee</h3>    
<form>
    <!-- ID, Name, DOB, Gender -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Employee ID</label>
                <input type="text" value="<?= $employee['id']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Name</label>
                <input type="text" value="<?= $employee['name']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Date of Birth</label>
                <input type="date" value="<?= $employee['dob']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Gender</label>
                <input type="text" value="<?= $employee['gender']; ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Phone, Email, Designation, Department -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Phone</label>
                <input type="text" value="<?= $employee['phone']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Email</label>
                <input type="email" value="<?= $employee['email']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Designation</label>
                <input type="text" value="<?= $employee['role']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Department</label>
                <input type="text" value="<?= $employee['qualification']; ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Experience, DOJ, Aadhar, Police Verification -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Experience</label>
                <input type="text" value="<?= $employee['experience']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Date of Joining</label>
                <input type="date" value="<?= $employee['doj']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Aadhar</label>
                <input type="text" value="<?= $employee['aadhar']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Police Verification</label>
                <input type="text" value="<?= $employee['police_verification']; ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Daily Rate, Status, Termination Date, Document -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Daily Rate</label>
                <input type="text" value="<?= $employee['daily_rate']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Status</label>
                <input type="text" value="<?= $employee['status']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Termination Date</label>
                <input type="date" value="<?= $employee['termination_date']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Document</label>
                <input type="text" value="<?= $employee['document']; ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Bank Name, Account No, IFSC Code, Address -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Bank Name</label>
                <input type="text" value="<?= $employee['bank_name']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Bank Account No</label>
                <input type="text" value="<?= $employee['bank_account_no']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">IFSC Code</label>
                <input type="text" value="<?= $employee['ifsc_code']; ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Address</label>
                <input type="text" value="<?= $employee['address']; ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="manage_employee.php" class="btn btn-primary">Back to List</a>
    </div>
</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
