<?php
// Підключення до бази даних
$conn = new mysqli('localhost', 'root', '', 'survey_db');

$sql = "SELECT * FROM responses";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Встановлення заголовків для завантаження файлу
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=survey_responses.csv');

    // Відкриття "файлу" для виводу
    $output = fopen('php://output', 'w');

    // Запис заголовків у CSV
    fputcsv($output, ['ID', 'Name', 'Email', 'Group', 'Game', 'Time', 'Film', 'Submitted At']);

    // Запис даних у CSV
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
} else {
    echo "No data found to export.";
}

$conn->close();
?>
