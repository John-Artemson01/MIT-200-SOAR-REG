<?php
// Include the database connection file
include 'db_conn.php';

// Check if a student ID is provided for editing
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch student information from the database
    $student_query = "SELECT * FROM students 
        INNER JOIN personal_information ON students.student_id = personal_information.student_id
        INNER JOIN contact_information ON students.student_id = contact_information.student_id
        INNER JOIN educational_information ON students.student_id = educational_information.student_id
        INNER JOIN family_information ON students.student_id = family_information.student_id
        WHERE students.student_id = '$student_id'";
    $result = mysqli_query($conn, $student_query);

    if (mysqli_num_rows($result) > 0) {
        $student_data = mysqli_fetch_assoc($result);
    } else {
        echo "Student not found.";
        exit;
    }
} else {
    echo "No student ID provided.";
    exit;
}

// Check if the form has been submitted to update the student's data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];

    $mobile_number = $_POST['mobile_number'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    $academic_level = $_POST['academic_level'];
    $year_level = $_POST['year_level'];
    $period = $_POST['period'];
    $academic_year = $_POST['academic_year'];
    $course = $_POST['course'];

    $mother_name = $_POST['mother_name'];
    $father_name = $_POST['father_name'];
    $mother_contact = $_POST['mother_contact'];
    $father_contact = $_POST['father_contact'];
    $mother_occupation = $_POST['mother_occupation'];
    $father_occupation = $_POST['father_occupation'];

    // Update the personal information table
    $update_personal_info_query = "UPDATE personal_information SET 
        first_name='$first_name', last_name='$last_name', middle_name='$middle_name', suffix='$suffix', 
        gender='$gender', birthday='$birthday', age='$age', birthplace='$birthplace'
        WHERE student_id='$student_id'";
    mysqli_query($conn, $update_personal_info_query);

    // Update the contact information table
    $update_contact_info_query = "UPDATE contact_information SET 
        mobile_number='$mobile_number', telephone='$telephone', email='$email'
        WHERE student_id='$student_id'";
    mysqli_query($conn, $update_contact_info_query);

    // Update the educational information table
    $update_educational_info_query = "UPDATE educational_information SET 
        academic_level='$academic_level', year_level='$year_level', period='$period', academic_year='$academic_year', course='$course'
        WHERE student_id='$student_id'";
    mysqli_query($conn, $update_educational_info_query);

    // Update the family information table
    $update_family_info_query = "UPDATE family_information SET 
        mother_name='$mother_name', father_name='$father_name', mother_contact_number='$mother_contact', father_contact_number='$father_contact', 
        mother_occupation='$mother_occupation', father_occupation='$father_occupation'
        WHERE student_id='$student_id'";
    mysqli_query($conn, $update_family_info_query);

    // Redirect to view the updated data
    header("Location: view_edit.php?student_id=$student_id&success=1");
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View/Edit Student</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"], input[type="email"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-submit, .btn-back {
            display: block;
            width: 100%;
            background-color: #4169e1;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover, .btn-back:hover {
            background-color: #365ab9;
        }
        .btn-back {
            background-color: #6c757d;
            margin-top: 10px;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>View/Edit Student Information</h2>

        <!-- Display success message if update was successful -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">Student information updated successfully!</div>
        <?php endif; ?>

        <form action="" method="POST">
            <!-- Personal Information -->
            <h4>Personal Information</h4>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" name="first_name" value="<?= $student_data['first_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" name="last_name" value="<?= $student_data['last_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" class="form-control" name="middle_name" value="<?= $student_data['middle_name'] ?>">
            </div>
            <div class="form-group">
                <label for="suffix">Suffix:</label>
                <input type="text" class="form-control" name="suffix" value="<?= $student_data['suffix'] ?>">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" required>
                    <option value="Male" <?= ($student_data['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($student_data['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= ($student_data['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" class="form-control" name="birthday" value="<?= $student_data['birthday'] ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" name="age" value="<?= $student_data['age'] ?>" required>
            </div>
            <div class="form-group">
                <label for="birthplace">Birthplace:</label>
                <input type="text" class="form-control" name="birthplace" value="<?= $student_data['birthplace'] ?>" required>
            </div>

            <!-- Contact Information -->
            <h4>Contact Information</h4>
            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" name="mobile_number" value="<?= $student_data['mobile_number'] ?>" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input type="text" class="form-control" name="telephone" value="<?= $student_data['telephone'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= $student_data['email'] ?>" required>
            </div>

            <!-- Educational Information -->
            <h4>Educational Information</h4>
            <div class="form-group">
                <label for="academic_level">Academic Level:</label>
                <select class="form-control" name="academic_level" required>
                    <option value="Basic Education" <?= ($student_data['academic_level'] == 'Basic Education') ? 'selected' : '' ?>>Basic Education</option>
                    <option value="Tertiary" <?= ($student_data['academic_level'] == 'Tertiary') ? 'selected' : '' ?>>Tertiary</option>
                    <option value="Graduate School" <?= ($student_data['academic_level'] == 'Graduate School') ? 'selected' : '' ?>>Graduate School</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year_level">Year Level:</label>
                <input type="text" class="form-control" name="year_level" value="<?= $student_data['year_level'] ?>" required>
            </div>
            <div class="form-group">
                <label for="period">Period:</label>
                <input type="text" class="form-control" name="period" value="<?= $student_data['period'] ?>" required>
            </div>
            <div class="form-group">
                <label for="academic_year">Academic Year:</label>
                <input type="text" class="form-control" name="academic_year" value="<?= $student_data['academic_year'] ?>" required>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" class="form-control" name="course" value="<?= $student_data['course'] ?>" required>
            </div>

            <!-- Family Information -->
            <h4>Family Information</h4>
            <div class="form-group">
                <label for="mother_name">Mother's Name:</label>
                <input type="text" class="form-control" name="mother_name" value="<?= $student_data['mother_name'] ?>">
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name:</label>
                <input type="text" class="form-control" name="father_name" value="<?= $student_data['father_name'] ?>">
            </div>
            <div class="form-group">
                <label for="mother_contact">Mother's Contact Number:</label>
                <input type="text" class="form-control" name="mother_contact" value="<?= $student_data['mother_contact_number'] ?>">
            </div>
            <div class="form-group">
                <label for="father_contact">Father's Contact Number:</label>
                <input type="text" class="form-control" name="father_contact" value="<?= $student_data['father_contact_number'] ?>">
            </div>
            <div class="form-group">
                <label for="mother_occupation">Mother's Occupation:</label>
                <input type="text" class="form-control" name="mother_occupation" value="<?= $student_data['mother_occupation'] ?>">
            </div>
            <div class="form-group">
                <label for="father_occupation">Father's Occupation:</label>
                <input type="text" class="form-control" name="father_occupation" value="<?= $student_data['father_occupation'] ?>">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">Update Student Information</button>
        </form>

        <!-- Back to Admin Panel Button -->
        <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
    </div>
</body>
</html>
