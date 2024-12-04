<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Calendar</title>
    <!-- Add Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <!-- Header for the Employee Calendar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Allotment Calendar</h2>
            <!-- Search and Add functionality (optional) -->
            <div class="d-flex">
                <input type="text" class="form-control me-2" id="searchEmployee" placeholder="Search Employee" style="max-width: 200px;">
                <button class="btn btn-success" onclick="addEmployee()">+ Add Employee</button>
            </div>
        </div>

        <table class="table table-bordered table-hover text-center" style="background-color: white;">
            <thead class="table-primary">
                <tr>
                    <th>Employee Name</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold">Varna</td>
                    <td class="table-light"></td>
                    <td class="table-success">-</td>
                    <td class="table-success">-</td>
                    <td class="table-success">-</td>
                    <td class="table-light"></td>
                    <td class="table-light"></td>
                    <td class="table-light"></td>
                </tr>
                <tr>
                    <td class="fw-bold">Bhargav</td>
                    <td class="table-light"></td>
                    <td class="table-light"></td>
                    <td class="table-success">-</td>
                    <td class="table-success">-</td>
                    <td class="table-success">-</td>
                    <td class="table-light"></td>
                    <td class="table-light"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS (optional for additional interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to simulate adding an employee
        function addEmployee() {
            alert('Add Employee functionality goes here!');
        }
    </script>
</body>
</html>
