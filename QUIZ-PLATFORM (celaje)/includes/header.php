<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e90ff, #ff6347);
            font-family: 'Arial', sans-serif;
            color: #fff;
        }

        .navbar {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 20px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .navbar a.home-btn {
            background: rgba(255, 255, 255, 0.2);
            color: #ffdd57;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: background 0.3s;
            margin-left: 15px;
        }

        .navbar a.home-btn:hover {
            background-color: #ff6347; 
            color: #fff;
        }

        .navbar a.home-btn:active {
            transform: translateY(1px);
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-btn a {
            color: #ffdd57;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            transition: background 0.3s;
        }

        .logout-btn a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="../index.php" class="home-btn">Home</a>
    </div>

    <?php if (isset($_SESSION['teacher_id']) || isset($_SESSION['student_id'])): ?>
        <div class="logout-btn">
            <a href="../logout.php">Logout</a>
        </div>
    <?php endif; ?>
</body>
</html>
