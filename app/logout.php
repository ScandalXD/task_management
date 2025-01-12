<?php
session_start();

// Завершення сесії
session_unset(); // Очищує всі змінні сесії
session_destroy(); // Знищує сесію

// Переадресація на сторінку логіна
header('Location: /task_management/app/login.php');
exit;
?>