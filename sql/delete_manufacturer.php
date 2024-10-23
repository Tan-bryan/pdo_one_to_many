<?php
include '../core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Manufacturer_id'];

    $stmt = $pdo->prepare('DELETE FROM car_manufacturers WHERE Manufacturer_id = ?');
    $stmt->execute([$id]);

    header('Location: ../index.php');
    exit;
}
?>
