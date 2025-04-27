<?php
// This must be the VERY FIRST LINE in the file
session_start();

$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "user";

// Database connection
$conn = mysqli_connect($server_name, $username, $password, $database_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle login form submission
if (isset($_POST['login'])) {
    $n = $_POST['username'];
    $m = $_POST['password'];
    $department = $_POST['department'];
    
    $sql_query = "SELECT * FROM admin2 WHERE username='$n' AND department='$department'";
    $result = mysqli_query($conn, $sql_query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($m, $row['password'])) {
            $_SESSION['username'] = $n;
            $_SESSION['department'] = $department;
            
            // Redirect based on department
            switch($department) {
                case 'CSE':
                    header("Location: admin.php");
                    break;
                case 'EEE':
                    header("Location: admineee.php");
                    break;
                case 'IT':
                    header("Location: adminit.php");
                    break;
                case 'Mechanical':
                    header("Location: adminmec.php");
                    break;
                default:
                    header("Location: login2.php");
            }
            exit();
        } else {
            $login_error = "Invalid password!";
        }
    } else {
        $login_error = "Username not found in selected department!";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
       body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center/cover;
            color: white;
        }

        /* Navigation Bar */
        nav {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: rgba(0, 0, 0, 0.6);
        }

        nav ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        /* Main Container */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            gap: 50px;
            padding: 20px; /* Added padding for smaller screens */
            flex-wrap: wrap; /* Allow wrapping for smaller screens */
        }

        /* Welcome Section */
        .welcome {
            max-width: 600px;
            color: black;
            background: rgba(200, 200, 200, 0.4);
            padding: 40px;
            border-radius: 12px;
            text-align: center; /* Center text for smaller screens */
        }

        .welcome h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .welcome h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .social-icons a {
            color: white;
            margin-right: 10px;
            text-decoration: none;
        }

        /* Login Form */
        .login-form {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .login-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        input {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        button {
            background: red;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        button:hover {
            background: darkred;
        }

        .options {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 10px;
        }

        .options a {
            color: white;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack items vertically on smaller screens */
                gap: 20px;
                height: auto;
                padding: 20px;
            }

            .welcome {
                max-width: 100%; /* Full width for smaller screens */
                padding: 20px;
            }

            .welcome h1 {
                font-size: 2rem;
            }

            .welcome h2 {
                font-size: 1.2rem;
            }

            .login-form {
                width: 100%; /* Full width for smaller screens */
                padding: 20px;
            }

            .login-form h2 {
                font-size: 20px;
            }

            input {
                padding: 10px;
                font-size: 14px;
            }

            button {
                padding: 10px;
                font-size: 14px;
            }

            .options {
                flex-direction: column; /* Stack options vertically */
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            nav ul {
                flex-direction: column; /* Stack navigation items vertically */
                align-items: center;
            }

            nav ul li {
                margin: 10px 0;
            }

            .welcome h1 {
                font-size: 1.8rem;
            }

            .welcome h2 {
                font-size: 1rem;
            }

            .login-form {
                padding: 15px;
            }

            .login-form h2 {
                font-size: 18px;
            }

            input {
                padding: 8px;
                font-size: 12px;
            }

            button {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <section class="container">
        <div class="welcome">
            <h1>Welcome!</h1>
            <h2>Student Assignment Submission Portal</h2>
            <h1>Premier University Chittagong</h1>
            <div class="social-icons">
                <a href="https://puc.ac.bd/">Website</a>
                <a href="https://www.facebook.com/PremierUniversityChittagong/">Facebook</a>
                <a href="#">Linkedln</a>
            </div>
        </div>
    
    <div class="login-form">
        <h2>Sign In</h2>
        <?php if (isset($login_error)): ?>
            <div style="color: red; text-align: center; margin-bottom: 15px;">
                <?php echo htmlspecialchars($login_error); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="login2.php">  <!-- Changed to login1.php -->
            <input type="text" placeholder="Student ID" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <select name="department" required>
                <option value="">Select Department</option>
                <option value="CSE">Computer Science & Engineering</option>
                <option value="EEE">Electrical & Electronics Engineering</option>
                <option value="IT">Information Technology</option>
                <option value="Mechanical">Mechanical Engineering</option>
            </select>
            <button type="submit" name="login">Sign In</button>
            <div class="options">
                <a href="login1.php">Login as Student</a>
            </div>
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
        </form>
    </div>
    
    </section>
</body>
</html>