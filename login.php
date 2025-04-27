<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('premier.jpg') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }

        .scroll-container {
            position: relative;
            width: 350px;
            height: 0;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: height 1.5s ease-out;
        }

        .scroll-paper {
            background: #f5deb3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            border: 10px solid #8B4513;
            border-radius: 20px;
            width: 100%;
            transform: scaleY(0);
            transition: transform 1.5s ease-out;
        }

        .scroll-container.open {
            height: 300px;
        }

        .scroll-container.open .scroll-paper {
            transform: scaleY(1);
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #8B4513;
            border-radius: 5px;
            background: #fffbe6;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #8B4513;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #5a2c00;
        }
    </style>
</head>
<body>
    <div class="scroll-container" id="scroll">
        <div class="scroll-paper">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="username">Student ID:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" value="Submit" name="login">Login</button>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {
            document.getElementById('scroll').classList.add('open');
        };
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

if (isset($_POST['login'])) {
    $n = $_POST['username'];
    $m = $_POST['password'];
    
    $sql_query = "SELECT * FROM admin WHERE username='$n'";
    $result = mysqli_query($conn, $sql_query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($m, $row['password'])) {
            header("location:http://localhost/Assignment/homepage.php");
            // Redirect or start a session here
        } else {
            echo "Wrong password";
        }
    } else {
        echo "User not found.";
    }
    
    mysqli_close($conn);
}
?>
