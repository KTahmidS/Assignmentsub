<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login1.php");
    exit();
}

$username = $_SESSION['username'];
$user_id = $username; // Using username as user_id

// Database connection
$conn = new mysqli("localhost", "root", "", "user");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all active assignments
$assignments = $conn->query("SELECT * FROM assignmentsit WHERE deadline >= CURDATE() ORDER BY deadline");

// Get user's submissions (assignment_id is now title)
$submissions = [];
$stmt = $conn->prepare("SELECT assignment_id, file_name FROM student_assignmentsit WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $submissions[$row['assignment_id']] = $row['file_name'];
}
$stmt->close();

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $assignmentTitle = $_POST['assignment_id']; // assignment_id is now title
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];

    // Validate file type
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if (in_array($fileType, $allowedTypes)) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filePath = $uploadDir . uniqid() . '_' . basename($fileName);

        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Save to database
            $stmt = $conn->prepare("INSERT INTO student_assignmentsit (user_id, assignment_id, file_name, file_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $user_id, $assignmentTitle, $fileName, $filePath);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('File uploaded successfully.'); window.location.reload();</script>";
        } else {
            echo "<script>alert('Failed to move uploaded file.');</script>";
        }
    } else {
        echo "<script>alert('Only PDF and DOC files are allowed.');</script>";
    }
}

// Handle file removal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_file'])) {
    $assignmentTitle = $_POST['assignment_id'];

    // Get file path
    $stmt = $conn->prepare("SELECT file_path FROM student_assignmentsit WHERE user_id = ? AND assignment_id = ?");
    $stmt->bind_param("ss", $user_id, $assignmentTitle);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $filePath = $row['file_path'];
    $stmt->close();

    // Delete file
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete record
    $stmt = $conn->prepare("DELETE FROM student_assignmentseee WHERE user_id = ? AND assignment_id = ?");
    $stmt->bind_param("ss", $user_id, $assignmentTitle);
    $stmt->execute();
    $stmt->close();

    echo "<script>window.location.reload();</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment Upload</title>
    <!-- Include styles here as you already had them -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('upload.jpg') no-repeat center center fixed;
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #fff;
        }

        .username {
            font-size: 18px;
            font-weight: 400;
            color: #fff;
        }

        /* Main Content Styles */
        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .assignment-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .assignment-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: background 0.3s ease;
        }

        .assignment-card:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .assignment-card h3 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .assignment-card p {
            margin: 0 0 15px;
            font-size: 14px;
            color: #ccc;
        }

        .assignment-card .deadline {
            font-weight: 600;
            color: #ff6f61;
        }

        .assignment-card .file-upload {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .assignment-card .file-upload input[type="file"] {
            display: none;
        }

        .assignment-card .file-upload label {
            background: #ff6f61;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }

        .assignment-card .file-upload label:hover {
            background: #e65a50;
        }

        .assignment-card .file-upload .file-name {
            font-size: 14px;
            color: #ccc;
            word-break: break-all;
        }

        .assignment-card .file-upload .remove-btn {
            background: #2a5298;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
            flex-shrink: 0;
        }

        .assignment-card .file-upload .remove-btn:hover {
            background: #1e3c72;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }

            .logo {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .username {
                font-size: 16px;
            }

            main {
                padding: 15px;
            }

            .assignment-card {
                padding: 15px;
            }

            .assignment-card h3 {
                font-size: 18px;
            }

            .assignment-card .file-upload {
                flex-direction: row;
                align-items: center;
                gap: 8px;
            }

            .assignment-card .file-upload label,
            .assignment-card .file-upload .remove-btn {
                padding: 6px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .assignment-card .file-upload {
                flex-direction: column;
                align-items: flex-start;
            }

            .assignment-card .file-upload .file-name {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Assignment Upload</div>
        <div class="username">Welcome, <?php echo htmlspecialchars($username); ?></div>
    </header>

    <main>
        <div class="assignment-container">
            <?php while ($assignment = $assignments->fetch_assoc()): 
                $title = $assignment['title'];
            ?>
            <div class="assignment-card">
                <h3><?php echo htmlspecialchars($title); ?></h3>
                <p><?php echo htmlspecialchars($assignment['description']); ?></p>
                <p class="deadline">Deadline: <?php echo htmlspecialchars($assignment['deadline']); ?></p>
                
                <!-- File Upload Form -->
                <form method="POST" enctype="multipart/form-data" class="file-upload">
                    <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($title); ?>">
                    <input type="file" id="file<?php echo md5($title); ?>" name="file" 
                           onchange="this.form.submit()" <?php echo isset($submissions[$title]) ? 'disabled' : ''; ?>>
                    <label for="file<?php echo md5($title); ?>">
                        <?php echo isset($submissions[$title]) ? 'File Uploaded' : 'Upload File'; ?>
                    </label>
                    <span class="file-name">
                        <?php echo isset($submissions[$title]) ? $submissions[$title] : ''; ?>
                    </span>
                </form>
                
                <!-- File Removal Form -->
                <?php if (isset($submissions[$title])): ?>
                    <form method="POST" class="file-upload">
                        <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($title); ?>">
                        <button type="submit" name="remove_file" class="remove-btn">Remove</button>
                    </form>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>
<?php $conn->close(); ?>
