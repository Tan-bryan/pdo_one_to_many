<?php
include '../core/dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Manufacturer_id'];
    $name = $_POST['Manufacturer_name'];
    $country = $_POST['country'];

    $stmt = $pdo->prepare('UPDATE car_manufacturers SET Manufacturer_name = ?, country = ? WHERE Manufacturer_id = ?');
    $stmt->execute([$name, $country, $id]);

    header('Location: ../index.php');
    exit;
}
?>
