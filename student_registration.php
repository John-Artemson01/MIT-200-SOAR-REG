<?php
    // Include the database connection file
    include 'db_conn.php';

    // Initialize a variable to track the registration status
    $registration_status = "";

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capture form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name']; // Added last name
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

        // Insert data into students table
        $insert_student_query = "INSERT INTO students (status) VALUES ('Registered')";
        if (mysqli_query($conn, $insert_student_query)) {
            $student_id = mysqli_insert_id($conn); // Get the last inserted student_id
            
            // Insert data into personal_information table
            $insert_personal_info_query = "INSERT INTO personal_information 
            (student_id, first_name, last_name, middle_name, suffix, gender, birthday, age, birthplace) 
            VALUES ('$student_id', '$first_name', '$last_name', '$middle_name', '$suffix', '$gender', '$birthday', '$age', '$birthplace')";
            mysqli_query($conn, $insert_personal_info_query);
            
            // Insert data into contact_information table
            $insert_contact_info_query = "INSERT INTO contact_information 
            (student_id, mobile_number, telephone, email) 
            VALUES ('$student_id', '$mobile_number', '$telephone', '$email')";
            mysqli_query($conn, $insert_contact_info_query);
            
            // Insert data into educational_information table
            $insert_educational_info_query = "INSERT INTO educational_information 
            (student_id, academic_level, year_level, period, academic_year, course) 
            VALUES ('$student_id', '$academic_level', '$year_level', '$period', '$academic_year', '$course')";
            mysqli_query($conn, $insert_educational_info_query);
            
            // Insert data into family_information table
            $insert_family_info_query = "INSERT INTO family_information 
            (student_id, mother_name, father_name, mother_contact_number, father_contact_number, mother_occupation, father_occupation) 
            VALUES ('$student_id', '$mother_name', '$father_name', '$mother_contact', '$father_contact', '$mother_occupation', '$father_occupation')";
            mysqli_query($conn, $insert_family_info_query);
            
            $registration_status = "Registration successful!";
        } else {
            $registration_status = "Error: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4169e1;
            font-size: 1.5em;
            font-weight: bold;
        }
        label {
            font-weight: bold;
            font-size: 0.9em;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"], input[type="email"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.1);
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
            margin-top: 20px;
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
        .alert {
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Student Registration</h2>
        
        <!-- Display Registration Status -->
        <?php if ($registration_status): ?>
            <div class="alert alert-info"><?= $registration_status ?></div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <!-- Personal Information -->
            <h4>Personal Information</h4>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" class="form-control" name="middle_name">
            </div>
            <div class="form-group">
                <label for="suffix">Suffix:</label>
                <input type="text" class="form-control" name="suffix">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" class="form-control" name="birthday" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" name="age" required>
            </div>
            <div class="form-group">
                <label for="birthplace">Birthplace:</label>
                <input type="text" class="form-control" name="birthplace" required>
            </div>

            <!-- Contact Information -->
            <h4>Contact Information</h4>
            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" name="mobile_number" required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label>
                <input type="text" class="form-control" name="telephone">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <!-- Educational Information -->
            <h4>Educational Information</h4>
            <div class="form-group">
                <label for="academic_level">Academic Level:</label>
                <select class="form-control" name="academic_level" required>
                    <option value="Basic Education">Basic Education</option>
                    <option value="Tertiary">Tertiary</option>
                    <option value="Graduate School">Graduate School</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year_level">Year Level:</label>
                <input type="text" class="form-control" name="year_level" required>
            </div>
            <div class="form-group">
                <label for="period">Period:</label>
                <input type="text" class="form-control" name="period" required>
            </div>
            <div class="form-group">
                <label for="academic_year">Academic Year:</label>
                <input type="text" class="form-control" name="academic_year" required>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" class="form-control" name="course" required>
            </div>

            <!-- Family Information -->
            <h4>Family Information</h4>
            <div class="form-group">
                <label for="mother_name">Mother's Name:</label>
                <input type="text" class="form-control" name="mother_name" required>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name:</label>
                <input type="text" class="form-control" name="father_name" required>
            </div>
            <div class="form-group">
                <label for="mother_contact">Mother's Contact Number:</label>
                <input type="text" class="form-control" name="mother_contact" required>
            </div>
            <div class="form-group">
                <label for="father_contact">Father's Contact Number:</label>
                <input type="text" class="form-control" name="father_contact" required>
            </div>
            <div class="form-group">
                <label for="mother_occupation">Mother's Occupation:</label>
                <input type="text" class="form-control" name="mother_occupation">
            </div>
            <div class="form-group">
                <label for="father_occupation">Father's Occupation:</label>
                <input type="text" class="form-control" name="father_occupation">
            </div>

            <button type="submit" class="btn-submit">Register</button><br><br>
            <!-- Add Go Back Button -->
            <a href="index.php" class="btn-back">Go Back to Homepage</a>
        </form>
    </div>
</body>
</html>
