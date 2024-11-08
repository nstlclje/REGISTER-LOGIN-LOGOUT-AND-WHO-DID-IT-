<?php
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date_of_registration = date("Y-m-d");

    $query = "SELECT * FROM Students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $error_message = "Email already exists!";
    } else {
        
        $query = "INSERT INTO Students (student_name, email, password, date_of_registration)
                  VALUES ('$student_name', '$email', '$password', '$date_of_registration')";
        if (mysqli_query($conn, $query)) {
            $success_message = "Registered successfully! <a href='login.php'>Login</a>";
        } else {
            $error_message = "Error during registration!";
        }
    }
}
?>

<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e90ff, #ff6347);  
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .container {
            background: rgba(255, 255, 255, 0.2); 
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input {
            padding: 12px;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            outline: none;
            background-color: rgba(255, 255, 255, 0.3); 
            color: #fff;
        }

        input::placeholder {
            color: #ddd;
        }

        button {
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
            background-color: #ff6347; 
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background-color: #e53e30; 
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(1px);
        }

        .error {
            background-color: #ff4d4d;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            color: #fff;
        }

        .success {
            background-color: #28a745;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            color: #fff;
        }

        p {
            color: #fff;
        }

        a {
            color: #ffdd57;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration</h1>

        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <input type="text" name="student_name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
