<?php
include '../core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['car_id'];
    $car_model = $_POST['car_model'];
    $price = $_POST['price'];
    $transmission_type = $_POST['transmission_type'];

    $stmt = $pdo->prepare('UPDATE car_parts SET car_model = ?, price = ?, transmission_type = ? WHERE car_id = ?');
    $stmt->execute([$car_model, $price, $transmission_type, $id]);

    header('Location: ../index.php');
    exit;
}
?>
