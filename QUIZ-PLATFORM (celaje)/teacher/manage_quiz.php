<?php
include('../includes/db.php');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php');
    exit();
}

$teacher_id = $_SESSION['teacher_id'];

$sql = "SELECT * FROM Quizzes";
$quizzes = $conn->query($sql);

// INSERTION
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_quiz'])) {
    $quiz_title = $_POST['quiz_title'];
    $difficulty_level = $_POST['difficulty_level'];
    $number_of_questions = $_POST['number_of_questions'];
    $completion_time = $_POST['completion_time'];

    $sql = "INSERT INTO Quizzes (quiz_title, difficulty_level, number_of_questions, completion_time) 
            VALUES ('$quiz_title', '$difficulty_level', '$number_of_questions', '$completion_time')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: manage_quiz.php');
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// DELETION
if (isset($_GET['delete_quiz'])) {
    $quiz_id = $_GET['delete_quiz'];
    
    $sql = "DELETE FROM Quizzes WHERE quiz_id = '$quiz_id'";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: manage_quiz.php');
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// EDIT/UPDATE
if (isset($_POST['edit_quiz'])) {
    $quiz_id = $_POST['quiz_id'];
    $quiz_title = $_POST['quiz_title'];
    $difficulty_level = $_POST['difficulty_level'];
    $number_of_questions = $_POST['number_of_questions'];
    $completion_time = $_POST['completion_time'];

    $sql = "UPDATE Quizzes SET quiz_title = '$quiz_title', difficulty_level = '$difficulty_level', 
            number_of_questions = '$number_of_questions', completion_time = '$completion_time' 
            WHERE quiz_id = '$quiz_id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: manage_quiz.php');
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// LOGOUT
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<?php include('../includes/header.php'); ?>


<div style="background-color: #f4f4f9; padding: 40px; font-family: Arial, sans-serif;">
    <h1 style="text-align: center; color: #333;">Welcome, <?php echo $_SESSION['teacher_name']; ?></h1>

    
    <?php if (isset($error_message)): ?>
        <div style="color: red; font-weight: bold; text-align: center;"><?php echo $error_message; ?></div>
    <?php endif; ?>

    
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px;">
        <h2 style="color: #555; text-align: center;">Add a New Quiz</h2>
        <form method="POST">
            <table style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <td><input type="text" name="quiz_title" placeholder="Quiz Title" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                    <td><input type="text" name="difficulty_level" placeholder="Difficulty Level" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                </tr>
                <tr>
                    <td><input type="number" name="number_of_questions" placeholder="Number of Questions" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                    <td><input type="number" name="completion_time" placeholder="Completion Time (minutes)" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <button type="submit" name="add_quiz" style="padding: 12px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Add Quiz</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    
    <div style="max-width: 1000px; margin: 30px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px;">
        <h2 style="color: #555; text-align: center;">Table of Quizzes</h2>
        <table style="width: 100%; border-collapse: collapse; background-color: #ffffff;">
            <thead>
                <tr style="background-color: #4CAF50; color: white;">
                    <th style="padding: 12px;">Quiz Title</th>
                    <th style="padding: 12px;">Difficulty Level</th>
                    <th style="padding: 12px;">Number of Questions</th>
                    <th style="padding: 12px;">Completion Time (min)</th>
                    <th style="padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($quiz = $quizzes->fetch_assoc()): ?>
                    <tr style="text-align: center; background-color: #f9f9f9;">
                        <form method="POST">
                            <td><input type="text" name="quiz_title" value="<?php echo $quiz['quiz_title']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                            <td><input type="text" name="difficulty_level" value="<?php echo $quiz['difficulty_level']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                            <td><input type="number" name="number_of_questions" value="<?php echo $quiz['number_of_questions']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                            <td><input type="number" name="completion_time" value="<?php echo $quiz['completion_time']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;" required></td>
                            <td>
                                <input type="hidden" name="quiz_id" value="<?php echo $quiz['quiz_id']; ?>">
                                <button type="submit" name="edit_quiz" style="padding: 8px 15px; background-color: #2196F3; color: white; border: none; border-radius: 5px;">Update</button>
                                <a href="manage_quiz.php?delete_quiz=<?php echo $quiz['quiz_id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this quiz?');" 
                                   style="padding: 8px 15px; background-color: #f44336; color: white; border: none; border-radius: 5px; text-decoration: none;">Delete</a>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="manage_quiz.php?logout=true" style="padding: 12px 20px; background-color: #f44336; color: white; border: none; border-radius: 5px; text-decoration: none;">Logout</a>
    </div>
</div>

