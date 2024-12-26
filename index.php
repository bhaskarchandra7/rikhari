<?php
include 'db_tasks.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name']; // Retrieve user's name from session

// Add Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $stmt = $taskDb->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    $stmt->execute([$user_id, $task]);
}

// Delete Task
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $stmt = $taskDb->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->execute([$task_id, $user_id]);
}

// Fetch Tasks
$stmt = $taskDb->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Task Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        
        <!-- Logout Link -->
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

        <!-- Task Form -->
        <form method="POST">
            <input type="text" name="task" placeholder="New Task" required>
            <button type="submit">Add Task</button>
        </form>

        <!-- Task List -->
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li>
                    <?php echo htmlspecialchars($task['task']); ?>
                    <a href="?delete=<?php echo $task['id']; ?>">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
