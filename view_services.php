<?php
// Connect to the database
// Connect to the database
include 'config.php';
include 'navbar.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination Variables
$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 5;
$pageIndex = isset($_GET['pageIndex']) ? $_GET['pageIndex'] : 0;
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Query to fetch data with pagination, search, and ordering by the created_at column
$start = $pageIndex * $pageSize;
$sql = "SELECT * FROM service_requests WHERE customer_name LIKE '%$searchTerm%' ORDER BY created_at DESC LIMIT $start, $pageSize";
$result = $conn->query($sql);

// Get total number of records for pagination
$countSql = "SELECT COUNT(*) as total FROM service_requests WHERE customer_name LIKE '%$searchTerm%'";
$countResult = $conn->query($countSql);
$countRow = $countResult->fetch_assoc();
$totalRecords = $countRow['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Include Font Awesome -->
  
  <title>Data Table</title>
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
    .action-icons i {
      color: black;
      cursor: pointer;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <div class="container  mt-7">
    <div class="dataTable_card card">
      <!-- Card Header -->
      <div class="card-header"> Capturing Services Table</div>

      <!-- Card Body -->
      <div class="card-body">
        <!-- Search Input -->
        <div class="dataTable_search mb-3 d-flex justify-content-between">
    <form method="GET" action="" class="d-flex w-75">
        <input type="text" class="form-control" id="globalSearch" placeholder="Search...">
    </form>
    <a href="services.php" class="btn btn-success">+ Capture Service</a>
</div>


        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr class="dataTable_headerRow">
                <th>S.no</th>
                <th>Customer Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Enquiry Source</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              if ($result->num_rows > 0) {
                  $serial = $start + 1;
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr class='dataTable_row'>
                              <td>{$serial}</td>
                              <td>{$row['customer_name']}</td>
                              <td>{$row['contact_no']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['enquiry_source']}</td>
                              <td class='action-icons'>
                               <a href='#' class='view-btn' data-id='{$row['id']}' data-customer_name='{$row['customer_name']}' data-contact_no='{$row['contact_no']}' data-email='{$row['email']}' data-enquiry_date='{$row['enquiry_date']}' data-enquiry_time='{$row['enquiry_time']}' data-service_type='{$row['service_type']}' data-enquiry_source='{$row['enquiry_source']}' data-priority_level='{$row['priority_level']}' data-status='{$row['status']}' data-request_details='{$row['request_details']}' data-resolution_notes='{$row['resolution_notes']}' data-comments='{$row['comments']}' data-created_at='{$row['created_at']}'>
                                  <i class='fas fa-eye'></i>
                                </a>
                             <a href='update_service.php?id={$row['id']}'><i class='fas fa-edit'></i></a>
                             <a href='delete_service.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete?\")'><i class='fas fa-trash'></i></a>
                              </td>
                            </tr>";
                      $serial++;
                  }
              } else {
                  echo "<tr><td colspan='6'>No data available</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        
 <!-- Modal for Viewing Details -->
 <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalLabel">Service Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <table class="table">
          <tbody>
         
          <p><strong>Customer Name:</strong> <span id="customer_name"></span></p>
          <p><strong>Contact No:</strong> <span id="contact_no"></span></p>
          <p><strong>Email:</strong> <span id="email"></span></p>
          <p><strong>Enquiry Date:</strong> <span id="enquiry_date"></span></p>
          <p><strong>Enquiry Time:</strong> <span id="enquiry_time"></span></p>
          <p><strong>Service Type:</strong> <span id="service_type"></span></p>
          <p><strong>Enquiry Source:</strong> <span id="enquiry_source"></span></p>
          <p><strong>Priority Level:</strong> <span id="priority_level"></span></p>
          <p><strong>Status:</strong> <span id="status"></span></p>
          <p><strong>Request Details:</strong> <span id="request_details"></span></p>
          <p><strong>Resolution Notes:</strong> <span id="resolution_notes"></span></p>
          <p><strong>Comments:</strong> <span id="comments"></span></p>
          <p><strong>Created At:</strong> <span id="created_at"></span></p>
          </tbody>
          </table>
        </div>
      </div>
    </div>
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
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
       // JavaScript for populating and showing the modal
       document.querySelectorAll('.view-btn').forEach(button => {
      button.addEventListener('click', function() {
        const data = this.dataset;
        document.getElementById('customer_name').textContent = data.customer_name;
        document.getElementById('contact_no').textContent = data.contact_no;
        document.getElementById('email').textContent = data.email;
        document.getElementById('enquiry_date').textContent = data.enquiry_date;
        document.getElementById('enquiry_time').textContent = data.enquiry_time;
        document.getElementById('service_type').textContent = data.service_type;
        document.getElementById('enquiry_source').textContent = data.enquiry_source;
        document.getElementById('priority_level').textContent = data.priority_level;
        document.getElementById('status').textContent = data.status;
        document.getElementById('request_details').textContent = data.request_details;
        document.getElementById('resolution_notes').textContent = data.resolution_notes;
        document.getElementById('comments').textContent = data.comments;
        document.getElementById('created_at').textContent = data.created_at;

        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('viewModal'));
        myModal.show();
      });
    });
    // Sample Data
    const data = Array.from({ length: 50 }, (_, i) => ({
      id: i + 1,
      name: `Person ${i + 1}`,
      age: Math.floor(Math.random() * 40) + 20,
      city: `City ${Math.floor(Math.random() * 10) + 1}`,
    }));

    // Pagination Variables
    let pageIndex = 0;
    let pageSize = 5;

    // Elements
    const tableBody = document.getElementById("tableBody");
    const pageInfo = document.getElementById("pageInfo");
    const previousPage = document.getElementById("previousPage");
    const nextPage = document.getElementById("nextPage");
    const pageSizeSelect = document.getElementById("pageSize");
    const globalSearch = document.getElementById("globalSearch");

    // Functions to Render Table
    function renderTable() {
      const start = pageIndex * pageSize;
      const filteredData = data.filter((item) =>
        item.name.toLowerCase().includes(globalSearch.value.toLowerCase())
      );
      const pageData = filteredData.slice(start, start + pageSize);

      tableBody.innerHTML = pageData
        .map(
          (row) =>
            `<tr class="dataTable_row">
              <td>${row.id}</td>
              <td>${row.name}</td>
              <td>${row.age}</td>
              <td>${row.city}</td>
            </tr>`
        )
        .join("");

      pageInfo.textContent = `${pageIndex + 1} of ${Math.ceil(filteredData.length / pageSize)}`;
      previousPage.disabled = pageIndex === 0;
      nextPage.disabled = pageIndex >= Math.ceil(filteredData.length / pageSize) - 1;
    }

    // Event Listeners
    previousPage.addEventListener("click", () => {
      if (pageIndex > 0) {
        pageIndex--;
        renderTable();
      }
    });

    nextPage.addEventListener("click", () => {
      pageIndex++;
      renderTable();
    });

    pageSizeSelect.addEventListener("change", (e) => {
      pageSize = Number(e.target.value);
      pageIndex = 0;
      renderTable();
    });

    globalSearch.addEventListener("input", () => {
      pageIndex = 0;
      renderTable();
    });

    // Initial Render
    renderTable();
    
  </script>
  
</body>
</html>
