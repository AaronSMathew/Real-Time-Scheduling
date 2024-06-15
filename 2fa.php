<?php
session_start();

// Check if the user is a teacher
if ($_SESSION['user_type'] !== 'teacher') {
    header("Location: index.php");
    exit;
}

// Generate a unique code
$code = mt_rand(100000, 999999);
$_SESSION['2fa_code'] = $code;

// Get the teacher's email from the database
$conn = new mysqli('localhost', 'username', 'password', 'database_name');
$stmt = $conn->prepare('SELECT email FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$email = $user['email'];

// Send the code via email
$subject = "Two-Factor Authentication Code";
$message = "Your two-factor authentication code is: " . $code;
mail($email, $subject, $message);

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(45deg, #8e2de2, #4a00e0);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        p {
            color: rgba(255, 255, 255, 0.7);
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            outline: none;
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        input[type="text"]::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input[type="text"]:focus {
            background-color: rgba(255, 255, 255, 0.4);
        }

        button[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(45deg, #8e2de2, #4a00e0);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        button[type="submit"]:hover {
            background: linear-gradient(45deg, #4a00e0, #8e2de2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Two-Factor Authentication</h1>
        <p>A verification code has been sent to your email address.</p>
        <form method="post" action="verify_2fa.php">
            <input type="text" id="code" name="code" placeholder="Enter the code" required>
            <button type="submit">Verify</button>
        </form>
    </div>
</body>
</html>