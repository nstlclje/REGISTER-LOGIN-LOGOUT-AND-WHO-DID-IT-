<?php
include('../includes/db.php');
session_start();

// LOGIN
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM Teachers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $teacher = $result->fetch_assoc();
        if (password_verify($password, $teacher['password'])) {
            $_SESSION['teacher_id'] = $teacher['teacher_id'];
            $_SESSION['teacher_name'] = $teacher['teacher_name'];
            header('Location: manage_quiz.php');
            exit();
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "Teacher not found!";
    }
}

if (isset($_GET['register']) && $_GET['register'] == 'true') {
    $register_form = true;
} else {
    $register_form = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $teacher_name = $_POST['teacher_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $date_of_registration = date('Y-m-d');
    
    
    $sql = "SELECT * FROM Teachers WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error_message = "Email is already registered!";
    } else {
        
        $sql = "INSERT INTO Teachers (teacher_name, email, password, date_of_registration) 
                VALUES ('$teacher_name', '$email', '$password', '$date_of_registration')";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Registered successfully! Please log in.";
            $register_form = false;
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<?php include('../includes/header.php'); ?>

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

<div class="container">

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if (!$register_form): ?>
        <h1>Teacher Login</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        
        <p>Don't have an account? <a href="login.php?register=true">Register here</a></p>
    <?php else: ?>
        
        <h1>Teacher Registration</h1>
        <form method="POST">
            <input type="text" name="teacher_name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register">Register</button>
        </form>
        
        <p>Already have an account? <a href="login.php">Login here</a></p>
    <?php endif; ?>
</div>

