<?php
session_start();
require 'db.php';

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id']; // Отримання ID користувача з сесії

    // Додавання завдання
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $user_id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>
    <h1>Add New Task</h1>
    <form method="POST">
        <label>Title</label><br>
        <input type="text" name="title" required><br><br>
        <label>Description</label><br>
        <textarea name="description" required></textarea><br><br>
        <button type="submit">Add Task</button>
    </form>
    <a href="index.php">Back</a>
</body>
</html>
