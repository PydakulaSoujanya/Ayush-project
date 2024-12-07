<?php
session_start();
$alert_message = isset($_SESSION['alert_message']) ? $_SESSION['alert_message'] : null;
$alert_type = isset($_SESSION['alert_type']) ? $_SESSION['alert_type'] : null;

// Clear session variables after displaying the alert
unset($_SESSION['alert_message'], $_SESSION['alert_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Form</title>
 
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">






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

   

.styled-input {
  padding-right: 40px; /* Make space for the icon inside the field */
}

</style>

  
</head>
<body>
<?php include('navbar.php'); ?>
  <div class="container mt-7">
    <h3 class="mb-4">Employee Form</h3>
    <form method="POST" enctype="multipart/form-data" action="empdb.php">
  <!-- Row 1 -->
  <div class="row">
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Name</label>
        <input type="text" name="name" class="styled-input" placeholder="Enter your name" required />
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
      <label class="input-label">Date of Birth</label>
            <input type="date" name="dob" class="styled-input date-input" required />
            <!-- <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required> -->
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Gender</label>
        <select name="gender" class="styled-input" required>
          <option value="" disabled selected>Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Phone Number</label>
        <input type="tel" name="phone" class="styled-input" placeholder="Enter phone number" pattern="[0-9]{10}" required />
      </div>
    </div>
  </div>

  <!-- Row 2 -->
  <div class="row">
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Email</label>
        <input type="email" name="email" class="styled-input" placeholder="Enter email" required />
      </div>
    </div>
    <div class="col-md-3">
  <div class="input-field-container" style="position: relative;">
    <label class="input-label">Role</label>
    <select name="role" class="styled-input form-control" required>
      <option value="" disabled selected>Select Role</option>
      <option value="care_taker">Care Taker</option>
      <option value="nanny">Nanny</option>
      <option value="fully_trained_nurse">Fully Trained Nurse</option>
      <option value="semi_trained_nurse">Semi Trained Nurse</option>
    </select>
   
  </div>
</div>


    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Qualification</label>
        <select name="qualification" class="styled-input" required>
          <option value="" disabled selected>Select Qualification</option>
          <option value="10th">10th</option>
          <option value="intermediate">Intermediate</option>
          <option value="degree">Degree</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Experience</label>
        <select name="experience" class="styled-input" required>
          <option value="" disabled selected>Select Experience</option>
          <option value="0-1">0 to 1 year</option>
          <option value="2-3">2 to 3 years</option>
          <option value="4-5">4 to 5 years</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Row 3 -->
  <div class="row">
  <div class="col-md-3">
          <div class="input-field-container">
            <label class="input-label">Date of Joining</label>
            <input type="date" name="doj" class="styled-input date-input" required />
          </div>
        </div>
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Aadhar Number</label>
        <input type="text" name="aadhar" class="styled-input" placeholder="Enter Aadhar Number" pattern="[0-9]{12}" required />
      </div>
    </div>
    <!-- <div class="row"> -->
  <!-- Police Verification Field -->
  <div class="col-md-3">
    <div class="input-field-container">
      <label class="input-label">Police Verification</label>
      <select 
        name="police_verification" 
        class="styled-input form-control" 
        id="policeVerificationSelect" 
        required
        onchange="toggleDocumentUploadField()">
        <option value="" disabled selected>Select Status</option>
        <option value="verified">Verified</option>
        <option value="pending">Pending</option>
      </select>
    </div>
  </div>

  <!-- Hidden Document Upload Field -->
  <div class="col-md-3" id="documentUploadField" style="display: none;">
    <div class="input-field-container">
      <label class="input-label">Upload Document</label>
      <input 
        type="file" 
        name="verification_document" 
        class="styled-input form-control" 
        accept=".pdf,.jpg,.jpeg,.png" 
        required />
    </div>
  </div>
<!-- </div> -->
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Status</label>
        <select name="status" class="styled-input" required>
          <option value="" disabled selected>Select Status</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
    </div>
   
  </div>

  <!-- Row 4 -->
  <div class="row">

  <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Daily Rate-8 hours</label>
        <input type="number" name="daily_rate8" class="styled-input" placeholder="Enter Daily Rate" required />
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
      <label class="input-label">Daily Rate-12 hours</label>
      <input type="number" name="daily_rate12" class="styled-input" placeholder="Enter Daily Rate" required />
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
      <label class="input-label">Daily Rate-24 hours</label>
      <input type="number" name="daily_rate24" class="styled-input" placeholder="Enter Daily Rate" required />
      </div>
    </div>
    
    <div class="col-md-3">
  <div class="input-field-container">
    <label class="input-label">Aadhar Upload Document</label>
    <input 
      type="file" 
      name="adhar_upload_doc" 
      class="styled-input" 
      accept=".pdf,.jpg,.jpeg,.png" 
      required 
      title="Please upload a valid Aadhar document (PDF, JPG, JPEG, or PNG)" />
  </div>
</div>

<div class="col-md-3">
  <div class="input-field-container">
    <label class="input-label">Other Document</label>
    <div id="document-upload-container">
      <!-- Initial Document Upload Field -->
      <div class="document-upload-field d-flex align-items-center mb-2">
        <input 
          type="file" 
          name="other_doc[]" 
          class="styled-input form-control" 
          accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
          required 
          title="Upload a document (PDF, JPG, PNG, DOC, DOCX)" />
        <!-- Add Icon for Remove (Initially Hidden) -->
        <i class="fas fa-trash-alt text-danger remove-field ms-2" style="display: none; cursor: pointer;" title="Remove"></i>
      </div>
    </div>
    <!-- Add More Icon -->
    <i 
      class="fas fa-plus-circle text-success mt-2" 
      id="add-more-documents" 
      style="font-size: 1.5rem; cursor: pointer;" 
      title="Add More">
    </i>
  </div>
</div>


    <div class="col-md-3">
  <div class="input-field-container">
    <label class="input-label">Bank Name</label>
   
    <select name="bank_name" class="styled-input form-control" required>
      <option value="" disabled selected>Select Bank Name</option>
      <?php include("banks-dropdown.php");?>
    </select>
  </div>
</div>


    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">Bank Account Number</label>
        <input type="text" name="bank_account_no" class="styled-input" placeholder="Enter Account Number" required />
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-field-container">
        <label class="input-label">IFSC Code</label>
        <input type="text" name="ifsc_code" class="styled-input" placeholder="Enter IFSC Code" required />
      </div>
    </div>
    <div class="col-md-3">
  <div class="input-field-container">
    <label class="input-label">Reference</label>
    <select name="reference" id="reference" class="styled-input" required>
      <option value="" disabled selected>Select Reference</option>
      <option value="ayush">Ayush</option>
      <option value="vendors">Vendors</option>
    </select>
  </div>
</div>

<!-- Hidden Fields for Vendor Name and Contact -->
<div class="col-md-3" id="vendorFields" style="display: none;">
  <div class="input-field-container">
  <input type="text" name="vendor_id" class="styled-input"  />
    <label class="input-label">Vendor Name</label>
    <select name="vendor_name" id="vendor_name" class="styled-input" required>
            <option value="" disabled selected>Select Vendor</option>
        </select>
    <!-- <input type="text" name="vendor_name" class="styled-input" placeholder="Enter Vendor Name" /> -->
  </div>
</div>
<div class="col-md-3" id="vendorContactField" style="display: none;">
  <div class="input-field-container">
    <label class="input-label">Vendor Contact Number</label>
    <input type="text" name="vendor_contact" class="styled-input" placeholder="Enter Vendor Contact Number" pattern="[0-9]{10}" />
  </div>
</div>

<!-- Address Field -->
<div class="col-md-6">
  <div class="input-field-container">
    <label class="input-label">Address</label>
    <textarea name="address" class="styled-input" placeholder="Enter Address" rows="3" required></textarea>
  </div>
  
</div>

<script>
  document.getElementById('reference').addEventListener('change', function () {
    const vendorFields = document.getElementById('vendorFields');
    const vendorContactField = document.getElementById('vendorContactField');

    if (this.value === 'vendors') {
      // Show the Vendor Name and Contact fields
      vendorFields.style.display = 'block';
      vendorContactField.style.display = 'block';


  fetchVendorData(this.value);

    } else {
      // Hide the Vendor Name and Contact fields
      vendorFields.style.display = 'none';
      vendorContactField.style.display = 'none';
    }
  });
 function fetchVendorData(reference) {
  fetch("fetch_vendor_data.php?reference=" + reference)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      } 
      return response.text(); // Read as text first for debugging
    })
    .then(text => {
      console.log('Raw response:', text); // Debug raw response
      try {
        const data = JSON.parse(text); // Try parsing JSON
        if (data.error) {
          console.error("Server error:", data.error);
          return;
        }
        if (data.length > 0) {
          alert("on clicked vendors and calling fetchVendor fun");
          const vendorNameSelect = document.getElementById('vendor_name');
          vendorNameSelect.innerHTML = '<option value="" disabled selected>Select Vendor</option>';
          // Populate the dropdown with vendor details
data.forEach(vendor => {
  const option = document.createElement('option');
  option.value = vendor.vendor_name; // Use vendor name as the value
  option.text = vendor.vendor_name; // Display vendor name
  option.dataset.phone = vendor.phone_number; // Store phone number in a data attribute
  option.dataset.id = vendor.id; // Store vendor ID in a data attribute
  vendorNameSelect.appendChild(option);
});

// Add an event listener to the dropdown to update fields dynamically
vendorNameSelect.addEventListener('change', function () {
  const selectedOption = vendorNameSelect.options[vendorNameSelect.selectedIndex];
  const vendorContactField = document.querySelector('input[name="vendor_contact"]');
  const vendorIdField = document.querySelector('input[name="vendor_id"]');

  if (selectedOption) {
    // Set the phone number and vendor ID based on the selected option
    vendorContactField.value = selectedOption.dataset.phone || ''; // Default to empty if not found
    vendorIdField.value = selectedOption.dataset.id || ''; // Default to empty if not found
  } else {
    // Clear the fields if no vendor is selected
    vendorContactField.value = '';
    vendorIdField.value = '';
  }
});

        } else {
          console.error("No vendors found.");
        }
      } catch (e) {
        console.error("Failed to parse JSON:", e);
      }
    })
    .catch(error => {
      console.error("Error fetching vendor data:", error);
    });
}

