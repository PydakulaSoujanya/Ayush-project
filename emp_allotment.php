<?php
include('navbar.php');
include('config.php'); // Include your database connection file

// Handle month and year selection
$selectedYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$selectedMonth = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);

// Fetch employees from emp_info table
$employees = [];
$employeeQuery = "SELECT id, name FROM emp_info WHERE status = 'active'";
$result = $conn->query($employeeQuery);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Fetch customers from customer_master table
$customers = [];
$customerQuery = "SELECT id, patient_name FROM customer_master";
$result = $conn->query($customerQuery);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Calendar</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>

  <?php
include('navbar.php'); ?>
  <div class="container mt-7">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="text-center mb-0">Employee Calendar - <?= date('F Y', strtotime("$selectedYear-$selectedMonth-01")) ?></h3>
      <a href="allotment_form.php" class="btn btn-primary">New Allotment</a>
    </div>

    <!-- Month and Year Selection -->
    <form method="GET" class="mb-4">
      <div class="form-row">
        <div class="col-md-5">
          <select name="month" class="form-control">
            <?php
            for ($m = 1; $m <= 12; $m++) {
              $monthName = date('F', mktime(0, 0, 0, $m, 1));
              $selected = ($m == $selectedMonth) ? 'selected' : '';
              echo "<option value=\"$m\" $selected>$monthName</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-5">
          <select name="year" class="form-control">
            <?php
            $currentYear = date('Y');
            for ($y = $currentYear - 5; $y <= $currentYear + 5; $y++) {
              $selected = ($y == $selectedYear) ? 'selected' : '';
              echo "<option value=\"$y\" $selected>$y</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary btn-block">View</button>
        </div>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Emp Name</th>
            <th>Customer Name</th>
            <?php
            // Generate table headers for the days of the selected month
            for ($day = 1; $day <= $daysInMonth; $day++) {
              echo "<th>$day</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          // Generate rows dynamically for each employee and customer
          foreach ($employees as $employee) {
              foreach ($customers as $customer) {
                  echo "<tr>";
                  echo "<td>{$employee['name']}</td>";
                  echo "<td>{$customer['patient_name']}</td>";

                  // Generate empty cells for each day of the month
                  for ($day = 1; $day <= $daysInMonth; $day++) {
                      echo "<td></td>";
                  }

                  echo "</tr>";
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
