<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Form</title>
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
      font-weight: bold; /* Makes the label bold */
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
</head>
<body>
  
<?php
// Include the database connection settings
include('config.php');
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data from the POST request
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $date_of_joining = $_POST['date_of_joining'];
    $emergency_contact_number = $_POST['emergency_contact_number'];
    $blood_group = $_POST['blood_group'];
    $medical_conditions = $_POST['medical_conditions'];
    $mobility_status = $_POST['mobility_status'];
    $discharge = $_POST['discharge'];
    $age_of_the_patient = $_POST['age_of_the_patient'];
    $address = $_POST['address'];

    // Prepare the SQL query to insert data into the database
    $sql = "INSERT INTO user (full_name, dob, gender, phone_number, date_of_joining, emergency_contact_number, blood_group, medical_conditions, mobility_status, discharge, age_of_the_patient, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters to the SQL query (s = string, i = integer, d = double, b = blob)
    $stmt->bind_param("ssssssssssss", $full_name, $dob, $gender, $phone_number, $date_of_joining, $emergency_contact_number, $blood_group, $medical_conditions, $mobility_status, $discharge, $age_of_the_patient, $address);

    // Execute the query
    if ($stmt->execute()) {
        $successMessage = "Form submitted successfully!";
    } else {
        $successMessage = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<?php include('navbar.php'); ?>

<div class="container mt-7">
  <h3 class="mb-4">Customer Details Form</h3>
  
  <!-- Display Success Message -->
  <?php if ($successMessage): ?>
    <div class="alert alert-success" role="alert">
      <?php echo $successMessage; ?>
    </div>
  <?php endif; ?>
  <form method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Full Name</label>
          <input type="text" class="styled-input" name="full_name" placeholder="Enter your name" required />
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Date of Birth</label>
          <input type="date" class="styled-input" name="dob" required />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Gender</label>
          <select class="styled-input" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Phone Number</label>
          <input type="text" class="styled-input" name="phone_number" placeholder="Enter your phone number" required />
        </div>
      </div>

      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Date of Joining</label>
          <input type="date" class="styled-input" name="date_of_joining" required />
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Emergency Contact Number</label>
          <input type="text" class="styled-input" name="emergency_contact_number" placeholder="Enter your emergency contact number" required />
        </div>
      </div>

      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Blood Group</label>
          <select class="styled-input" name="blood_group" required>
            <option value="" disabled selected>Select blood group</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Known Medical Conditions</label>
          <input type="text" class="styled-input" name="medical_conditions" placeholder="Enter known medical conditions" required />
        </div>
      </div>

      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Mobility Status</label>
          <select class="styled-input" name="mobility_status" required>
            <option value="" disabled selected>Select Mobility Status</option>
            <option value="Walking">Walking</option>
            <option value="Wheelchair">Wheelchair</option>
            <option value="Other">Other</option>
          </select>
        </div>
      </div>

     

    

      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Discharge</label>
          <input type="text" class="styled-input"  name="discharge" placeholder="Enter your discharge" />
        </div>
      </div>

      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Age of the patient</label>
          <input type="text" class="styled-input" name="age_of_the_patient" placeholder="Enter your age of the patient" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-field-container">
          <label class="input-label">Address</label>
          <textarea class="styled-input" rows="3" name="address" placeholder="Enter your address" required></textarea>
        </div>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="row">
      <div class="col-md-12 text-center mt-4">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>