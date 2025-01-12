<?php
require __DIR__ . '/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
    $stmt->execute([$title, $description, $status, $id]);

    header('Location: /task_management/app/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/task_management/app/style.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form method="POST">
        <label>Title</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required><br><br>
        <label>Description</label><br>
        <textarea name="description" required><?= htmlspecialchars($task['description']) ?></textarea><br><br>
        <label>Status</label><br>
        <select name="status">
            <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
        </select><br><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="/task_management/app/index.php">Back</a>
</body>
</html>