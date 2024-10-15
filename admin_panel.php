<?php
    // Include the database connection file
    include 'db_conn.php';

    // Fetch student data with JOINs for personal and educational information
    $sql = "SELECT 
                students.created_at AS registration_date,
                CONCAT(personal_information.last_name, ', ', personal_information.first_name, ' ', personal_information.middle_name) AS name,
                educational_information.academic_level,
                educational_information.year_level,
                educational_information.course,
                students.status,
                students.student_id
            FROM students
            JOIN personal_information ON students.student_id = personal_information.student_id
            JOIN educational_information ON students.student_id = educational_information.student_id
            ORDER BY students.created_at DESC";

    $result = mysqli_query($conn, $sql);

    if (isset($_GET['status_update_success'])) {
        echo '<div class="alert alert-success">Status updated successfully.</div>';
    } elseif (isset($_GET['status_update_error'])) {
        echo '<div class="alert alert-danger">Error updating status. Please try again.</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Student Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4169e1;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #4169e1;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table-bordered {
            border: 2px solid #4169e1;
        }
        .btn-submit {
            display: block;
            width: 100%;
            background-color: #4169e1;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .btn-submit:hover {
            background-color: #365ab9;
        }
        .btn-back {
            background-color: #4169e1; /* Blue background */
            color: white; /* White text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            padding: 10px 15px; /* Padding around the text */
            text-decoration: none; /* No underline */
            margin-bottom: 20px; /* Margin below the button */
            transition: background-color 0.3s, color 0.3s, border 0.3s; /* Smooth transition for hover effects */
        }

        .btn-back:hover {
            background-color: white; /* White background on hover */
            color: #4169e1; /* Blue text on hover */
            border: 2px solid #4169e1; /* Blue border on hover */
            text-decoration: none; /* Remove underline on hover */
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Panel - Student Registration</h2>

        <!-- Back to Dashboard Button -->
        <a href="index.php" class="btn-back">Back to Dashboard</a>
        <br><br>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Registration Date</th>
                    <th>Name</th>
                    <th>Academic Level</th>
                    <th>Year Level</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['registration_date']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['academic_level']; ?></td>
                            <td><?php echo $row['year_level']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td>
                                <form action="update_status.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                                    <select name="status" onchange="this.form.submit()" class="form-control">
                                        <option value="Registered" <?php echo ($row['status'] == 'Registered') ? 'selected' : ''; ?>>Registered</option>
                                        <option value="Admitted" <?php echo ($row['status'] == 'Admitted') ? 'selected' : ''; ?>>Admitted</option>
                                        <option value="Assessed" <?php echo ($row['status'] == 'Assessed') ? 'selected' : ''; ?>>Assessed</option>
                                        <option value="Enrolled" <?php echo ($row['status'] == 'Enrolled') ? 'selected' : ''; ?>>Enrolled</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="view_edit.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-info btn-sm">View / Edit</a>
                            </td>
                            <td>
                                <a href="delete.php?student_id=<?= $row['student_id']; ?>" class="btn btn-danger"  
                                    onclick="return confirm('Are you sure you want to delete this student?');">
                                    Delete
                                </a>                            
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
