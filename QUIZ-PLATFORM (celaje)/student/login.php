<?php
session_start();
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM Students WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['student_id'] = $row['student_id'];
        $_SESSION['student_name'] = $row['student_name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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

        h2 {
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
        <h2>Student Login</h2>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <?php if (isset($error_message)) { echo "<div class='error'>$error_message</div>"; } ?>
    </div>
</body>
</html>
