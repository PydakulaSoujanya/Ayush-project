<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Form with Calendar</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
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

    #calendar-container {
      margin: 50px auto;
      padding: 10px;
      background: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden; /* Prevents overflow issues */
    }

    #calendar {
      max-width: 100%;
    }
  </style>
</head>
<body>
<?php include('navbar.php'); ?>
  
  <div class="container mt-7">
    <h2 class="text-center">Allotment Calendar</h2>
    <div id="calendar-container">
      <div id="calendar"></div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Allotment Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="assignmentForm">
            <div class="form-group">
              <label for="traineeName">Trainee Name</label>
              <input type="text" class="form-control" id="traineeName" placeholder="Enter trainee name" required>
            </div>
            <div class="form-group">
              <label for="customerName">Customer Name</label>
              <input type="text" class="form-control" id="customerName" placeholder="Enter customer name" required>
            </div>
            <div class="form-group">
              <label for="customerMobile">Customer Mobile Number</label>
              <input type="text" class="form-control" id="customerMobile" placeholder="Enter customer mobile number" required>
            </div>
            <div class="form-group">
              <label for="customerAddress">Customer Address</label>
              <textarea class="form-control" id="customerAddress" rows="3" placeholder="Enter customer address" required></textarea>
            </div>
            <div class="form-group">
              <label for="fromDate">From Date</label>
              <input type="date" class="form-control" id="fromDate" required>
            </div>
            <div class="form-group">
              <label for="toDate">To Date</label>
              <input type="date" class="form-control" id="toDate" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      // Initialize FullCalendar
      $('#calendar').fullCalendar({
        editable: true,
        selectable: true,
        dayClick: function (date) {
          // Open modal on date click
          $('#fromDate').val(date.format('DD-MM-YYYY'));
          $('#toDate').val(date.format('DD-MM-YYYY'));
          $('#eventModal').modal('show');
        },
        events: function (start, end, timezone, callback) {
          $.ajax({
            url: 'load_events.php',
            dataType: 'json',
            success: function (data) {
              callback(data);
            },
            error: function () {
              alert('Error loading events.');
            }
          });
        }
      });

      // Handle form submission
      $('#assignmentForm').submit(function (e) {
        e.preventDefault();
        
        // Collect form data
        const formData = {
          trainee_name: $('#traineeName').val(),
          customer_name: $('#customerName').val(),
          customer_mobile: $('#customerMobile').val(),
          customer_address: $('#customerAddress').val(),
          from_date: $('#fromDate').val(),
          to_date: $('#toDate').val()
        };

        // Submit form data via AJAX
        $.ajax({
          url: 'save_assignment.php',
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function (response) {
            if (response.status === 'success') {
              alert(response.message);
              $('#eventModal').modal('hide');
              $('#assignmentForm')[0].reset();
              $('#calendar').fullCalendar('refetchEvents'); // Reload calendar events
            } else {
              alert(response.message);
            }
          },
          error: function () {
            alert('An error occurred while saving the assignment.');
          }
        });
      });
    });
  </script>
</body>
</html>
