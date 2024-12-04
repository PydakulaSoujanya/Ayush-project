<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Request Form</title>
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

    h1, h2, h3, h4 {
      color: #A26D2B;
    }
    @media (max-width: 768px) {
  .form-section {
    padding: 15px;
    margin: 10px;
  }

  .styled-input {
    font-size: 12px;
    padding: 8px;
  }

  .input-label {
    font-size: 12px;
  }
}

@media (max-width: 576px) {
  .form-section {
    padding: 10px;
    margin: 5px;
  }

  .styled-input {
    font-size: 12px;
    padding: 6px;
  }

  .input-label {
    font-size: 11px;
  }

  button {
    font-size: 14px;
    padding: 8px 12px;
  }
}

/* Form Responsiveness */
.row {
  margin: 0 -10px;
}

.col-md-6, .col-md-12 {
  padding: 0 10px;
}
  </style>
</head>
<body>
  <div class="container mt-5">
    <h3 class="mb-4">Capturing Service Request Form</h3>
    <div class="form-section">
      <form>
        <div class="row">
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Customer Name</label>
              <input type="text" class="styled-input" placeholder="Enter Customer Name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Contact No</label>
              <input type="text" class="styled-input" placeholder="Enter Contact Number">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Email</label>
              <input type="email" class="styled-input" placeholder="Enter Email">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Inquiry Date</label>
              <input type="date" class="styled-input">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Inquiry Time</label>
              <input type="time" class="styled-input">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Service Type</label>
              <select class="styled-input">
                <option value="" disabled selected>Select Service Type</option>
                <option value="bank">Bank Reconciliation</option>
                <option value="account">Account Information</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Inquiry Source</label>
              <select class="styled-input">
                <option value="" disabled selected>Select Inquiry Source</option>
                <option value="phone">Phone Call</option>
                <option value="email">Email</option>
                <option value="walkin">Walk-In</option>
                <option value="website">Website</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Priority Level</label>
              <select class="styled-input">
                <option value="" disabled selected>Select Priority Level</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Status</label>
              <select class="styled-input">
                <option value="" disabled selected>Select Status</option>
                <option value="new">New</option>
                <option value="pending">Pending</option>
                <option value="followup">Follow-Up Required</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Request Details</label>
              <input type="text" class="styled-input" placeholder="Enter Request Details">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Resolution Notes</label>
              <textarea class="styled-input" rows="1" placeholder="Enter Resolution Notes"></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-field-container">
              <label class="input-label">Comments</label>
              <textarea class="styled-input" rows="1" placeholder="Enter Comments"></textarea>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
      </form>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
