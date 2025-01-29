<?php
session_start();
require  'db.php';

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Получение ID задачи
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$task_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

// Удаление задачи
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $task_id, 'user_id' => $user_id]);

// Переиндексация ID
$pdo->exec("SET @num := 0");
$pdo->exec("UPDATE tasks SET id = (@num := @num + 1) WHERE user_id = $user_id ORDER BY id");
$pdo->exec("ALTER TABLE tasks AUTO_INCREMENT = 1");

// Перенаправление на главную страницу
header('Location: index.php');
exit;
?>
