<!DOCTYPE html>
<?php
session_start();

// Handle logout request
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login1.php");
    exit();
}

// Get username from session or set to Guest
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier University</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            background: url('back (1).jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: rgba(0, 0, 0, 0.8);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

        .logo {
            font-size: 22px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
        }

        .welcome-text {
            display: none; /* Hidden on mobile, shown on larger screens */
        }

        .menu-btn {
            background: none;
            border: none;
            font-size: 28px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease;
            padding: 5px;
        }

        .menu-btn:hover {
            transform: scale(1.1);
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background: rgba(0, 0, 0, 0.95);
            height: 100vh;
            position: fixed;
            top: 0;
            left: -280px;
            transition: left 0.3s ease;
            padding-top: 80px;
            z-index: 999;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 25px;
            transition: background 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: block;
        }

        /* Overlay for when sidebar is open */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Main Content Styles */
        main {
            flex: 1;
            padding: 20px;
            margin-top: 20px;
        }

        .container-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .container {
            background-size: cover;
            background-position: center;
            padding: 30px 20px;
            border-radius: 15px;
            text-align: center;
            font-size: 22px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
            border-radius: 15px;
            transition: background 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.3);
        }

        .container:hover::before {
            background: rgba(0, 0, 0, 0.4);
        }

        .container span {
            position: relative;
            z-index: 2;
            color: #fff;
            font-weight: 600;
            padding: 10px;
            line-height: 1.4;
        }

        /* Department-specific backgrounds */
        .container:nth-child(1) {
            background-image: url('cse.jpeg');
        }

        .container:nth-child(2) {
            background-image: url('eee.jpg');
        }

        .container:nth-child(3) {
            background-image: url('macha.jpg');
        }

        .container:nth-child(4) {
            background-image: url('it.jpg');
        }

        /* Footer Styles */
        footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 20px 15px;
            margin-top: 40px;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.3);
        }

        footer ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        footer ul li a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        footer ul li a:hover {
            color: #ff6f61;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            header {
                padding: 20px 30px;
            }

            .logo {
                font-size: 24px;
            }

            .welcome-text {
                display: block;
                font-size: 18px;
                font-weight: 600;
                color: #ffcc00;
                margin: 0 20px;
            }

            .menu-btn {
                display: none;
            }

            .sidebar {
                width: 250px;
                left: 0;
                padding-top: 100px;
            }

            .overlay {
                display: none !important;
            }

            main {
                margin-left: 250px;
                padding: 30px;
                margin-top: 0;
            }

            .container {
                height: 300px;
                font-size: 24px;
            }
        }

        @media (min-width: 992px) {
            .container-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 18px;
            }

            .logo-img {
                height: 30px;
            }

            .container {
                height: 200px;
                font-size: 18px;
                padding: 20px 15px;
            }

            .container span {
                font-size: 20px;
            }

            .sidebar {
                width: 80%;
                left: -80%;
            }
        }

        a.logout-icon {
            font-size: 24px;
            text-decoration: none;
            color: white;
            margin-left: 15px;
        }
        a.logout-icon:hover {
            opacity: 0.7;
        }

    </style>
</head>
<body>
    <header>
        <button class="menu-btn" aria-label="Toggle menu">☰</button>
        <div class="logo-container">
            <img src="logo.png" alt="Premier University Logo" class="logo-img">
            <div class="logo">Premier University</div>
        </div>
        <div class="welcome-text">
            Welcome, <?php echo htmlspecialchars($username); ?>
            <?php if ($username !== "Guest"): ?>
                <a href="?logout=1" class="logout-icon" title="Logout">🔓</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="overlay"></div>

    <nav class="sidebar" id="sidebar">
        <ul>
            <li><a href="http://localhost/Assignment/homepage.php">Home</a></li>
            <li><a href="http://localhost/Assignment/assignment.php">CSE</a></li>
            <li><a href="#">EEE</a></li>
            <li><a href="#">Mechanical</a></li>
            <li><a href="#">IT</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="https://puc.ac.bd/">Contact</a></li>
            <?php if ($username !== "Guest"): ?>
                <li><a href="?logout=1">Logout</a></li>
            <?php else: ?>
                <li><a href="login1.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <div class="container-grid">
            <div class="container" onclick="window.location.href='http://localhost/Assignment/assignment.php'">
                <span>Computer Science and Engineering</span>
            </div>
            <div class="container" onclick="window.location.href='http://localhost/Assignment/assignmenteee.php'">
                <span>Electrical and Electronics Engineering</span>
            </div>
            <div class="container" onclick="window.location.href='http://localhost/Assignment/assignmentmec.php'">
                <span>Mechanical Engineering</span>
            </div>
            <div class="container" onclick="window.location.href='http://localhost/Assignment/assignmentit.php'">
                <span>Information Technology</span>
            </div>
        </div>
    </main>

    <footer>
        <ul>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Help Center</a></li>
            <li><a href="https://puc.ac.bd/">Contact Us</a></li>
        </ul>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.querySelector('.menu-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.overlay');

            // Toggle sidebar and overlay
            menuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : 'auto';
            });

            // Close sidebar when clicking on overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });

            // Close sidebar when clicking on a link (for mobile)
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }
                });
            });

            // Make container clicks work properly
            document.querySelectorAll('.container').forEach(container => {
                container.addEventListener('click', function() {
                    const link = this.getAttribute('onclick');
                    if (link) {
                        const url = link.match(/'([^']+)'/)[1];
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
</body>
</html>