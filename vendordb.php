<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database configuration file
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capture and sanitize form data
    $vendor_name = mysqli_real_escape_string($conn, $_POST['vendor_name']);
    $gstin = mysqli_real_escape_string($conn, $_POST['gstin']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $vendor_type = mysqli_real_escape_string($conn, $_POST['vendor_type']);
    $services_provided = mysqli_real_escape_string($conn, $_POST['services_provided']);
    $additional_notes = mysqli_real_escape_string($conn, $_POST['additional_notes']);
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $ifsc = mysqli_real_escape_string($conn, $_POST['ifsc']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Handle file upload for supporting_documents
    $document = '';
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        // Ensure the uploads directory exists and has proper permissions
        $target_dir = "uploads/";
        $file_name = basename($_FILES["document"]["name"]);
        $document = $target_dir . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $document)) {
            // File successfully uploaded
            // echo "File uploaded to: " . $document; // Debug line
        } else {
            die("Error uploading file.");
        }
    } else {
        echo "No file uploaded or upload error."; // Debugging
    }

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO vendors (vendor_name, gstin, contact_person, document, phone_number, email, address, vendor_type, services_provided, additional_notes, bank_name, account_number, ifsc, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param(
        "ssssssssssssss",
        $vendor_name,
        $gstin,
        $contact_person,
        $document,
        $phone_number,
        $email,
        $address,
        $vendor_type,
        $services_provided,
        $additional_notes,
        $bank_name,
        $account_number,
        $ifsc,
        $status
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Vendor created successfully!'); window.location.href='vendors.php';</script>";
        exit;
    } else {
        echo "Database Error: " . $stmt->error . "<br>";
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
