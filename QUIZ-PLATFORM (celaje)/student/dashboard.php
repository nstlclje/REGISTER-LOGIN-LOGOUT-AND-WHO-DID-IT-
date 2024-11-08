<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['student_name'];
$student_id = $_SESSION['student_id'];

$query = "SELECT * FROM Quizzes";
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(135deg, #1e90ff, #ff6347);
            font-family: 'Arial', sans-serif;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
        }

        h2, h3 {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .dashboard-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            color: #fff;
        }

        th {
            background-color: #1e90ff;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        a {
            color: #ffdd57;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            padding: 12px;
            margin-top: 20px;
            color: #fff;
            background-color: #ff6347;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .logout-btn:hover {
            background-color: #e53e30;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $student_name; ?>!</h2>
        <h3>Available Quizzes:</h3>
        <table border="0">
            <tr>
                <th>Quiz Title</th>
                <th>Difficulty Level</th>
                <th>Number of Questions</th>
                <th>Completion Time (mins)</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['quiz_title']; ?></td>
                    <td><?php echo $row['difficulty_level']; ?></td>
                    <td><?php echo $row['number_of_questions']; ?></td>
                    <td><?php echo $row['completion_time']; ?></td>
                    <td><a href="take_quiz.php?quiz_id=1">Take Quiz</a></td>
                    <td<a href="take_quiz.php?quiz_id=2"></a></td>
                    
                </tr>
            <?php } ?>
        </table>

        <button class="logout-btn"><a href="logout.php" style="color: inherit;">Logout</a></button>
    </div>
</body>
</html>
