<?php
session_start(); // Старт сесії

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php'); // Перенаправлення на сторінку логіна
    exit;
}
?>
<?php
// Підключення до бази даних
$conn = new mysqli('localhost', 'root', '', 'survey_db');
mysqli_set_charset($conn, 'utf8mb4');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Виконання SQL-запиту для отримання даних
$sql = "SELECT * FROM responses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<form action="export.php" method="post">
    <button type="submit">Export to CSV</button>
</form>
<form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete all responses?');">
    <button type="submit" style="background-color: red; color: white;">Delete All Responses</button>
</form>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Admin Panel - Survey Responses</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Group</th>
                <th>Game</th>
                <th>Time</th>
                <th>Film</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['group']); ?></td>
                        <td><?php echo htmlspecialchars($row['game']); ?></td>
                        <td><?php echo htmlspecialchars($row['time']); ?></td>
                        <td><?php echo htmlspecialchars($row['film']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No responses found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php $conn->close(); ?>
    
    <form action="logout.php" method="post">
    <button type="submit">Logout</button>
</form>
</body>
</html>
