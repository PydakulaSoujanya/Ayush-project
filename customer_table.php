<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Styled Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .dataTable_wrapper {
      padding: 20px;
    }

    .dataTable_search input {
      max-width: 200px;
    }

    .dataTable_headerRow th,
    .dataTable_row td {
      border: 1px solid #dee2e6; /* Add borders for columns */
    }

    .dataTable_headerRow {
      background-color: #f8f9fa;
      font-weight: bold;
    }

    .dataTable_row:hover {
      background-color: #f1f1f1;
    }

    .dataTable_card {
      border: 1px solid #ced4da; /* Add card border */
      border-radius: 0.5rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dataTable_card .card-header {
      background-color:  #A26D2B;
      color: white;
      font-weight: bold;
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
    <div class="dataTable_card card">
      <!-- Card Header -->
      <div class="card-header"> Customer Data Table</div>

      <!-- Card Body -->
      <div class="card-body">
        <!-- Search Input -->
        <div class="dataTable_search mb-3">
          <input type="text" class="form-control" id="globalSearch" placeholder="Search...">
        </div>

        <!-- Table -->
        <div class="table-responsive">
        <table class="table table-striped">
    <thead>
      <tr class="dataTable_headerRow">
        <th>S.no</th>
        <th>Full Name</th>
        <th>Age</th>
        <th>Mobile</th>
        <th>Emergency Contact </th>
        <th>Blood Group</th>
        <th>Actions</th> <!-- New Column for Actions -->
      </tr>
    </thead>
    <tbody id="tableBody">
      <!-- Dynamic Rows Will Be Added Here -->
    </tbody>
  </table>
        </div>

        <!-- Pagination Controls -->
        <div class="d-flex align-items-center justify-content-between mt-3">
          <div>
            <button id="previousPage" class="btn btn-sm btn-primary me-2">Previous</button>
            <button id="nextPage" class="btn btn-sm btn-primary">Next</button>
          </div>
          <div class="dataTable_pageInfo">
            Page <strong id="pageInfo">1 of 1</strong>
          </div>
          <div>
            <select id="pageSize" class="form-select form-select-sm">
              <option value="5">Show 5</option>
              <option value="10">Show 10</option>
              <option value="20">Show 20</option>
            </select>
          </div>
        </div>
        <!-- Card Header -->
      </div>
    </div>
  </div>

  <script>
   let data = []; // Will be populated dynamically
let pageIndex = 0;
let pageSize = 5;

const tableBody = document.getElementById("tableBody");
const pageInfo = document.getElementById("pageInfo");
const previousPage = document.getElementById("previousPage");
const nextPage = document.getElementById("nextPage");
const pageSizeSelect = document.getElementById("pageSize");
const globalSearch = document.getElementById("globalSearch");

// Fetch data from the server
async function fetchData() {
    try {
        const response = await fetch('fetch_data.php');
        if (response.ok) {
            data = await response.json();
            renderTable();
        } else {
            console.error('Failed to fetch data.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Render table rows
function renderTable() {
    const start = pageIndex * pageSize;
    const filteredData = data.filter((item) =>
        item.full_name.toLowerCase().includes(globalSearch.value.toLowerCase())
    );
    const pageData = filteredData.slice(start, start + pageSize);

    tableBody.innerHTML = pageData
        .map(
            (row) =>
                `<tr class="dataTable_row">
                    <td>${row.id}</td>
                    <td>${row.full_name}</td>
                    <td>${row.age || 'N/A'}</td>
                    <td>${row.phone_number || 'N/A'}</td>
                    <td>${row.emergency_contact_number || 'N/A'}</td>
                    <td>${row.blood_group || 'N/A'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary view-btn" data-id="${row.id}">
                            View
                        </button>
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                            Delete
                        </button>
                    </td>
                </tr>`
        )
        .join("");

    pageInfo.textContent = `${pageIndex + 1} of ${Math.ceil(filteredData.length / pageSize)}`;
    previousPage.disabled = pageIndex === 0;
    nextPage.disabled = pageIndex >= Math.ceil(filteredData.length / pageSize) - 1;

    // Add event listeners for View, Edit, and Delete buttons
    document.querySelectorAll(".view-btn").forEach((btn) =>
        btn.addEventListener("click", (e) => handleView(e.target.dataset.id))
    );
    document.querySelectorAll(".edit-btn").forEach((btn) =>
        btn.addEventListener("click", (e) => handleEdit(e.target.dataset.id))
    );
    document.querySelectorAll(".delete-btn").forEach((btn) =>
        btn.addEventListener("click", (e) => handleDelete(e.target.dataset.id))
    );
}

function handleView(id) {
    const record = data.find((item) => item.id == id);
    if (record) {
        alert(`Details:\n\nFull Name: ${record.full_name}\nAge: ${record.age}\nPhone: ${record.phone_number}`);
    } else {
        alert("Record not found.");
    }
}


function handleEdit(id) {
    const record = data.find((item) => item.id == id);
    if (record) {
        // Open edit modal or form with the data
        console.log("Edit Record", record);
        alert("Edit functionality can be implemented to open a form prefilled with details!");
    } else {
        alert("Record not found.");
    }
}

function handleDelete(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        // Send a request to delete the record on the server
        fetch(`delete_data.php?id=${id}`, { method: 'DELETE' })
            .then(response => {
                if (response.ok) {
                    alert("Record deleted successfully!");
                    fetchData(); // Reload data
                } else {
                    alert("Failed to delete record.");
                }
            })
            .catch(error => console.error("Error:", error));
    }
}

// Navigation buttons
previousPage.addEventListener("click", () => {
    if (pageIndex > 0) {
        pageIndex--;
        renderTable();
    }
});

nextPage.addEventListener("click", () => {
    if (pageIndex < Math.ceil(data.length / pageSize) - 1) {
        pageIndex++;
        renderTable();
    }
});

pageSizeSelect.addEventListener("change", (e) => {
    pageSize = parseInt(e.target.value);
    renderTable();
});

globalSearch.addEventListener("input", renderTable);

// Fetch and render data on page load
fetchData();

  </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
