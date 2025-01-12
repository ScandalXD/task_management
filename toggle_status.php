<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

$newStatus = $task['status'] === 'pending' ? 'completed' : 'pending';
$stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
$stmt->execute([$newStatus, $id]);

header('Location: index.php');
exit;
?>