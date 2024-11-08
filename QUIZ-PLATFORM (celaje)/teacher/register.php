<?php
include('../includes/db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_name = $_POST['teacher_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $date_of_registration = date('Y-m-d');
    
    $sql = "INSERT INTO Teachers (teacher_name, email, password, date_of_registration) 
            VALUES ('$teacher_name', '$email', '$password', '$date_of_registration')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #007BFF, #6610f2); 
        font-family: Arial, sans-serif;
        color: #fff;
    }

    .container {
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
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
        background-color: rgba(255, 255, 255, 0.2);
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
        background-color: #007BFF;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    button:hover {
        background-color: #0056b3;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Teacher Registration</h1>
        <form method="POST">
            <input type="text" name="teacher_name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
