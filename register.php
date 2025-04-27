<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Signup</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center/cover;
            color: white;
            min-height: 100vh;
        }
        
        header {
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: rgba(0, 0, 0, 0.6);
            flex-wrap: wrap;
        }
        
        .logo {
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            padding: 0;
            margin: 0;
            transition: all 0.3s ease;
        }
        
        nav ul li {
            margin: 0 15px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #ff4444;
        }
        
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 70px);
            gap: 30px;
            padding: 20px;
            flex-wrap: wrap;
            box-sizing: border-box;
        }
        
        .welcome {
            max-width: 600px;
            color: black;
            background: rgba(200, 200, 200, 0.4);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            backdrop-filter: blur(5px);
        }
        
        .login-form {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }
        
        .login-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: white;
        }
        
        input {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        button {
            background: #ff4444;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
            margin-top: 10px;
        }
        
        button:hover {
            background: #cc0000;
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: 15px;
            color: #aaa;
        }
        
        .options a {
            color: #ddd;
            text-decoration: none;
        }
        
        .options a:hover {
            text-decoration: underline;
        }
        
        .social-icons {
            margin-top: 20px;
        }
        
        .social-icons a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .social-icons a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media (max-width: 900px) {
            .container {
                gap: 20px;
            }
            
            .welcome, .login-form {
                padding: 25px;
            }
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            nav ul {
                display: none;
                width: 100%;
                flex-direction: column;
                padding-top: 10px;
            }
            
            nav ul.show {
                display: flex;
            }
            
            nav ul li {
                margin: 5px 0;
                text-align: center;
            }
            
            .container {
                flex-direction: column;
                gap: 20px;
                padding: 15px;
            }
            
            .welcome, .login-form {
                width: 100%;
                max-width: 500px;
            }
        }
        
        @media (max-width: 480px) {
            nav {
                padding: 10px 15px;
            }
            
            .welcome h1 {
                font-size: 24px;
            }
            
            .welcome h2 {
                font-size: 18px;
            }
            
            .login-form {
                padding: 20px 15px;
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
                flex-direction: column;
                gap: 8px;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Premier University</div>
            <div class="menu-toggle">☰</div>
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
                <a href="#">Website</a>
                <a href="#">Facebook</a>
                <a href="#">LinkedIn</a>
            </div>
        </div>
        <div class="login-form">
            <h2>Sign Up</h2>
            <form action="register.php" method="POST">
                <input type="text" placeholder="Student ID" id="new_username" name="new_username" required>
                <input type="password" placeholder="Password" id="new_password" name="new_password" required>
                <button type="submit" value="Submit" name="save">Sign Up</button>
            </form>
        </div>
    </section>

    <script>
        // Mobile menu toggle
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('nav ul').classList.toggle('show');
        });
        
        // Close menu when clicking on a link (for mobile)
        document.querySelectorAll('nav ul li a').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('nav ul').classList.remove('show');
            });
        });
    </script>
</body>
</html>

<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "user";

$conn = mysqli_connect($server_name, $username, $password, $database_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save'])) {
    $n = $_POST['new_username'];
    $m = $_POST['new_password'];
    $h_p = password_hash($m, PASSWORD_BCRYPT);
    $sql_query = "INSERT INTO admin(username, password) VALUES ('$n', '$h_p')";
    if (mysqli_query($conn, $sql_query)) {
        echo "<script>window.location.href='http://localhost/Assignment/login1.php';</script>";
    } else {
        echo "error";
    }
    mysqli_close($conn);
}
?>