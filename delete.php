<?php
// Підключення до бази даних
$conn = new mysqli('localhost', 'root', '', 'survey_db');

// SQL-запит для очищення таблиці
$sql = "TRUNCATE TABLE responses";
if ($conn->query($sql) === TRUE) {
    echo "All responses have been deleted successfully.";
} else {
    echo "Error deleting data: " . $conn->error;
}

$conn->close();
?>
