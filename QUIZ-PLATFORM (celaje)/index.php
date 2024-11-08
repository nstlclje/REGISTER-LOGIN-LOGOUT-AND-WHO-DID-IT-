<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e90ff, #ff6347);  
            color: #fff;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.2);  
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);  
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .choice-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .role-btn {
            padding: 12px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            background-color: #ff6347; 
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .role-btn:hover {
            background-color: #e53e30; 
            transform: translateY(-3px);
        }

        .role-btn:active {
            transform: translateY(1px);
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Quiz System</h1>
        <div class="choice-buttons">
            <a href="student/login.php"><button class="role-btn">Student</button></a>
            <a href="teacher/login.php"><button class="role-btn">Teacher</button></a>
        </div>
    </div>
</body>
</html>
