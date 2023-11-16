<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directory where evaluations will be stored
    $target_dir = "uploads/";
    
    // Generate a unique name for the assessment
    $target_file = $target_dir . uniqid() . basename($_FILES["evidence"]["name"]);
    
    // Get the MIME type of the file
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Validate MIME type (only allow PDF files)
    if ($fileType != "pdf") {
        echo "Only PDF files are allowed.";
    } else {
        // Validate the file size (2 Megabytes maximum)
        if ($_FILES["evidence"]["size"] > 2 * 1024 * 1024) {
            echo "The file is too large. Maximum size allowed: 2MB.";
        } else {
            // Move file to destination directory
            if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $target_file)) {
                echo "The evaluation has been uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        }
    }
}
?>
