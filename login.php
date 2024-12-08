<?php
session_start(); // Старт сесії

// Якщо користувач уже увійшов, перенаправляємо його на admin.php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: admin.php');
    exit;
}

// Логін і пароль адміністратора (захардкоджені, але краще зберігати в базі даних або .env)
$admin_username = 'admin';
$admin_password = 'password123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Перевірка логіна та пароля
    if ($username === $admin_username && $password === $admin_password) {
        // Зберігаємо в сесії, що користувач авторизований
        $_SESSION['logged_in'] = true;
        header('Location: admin.php'); // Перенаправлення на admin.php
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
