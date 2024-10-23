<?php
include '../core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manufacturer_id = $_POST['manufacturer_id'];
    $car_model = $_POST['car_model'];
    $price = $_POST['price'];
    $transmission_type = $_POST['transmission_type'];

    $stmt = $pdo->prepare('INSERT INTO car_parts (car_model, manufacturer_id, price, transmission_type) VALUES (?, ?, ?, ?)');
    $stmt->execute([$car_model, $manufacturer_id, $price, $transmission_type]);

    header('Location: ../index.php');
    exit;
}
?>
