<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

include "config.php";

$sql = "SELECT id, name FROM emp_info WHERE status = 'Active'";
$result = $conn->query($sql);

$employees = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

$conn->close();
// Your protected page content goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    h3 {
      color: #A26D2B;
    }
  </style>
</head>
<body>
<?php include('navbar.php'); ?>
  <div class="container mt-7">
    <h3 class="mb-4">Assignment Form</h3>
    <form action="allotmentdb.php" method="POST">
      <!-- <div class="row">
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Employee ID</label>
            <input type="hidden" id="employee_id" name="employee_id" class="styled-input" placeholder="Enter Employee ID" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Patient ID</label>
            <input type="hidden" id="patient_id" name="patient_id" class="styled-input" placeholder="Enter Patient ID" />
          </div>
        </div>
      </div> -->

      <div class="row">
        <div class="col-md-6">
    <div class="input-field-container">
        <label class="input-label">Employee</label>
        <select id="name" name="name" class="styled-input">
            <option value="">Select Employee</option>
            <?php foreach ($employees as $employee): ?>
                <option value="<?= htmlspecialchars($employee['id']); ?>">
                    <?= htmlspecialchars($employee['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Patient Name</label>
            <input type="text" id="patient_name" name="patient_name" class="styled-input" placeholder="Enter Patient Name" />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="input-field-container">
            <input type="hidden" id="employee_id" name="employee_id" class="styled-input" placeholder="Enter Employee ID" />
            <input type="hidden" id="patient_id" name="patient_id" class="styled-input" placeholder="Enter Patient ID" />
            <label class="input-label">Service Type</label>
            <select id="service_type" name="service_type" class="styled-input">
              <option value="">Select Service Type </option>
              <option value="Fully Trained Nurse">Fully Trained Nurse</option>
              <option value="Semi-Trained Nurse">Semi-Trained Nurse</option>
              <option value="Care Taker">Care Taker</option>
              <option value="Care Taker">Nani's</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Shift</label>
            <select id="shift" name="shift" class="styled-input">
              <option value="">Select Shift</option>
              <option value="Day">Day</option>
              <option value="Night">Night</option>
              <option value="Flexible">Flexible</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Start Date</label>
            <input type="date" id="start_date" name="start_date" class="styled-input" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">End Date</label>
            <input type="date" id="end_date" name="end_date" class="styled-input" />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Status</label>
            <select id="status" name="status" class="styled-input">
                <option value="">Select Status</option>
              <option value="Assigned">Assigned</option>
              <option value="Reassigned">Reassigned</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="input-field-container">
            <label class="input-label">Number of Hours</label>
            <select id="no_of_hours" name="no_of_hours" class="styled-input">
              <option value="">Select Service Hours</option>
              <option value="8 Hours">8 Hours</option>
              <option value="12 Hours">12 Hours</option>
              <option value="24 Hours">24 Hours</option>
            </select>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
