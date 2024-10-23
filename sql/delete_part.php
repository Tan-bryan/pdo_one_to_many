<?php
include '../core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure you are using 'car_id' from the POST data
    $car_id = $_POST['car_id']; // Change 'id' to 'car_id'

    // Prepare the SQL statement
    $stmt = $pdo->prepare('DELETE FROM car_parts WHERE car_id = ?'); // Use 'car_id' in the SQL query
    $stmt->execute([$car_id]);

    // Redirect after deletion
    header('Location: ../index.php');
    exit; // It's a good practice to call exit after a redirect
}
?>