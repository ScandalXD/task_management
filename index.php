<?php
session_start();
require  'db.php';

// Перевірка авторизації
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Пошук і фільтрування
$statusFilter = $_GET['status'] ?? '';
$searchQuery = $_GET['search'] ?? '';

$query = "SELECT * FROM tasks WHERE user_id = :user_id";
$params = ['user_id' => $_SESSION['user_id']];

if ($statusFilter) {
    $query .= " AND status = :status";
    $params['status'] = $statusFilter;
}

if ($searchQuery) {
    $query .= " AND (title LIKE :search OR description LIKE :search)";
    $params['search'] = "%$searchQuery%";
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Навигация -->
    <div class="navbar">
        <div class="username">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></div>
        <div class="nav-buttons">
            <a href="update_profile.php" class="btn">Update Profile</a>
            <a href="logout.php" class="btn logout">Logout</a>
        </div>
    </div>

    <!-- Контент -->
    <h1>Task Management</h1>
    <a href="add_task.php">Add New Task</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= $task['id'] ?></td>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td>
                <a href="toggle_status.php?id=<?= $task['id'] ?>">
                    <?= $task['status'] === 'pending' ? 'Mark as Completed' : 'Mark as Pending' ?>
                </a>
            </td>
            <td>
                <a href="edit_task.php?id=<?= $task['id'] ?>">Edit</a>
                <a href="delete_task.php?id=<?= $task['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
