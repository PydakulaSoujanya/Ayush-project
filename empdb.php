<?php
// Start the session and connect to the database
session_start();
include('config.php'); // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;
    $qualification = $_POST['qualification'] ?? null;
    $experience = $_POST['experience'] ?? null;
    $doj = $_POST['doj'] ?? null;
    $aadhar = $_POST['aadhar'] ?? null;
    $police_verification = $_POST['police_verification'] ?? null;
    $status = $_POST['status'] ?? null;
    $bank_name = $_POST['bank_name'] ?? null;
    $bank_account_no = $_POST['bank_account_no'] ?? null;
    $ifsc_code = $_POST['ifsc_code'] ?? null;
    $address = $_POST['address'] ?? null;
    $daily_rate8 = $_POST['daily_rate8'] ?? null;
    $daily_rate12 = $_POST['daily_rate12'] ?? null;
    $daily_rate24 = $_POST['daily_rate24'] ?? null;
    $reference = $_POST['reference'] ?? null;
    $vendor_name = $_POST['vendor_name'] ?? null;
    $vendor_id = $_POST['vendor_id'] ?? null;
    $vendor_contact = $_POST['vendor_contact'] ?? null;

    // Upload directory
    $uploadDir = "uploads/";

    // File upload handling
    $adhar_upload_doc = uploadFile($_FILES['adhar_upload_doc'] ?? null, $uploadDir, "Adhar Upload Document");
    $document1 = uploadFile($_FILES['document1'] ?? null, $uploadDir, "Document 1");
    $document2 = uploadFile($_FILES['document2'] ?? null, $uploadDir, "Document 2");
    $document3 = uploadFile($_FILES['document3'] ?? null, $uploadDir, "Document 3");
    $document4 = uploadFile($_FILES['document4'] ?? null, $uploadDir, "Document 4");
    $police_verification_form = null;

    if ($police_verification === 'verified') {
        $police_verification_form = uploadFile($_FILES['verification_document'] ?? null, $uploadDir, "Police Verification Document");
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO emp_info 
        (name, dob, gender, phone, email, role, qualification, experience, doj, aadhar, police_verification, police_verification_form, status, daily_rate8, daily_rate12, daily_rate24, adhar_upload_doc, document1, document2, document3, document4, reference, vendor_name, vendor_id, vendor_contact, bank_name, bank_account_no, ifsc_code, address) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssssssssssssssssssssssssss",
        $name,
        $dob,
        $gender,
        $phone,
        $email,
        $role,
        $qualification,
        $experience,
        $doj,
        $aadhar,
        $police_verification,
        $police_verification_form,
        $status,
        $daily_rate8,
        $daily_rate12,
        $daily_rate24,
        $adhar_upload_doc,
        $document1,
        $document2,
        $document3,
        $document4,
        $reference,
        $vendor_name,
        $vendor_id,
        $vendor_contact,
        $bank_name,
        $bank_account_no,
        $ifsc_code,
        $address
    );

    // Execute and check
    if ($stmt->execute()) {
        echo "<script>
                alert('Successfully added record');
                window.location.href = 'table.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $stmt->error . "');
              </script>";
    }
}

// Close connection
$conn->close();

// File upload function
function uploadFile($file, $targetDir, $fieldName) {
    if (isset($file) && $file['error'] == 0) {
        // Ensure the target directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $filePath = $targetDir . uniqid() . "_" . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $filePath)) {
            return $filePath; // Return file path to store in DB
        } else {
            echo "<script>alert('Error uploading $fieldName.');</script>";
        }
    }
    return null; // Return null if no file was uploaded
}
?>
