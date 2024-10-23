<?php
include '../core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Manufacturer_name'];
    $country = $_POST['country'];

    $stmt = $pdo->prepare('INSERT INTO car_manufacturers (Manufacturer_name, country) VALUES (?, ?)');
    $stmt->execute([$name, $country]);

    header('Location: ../index.php');
    exit;
}
?>
