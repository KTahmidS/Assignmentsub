<?php
// Start session at the very beginning
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username'])) {
    header("Location: login2.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "user");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new assignment
    if (isset($_POST['add_assignment'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        
        $stmt = $conn->prepare("INSERT INTO assignmentseee (title, description, deadline) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $deadline);
        $stmt->execute();
        $stmt->close();
    }
    
    // Delete assignment
    if (isset($_POST['delete_assignment'])) {
        $id = $_POST['assignment_id'];
        
        // First delete all student submissions for this assignment
        $stmt = $conn->prepare("DELETE FROM student_assignmentseee WHERE assignment_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        
        // Then delete the assignment itself
        $stmt = $conn->prepare("DELETE FROM student_assignmentseee WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Get all assignments
$assignments = $conn->query("SELECT * FROM assignmentseee ORDER BY deadline");

// Get all submissions
$submissions = $conn->query("
    SELECT 
        sa.user_id,
        sa.assignment_id,
        sa.file_name,
        sa.file_path,
        sa.submitted_at,
        u.username,
        a.title AS assignment_title
    FROM student_assignmentseee sa
    LEFT JOIN users u ON sa.user_id = u.username  /* Changed to match username as user_id */
    LEFT JOIN assignmentseee a ON sa.assignment_id = a.id
    ORDER BY sa.submitted_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: #333;
        }
        
        header {
            background: #2a5298;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        .section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        h2 {
            margin-top: 0;
            color: #2a5298;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #f5f5f5;
        }
        
        tr:hover {
            background: #f9f9f9;
        }
        
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-danger {
            background: #e74c3c;
        }
        
        .btn-primary {
            background: #3498db;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
        }
        
        textarea {
            min-height: 100px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <div>
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="login2.php" class="btn btn-danger" style="margin-left: 15px;">Logout</a>
        </div>
    </header>
    
    <div class="container">
        <!-- Add Assignment Form -->
        <div class="section">
            <h2>Add New Assignment</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" id="deadline" name="deadline" required>
                </div>
                <button type="submit" name="add_assignment" class="btn btn-primary">Add Assignment</button>
            </form>
        </div>
        
        <!-- Current Assignments -->
        <div class="section">
            <h2>Current Assignments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($assignment = $assignments->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['description']); ?></td>
                        <td><?php echo htmlspecialchars($assignment['deadline']); ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']; ?>">
                                <button type="submit" name="delete_assignment" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Student Submissions -->
        <div class="section">
            <h2>Student Submissions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Assignment</th>
                        <th>File</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($submission = $submissions->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($submission['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($submission['assignment_id']); ?></td>
                        <td>
                            <a href="<?php echo htmlspecialchars($submission['file_path']); ?>" download>
                                <?php echo htmlspecialchars($submission['file_name']); ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($submission['submitted_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>