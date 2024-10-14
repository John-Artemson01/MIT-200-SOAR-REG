<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            margin-bottom: 30px;
        }
        .btn {
            background-color: #4169e1;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #365ab9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Student Registration System</h1>
        <a href="student_registration.php" class="btn">Student Registration</a>
        <a href="admin_panel.php" class="btn">Admin Panel</a>
    </div>
</body>
</html>