</script>


  </div>

 
  <!-- Submit Button -->
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
<!-- Alert Modal -->
<!-- Add Vendor Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addVendorModalLabel">Add Vendor Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="vendordb.php" method="POST" enctype="multipart/form-data">
          <!-- Vendor Form Fields -->
          <div class="row">
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Vendor Name</label>
                <input type="text" id="vendor_name" name="vendor_name" class="styled-input" placeholder="Enter Vendor Name" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">GSTIN</label>
                <input type="text" id="gstin" name="gstin" class="styled-input" placeholder="Enter GSTIN" />
              </div>
            </div>
          </div>
          <!-- Additional Fields (Contact, Address, etc.) -->
          <div class="row">
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Contact Person</label>
                <input type="text" id="contact_person" name="contact_person" class="styled-input" placeholder="Enter Contact Person" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" class="styled-input" placeholder="Enter Phone Number" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Email</label>
                <input type="email" id="email" name="email" class="styled-input" placeholder="Enter Email" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Vendor Type</label>
                <select name="vendor_type" id="vendor_type" class="styled-input">
                  <option value="Individual">Individual</option>
                  <option value="Company">Company</option>
                </select>
              </div>
            </div>
          </div>
          <!-- Bank Details -->
          <h4>Bank Details</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Bank Name</label>
                <input type="text" id="bank_name" name="bank_name" class="styled-input" placeholder="Enter Bank Name" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-field-container">
                <label class="input-label">Account Number</label>
                <input type="text" id="account_number" name="account_number" class="styled-input" placeholder="Enter Account Number" />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




 
