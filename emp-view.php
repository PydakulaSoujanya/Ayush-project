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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
                <input type="text" value="<?= htmlspecialchars($employee['id']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Name</label>
                <input type="text" value="<?= htmlspecialchars($employee['name']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Date of Birth</label>
                <input type="date" value="<?= htmlspecialchars($employee['dob']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Gender</label>
                <input type="text" value="<?= htmlspecialchars($employee['gender']); ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Phone, Email, Designation, Department -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Phone</label>
                <input type="text" value="<?= htmlspecialchars($employee['phone']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Email</label>
                <input type="email" value="<?= htmlspecialchars($employee['email']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Designation</label>
                <input type="text" value="<?= htmlspecialchars($employee['role']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Department</label>
                <input type="text" value="<?= htmlspecialchars($employee['qualification']); ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Experience, DOJ, Aadhar, Police Verification -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Experience</label>
                <input type="text" value="<?= htmlspecialchars($employee['experience']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Date of Joining</label>
                <input type="date" value="<?= htmlspecialchars($employee['doj']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Aadhar</label>
                <input type="text" value="<?= htmlspecialchars($employee['aadhar']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Police Verification</label>
                <input type="text" value="<?= htmlspecialchars($employee['police_verification']); ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <!-- Status, Daily Rate, Document -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Status</label>
                <input type="text" value="<?= htmlspecialchars($employee['status']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Daily Rate(8)</label>
                <input type="number" value="<?= htmlspecialchars($employee['daily_rate8']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Daily Rate(12)</label>
                <input type="number" value="<?= htmlspecialchars($employee['daily_rate12']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Daily Rate(24)</label>
                <input type="number" value="<?= htmlspecialchars($employee['daily_rate24']); ?>" class="styled-input" readonly>
            </div>
        </div>
       
    <div class="col-md-6">
        <div class="input-field-container">
            <label class="input-label">Aadhar Document</label>
            <?php if (isset($employee['adhar_upload_doc']) && !empty($employee['adhar_upload_doc'])): ?>
                <p class="uploaded-document mt-2">
                    <a href="<?= htmlspecialchars($employee['adhar_upload_doc']); ?>" target="_blank" title="View Aadhar Document">
                        <i class="bi bi-file-earmark-text" style="font-size: 24px; color: #007bff;"></i> View Document
                    </a>
                </p>
            <?php else: ?>
                <p class="uploaded-document mt-2 text-muted">No Aadhar document uploaded.</p>
            <?php endif; ?>
        </div>
    </div>



  

    
    <div class="col-md-6">
        <div class="input-field-container">
            <label class="input-label">Document</label>
            <?php if (isset($employee['document']) && !empty($employee['document'])): ?>
                <p class="uploaded-document mt-2">
                    <a href="<?= htmlspecialchars($employee['document']); ?>" target="_blank" title="View Document">
                        <i class="bi bi-file-earmark-text" style="font-size: 24px; color: #007bff;"></i> View Document
                    </a>
                </p>
            <?php else: ?>
                <p class="uploaded-document mt-2 text-muted">No document uploaded.</p>
            <?php endif; ?>
        </div>
    
</div>



    <!-- Bank Details -->
    <div class="row">
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Bank Name</label>
                <input type="text" value="<?= htmlspecialchars($employee['bank_name']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">Bank Account No</label>
                <input type="text" value="<?= htmlspecialchars($employee['bank_account_no']); ?>" class="styled-input" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-field-container">
                <label class="input-label">IFSC Code</label>
                <input type="text" value="<?= htmlspecialchars($employee['ifsc_code']); ?>" class="styled-input" readonly>
            </div>
        </div>

    </div>
    <div class="row">
    <?php if (isset($employee['vendor_name']) && !empty($employee['vendor_name'])): ?>
    <div class="col-md-3">
        <div class="input-field-container">
            <label class="input-label">Vendor Name</label>
            <input type="text" value="<?= htmlspecialchars($employee['vendor_name']); ?>" class="styled-input" readonly>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($employee['vendor_contact']) && !empty($employee['vendor_contact'])): ?>
    <div class="col-md-3">
        <div class="input-field-container">
            <label class="input-label">Vendor Contact</label>
            <input type="text" value="<?= htmlspecialchars($employee['vendor_contact']); ?>" class="styled-input" readonly>
        </div>
    </div>
    <?php endif; ?>
</div>

    <!-- Address -->
    <div class="row">
        <div class="col-md-6">
            <div class="input-field-container">
                <label class="input-label">Address</label>
                <input type="text" value="<?= htmlspecialchars($employee['address']); ?>" class="styled-input" readonly>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="table.php" class="btn btn-primary">Back to List</a>
    </div>
</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
