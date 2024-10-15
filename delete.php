<?php
    // Include the database connection file
    include 'db_conn.php';

    // Check if a student ID is provided for deletion
    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];

        // First, delete the related data from all associated tables
        $delete_personal_info_query = "DELETE FROM personal_information WHERE student_id = '$student_id'";
        $delete_contact_info_query = "DELETE FROM contact_information WHERE student_id = '$student_id'";
        $delete_educational_info_query = "DELETE FROM educational_information WHERE student_id = '$student_id'";
        $delete_family_info_query = "DELETE FROM family_information WHERE student_id = '$student_id'";

        // Execute deletion from associated tables
        mysqli_query($conn, $delete_personal_info_query);
        mysqli_query($conn, $delete_contact_info_query);
        mysqli_query($conn, $delete_educational_info_query);
        mysqli_query($conn, $delete_family_info_query);

        // After deleting from related tables, delete the student from the main 'students' table
        $delete_student_query = "DELETE FROM students WHERE student_id = '$student_id'";
        if (mysqli_query($conn, $delete_student_query)) {
            // Redirect to admin panel with success message
            header("Location: admin_panel.php?delete_success=1");
            exit;
        } else {
            // Redirect with error if there was a problem deleting the student
            header("Location: admin_panel.php?delete_error=1");
            exit;
        }
    } else {
        // Redirect back if no student ID is provided
        header("Location: admin_panel.php?delete_error=1");
        exit;
    }

    // Close the database connection
    mysqli_close($conn);
?>
