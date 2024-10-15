<?php
// Include the database connection file
include 'db_conn.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if student ID and status are set
    if (isset($_POST['student_id']) && isset($_POST['status'])) {
        $student_id = $_POST['student_id'];
        $new_status = $_POST['status'];

        // Sanitize input to prevent SQL injection
        $student_id = mysqli_real_escape_string($conn, $student_id);
        $new_status = mysqli_real_escape_string($conn, $new_status);

        // Prepare the SQL query to update the student's status
        $update_status_query = "UPDATE students SET status = '$new_status' WHERE student_id = '$student_id'";

        // Execute the update query
        if (mysqli_query($conn, $update_status_query)) {
            // Redirect back to the admin panel with success message
            header("Location: admin_panel.php?status_update_success=1");
            exit;
        } else {
            // Redirect back with error message
            header("Location: admin_panel.php?status_update_error=1");
            exit;
        }
    } else {
        // Redirect back if no student ID or status is provided
        header("Location: admin_panel.php?status_update_error=1");
        exit;
    }
} else {
    // If not a POST request, redirect back
    header("Location: admin_panel.php?status_update_error=1");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
