<?php
session_start();

// Перевірка, чи дані передані методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $game = htmlspecialchars($_POST['game']);
    $group = htmlspecialchars($_POST['group']);
    $time = htmlspecialchars($_POST['time']);
    $film = htmlspecialchars($_POST['film']);

    $data = [
        'name' => $name,
        'email' => $email,
        'group' => $group,
        'game' => $game,
        'time' => $time,
        'film' => $film,
    ];

    // Збереження в базу даних
    $conn = new mysqli('localhost', 'root', '', 'survey_db'); // Замінити на ваші дані доступу
    mysqli_set_charset($conn, 'utf8mb4');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO responses (name, email, game, `group`, time, film) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $game, $group, $time, $film);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Відповідь користувачу
    echo "Дякуємо за участь в опитуванні! Ваші відповіді збережено.";
} else {
    echo "Помилка: відсутні дані.";
}
?>
