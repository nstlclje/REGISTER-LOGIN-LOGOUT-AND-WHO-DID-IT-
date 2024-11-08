<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}


$quizzes_data = [
    1 => [
        'title' => 'Python Basics',
        'difficulty' => 'Easy',
        'questions' => [
            ['question' => 'What is the output of print(2 ** 3)?', 'options' => ['2', '3', '4', '8'], 'answer' => '8', 'is_code' => false],
            ['question' => 'What keyword is used to define a function in Python?', 'options' => ['function', 'def', 'fun', 'define'], 'answer' => 'def', 'is_code' => false],
            ['question' => 'Which of the following is a valid list in Python?', 'options' => ['[1, 2, 3]', '(1, 2, 3)', '{1, 2, 3}', '<1, 2, 3>'], 'answer' => '[1, 2, 3]', 'is_code' => false],
            ['question' => 'Write a Python function to return the square of a number.', 'options' => [], 'answer' => 'def square(x): return x * x', 'is_code' => true],
            ['question' => 'Write a Python code snippet to check if a number is even.', 'options' => [], 'answer' => 'def is_even(n): return n % 2 == 0', 'is_code' => true],
        ]
    ],
    2 => [
        'title' => 'PHP Basics',
        'difficulty' => 'Easy',
        'questions' => [
            ['question' => 'What is the correct way to start a session in PHP?', 'options' => ['session_start();', 'start_session();', 'Session::start();', 'session->start();'], 'answer' => 'session_start();', 'is_code' => false],
            ['question' => 'How do you declare a variable in PHP?', 'options' => ['var $myVar;', '$myVar;', 'variable myVar;', 'myVar = variable;'], 'answer' => '$myVar;', 'is_code' => false],
            ['question' => 'How do you comment in PHP?', 'options' => ['// This is a comment', '# This is a comment', '/* This is a comment */', 'All of the above'], 'answer' => 'All of the above', 'is_code' => false],
            ['question' => 'Write a code snippet to create an associative array in PHP.', 'options' => [], 'answer' => '$person = ["name" => "John", "age" => 30];', 'is_code' => true],
            ['question' => 'Write a code snippet to echo a string in PHP.', 'options' => [], 'answer' => 'echo "Hello, World!";', 'is_code' => true],
        ]
    ]
];

if (isset($_GET['quiz_id'])) {
    $quiz_id = (int)$_GET['quiz_id'];

    if (array_key_exists($quiz_id, $quizzes_data)) {
        $quiz = $quizzes_data[$quiz_id];
        $total_questions = count($quiz['questions']);
    } else {
        echo "Quiz not found. Please check the quiz ID.";
        exit();
    }
} else {
    echo "No quiz selected. Please select a quiz to take.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    header("Location: quiz_result.php?submitted=true");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz - <?php echo $quiz['title']; ?></title>
    <script>
        let timeLeft = 600; 
        function updateTime() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            document.getElementById('timer').innerHTML = minutes + "m " + seconds + "s";
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                document.getElementById('quizForm').submit(); 
            }
            timeLeft--;
        }
        let timerInterval = setInterval(updateTime, 1000); 
    </script>
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
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        p {
            color: #fff;
        }

        .question {
            margin-bottom: 20px;
            text-align: left;
        }

        .question h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        input[type="radio"], textarea {
            margin: 10px 0;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            outline: none;
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
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

        #timer {
            font-weight: bold;
            color: #ffdd57;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quiz: <?php echo $quiz['title']; ?></h1>
        <p>Time Left: <span id="timer">10m 00s</span></p>

        <form id="quizForm" method="POST" action="quiz_resultS.php">
            <?php
            
            foreach ($quiz['questions'] as $index => $question) {
                echo "<div class='question'>";
                echo "<h3>" . ($index + 1) . ". " . $question['question'] . "</h3>";

                if ($question['is_code'] == 0) {
                    
                    foreach ($question['options'] as $option) {
                        echo "<label><input type='radio' name='questions[" . $index . "]' value='$option'> $option</label><br>";
                    }
                } else {
                    
                    echo "<textarea name='questions[" . $index . "]' rows='4' placeholder='Enter your code here'></textarea><br>";
                }
                echo "</div>";
            }
            ?>
            <button type="submit">Submit Quiz</button>
        </form>
    </div>
</body>
</html>