<script>
  
  function toggleDocumentUploadField() {
    const selectElement = document.getElementById('policeVerificationSelect');
    const documentUploadField = document.getElementById('documentUploadField');
    
    if (selectElement.value === 'verified') {
      documentUploadField.style.display = 'block';
    } else {
      documentUploadField.style.display = 'none';
    }
  }

   // JavaScript to Add More Document Upload Fields
   document.getElementById('add-more-documents').addEventListener('click', function () {
    // Create a new document upload field
    const newField = document.createElement('div');
    newField.classList.add('document-upload-field', 'd-flex', 'align-items-center', 'mb-2');
    newField.innerHTML = `
      <input 
        type="file" 
        name="other_doc[]" 
        class="styled-input form-control" 
        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
        required 
        title="Upload a document (PDF, JPG, PNG, DOC, DOCX)" />
      <i 
        class="fas fa-trash-alt text-danger remove-field ms-2" 
        style="cursor: pointer;" 
        title="Remove">
      </i>
    `;
    
    // Add the new field to the container
    document.getElementById('document-upload-container').appendChild(newField);

    // Add event listener to the remove icon
    newField.querySelector('.remove-field').addEventListener('click', function () {
      newField.remove();
    });
  });

  // Show the remove icon for the initial field when more fields are added
  document.getElementById('add-more-documents').addEventListener('click', function () {
    const fields = document.querySelectorAll('.document-upload-field .remove-field');
    fields.forEach(icon => icon.style.display = 'inline'); // Show all remove icons
  });
    document.getElementById('reference').addEventListener('change', function () {
    const addVendorBtn = document.getElementById('addVendorBtn');
    if (this.value === 'vendors') {
      addVendorBtn.style.display = 'inline-block'; // Show the "+" button
    } else {
      addVendorBtn.style.display = 'none'; // Hide the "+" button
    }
  });

  document.getElementById('addVendorBtn').addEventListener('click', function () {
    alert('Add Vendor functionality goes here!');
    // Add logic to handle vendor addition, such as opening a modal or navigating to another page
  });
  document.getElementById('reference').addEventListener('change', function () {
    const addVendorBtn = document.getElementById('addVendorBtn');
    if (this.value === 'vendors') {
      addVendorBtn.style.display = 'inline-block'; // Show the "+" button
    } else {
      addVendorBtn.style.display = 'none'; // Hide the "+" button
    }
  });
</script>


<!-- jQuery, Popper.js, and Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>