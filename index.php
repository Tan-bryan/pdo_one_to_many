<?php
include 'core/dbConfig.php';

// Fetch all car manufacturers
$stmt = $pdo->query('SELECT * FROM car_manufacturers');
$manufacturers = $stmt->fetchAll();

// Fetch all car parts with associated manufacturer names
$stmt = $pdo->query('
    SELECT cp.car_id, cp.car_model, cp.price, cp.transmission_type, cm.Manufacturer_name
    FROM car_parts cp
    JOIN car_manufacturers cm ON cp.manufacturer_id = cm.Manufacturer_id
');
$parts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Inventory System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        form input, form select, form button {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            max-width: 400px;
            display: block;
        }
        form button {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        td form {
            display: inline-block;
        }
        td form button {
            padding: 5px;
            margin: 0;
        }
        .actions {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Car Inventory System</h1>

    <h2>Add Manufacturer</h2>
    <form action="sql/create_manufacturer.php" method="post">
        <input type="text" name="Manufacturer_name" placeholder="Manufacturer Name" required>
        <input type="text" name="country" placeholder="Country" required>
        <button type="submit">Add Manufacturer</button>
    </form>

    <h2>Add Car</h2>
    <form action="sql/create_part.php" method="post">
        <select name="manufacturer_id" required>
            <option value="">Select Manufacturer</option>
            <?php foreach ($manufacturers as $manufacturer): ?>
                <option value="<?= $manufacturer['Manufacturer_id'] ?>"><?= $manufacturer['Manufacturer_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="car_model" placeholder="Car Model" required>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="text" name="transmission_type" placeholder="Transmission Type" required>
        <button type="submit">Add Car Part</button>
    </form>

    <h2>All Manufacturers</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Country</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($manufacturers as $manufacturer): ?>
            <tr>
                <td><?= $manufacturer['Manufacturer_id'] ?></td>
                <td><?= $manufacturer['Manufacturer_name'] ?></td>
                <td><?= $manufacturer['country'] ?></td>
                <td><?= $manufacturer['date_added'] ?></td>
                <td class="actions">
                    <form action="sql/update_manufacturer.php" method="post" style="display:inline;">
                        <input type="hidden" name="Manufacturer_id" value="<?= $manufacturer['Manufacturer_id'] ?>">
                        <input type="text" name="Manufacturer_name" value="<?= $manufacturer['Manufacturer_name'] ?>" required>
                        <input type="text" name="country" value="<?= $manufacturer['country'] ?>" required>
                        <button type="submit">Update</button>
                    </form>
                    <form action="sql/delete_manufacturer.php" method="post" style="display:inline;">
                        <input type="hidden" name="Manufacturer_id" value="<?= $manufacturer['Manufacturer_id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>All Cars</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Car Model</th>
            <th>Manufacturer</th>
            <th>Price</th>
            <th>Transmission Type</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($parts as $part): ?>
            <tr>
                <td><?= $part['car_id'] ?></td>
                <td><?= $part['car_model'] ?></td>
                <td><?= $part['Manufacturer_name'] ?></td>
                <td><?= $part['price'] ?></td>
                <td><?= $part['transmission_type'] ?></td>
                <td class="actions">
                    <form action="sql/update_part.php" method="post" style="display:inline;">
                        <input type="hidden" name="car_id" value="<?= $part['car_id'] ?>">
                        <input type="text" name="car_model" value="<?= $part['car_model'] ?>" required>
                        <input type="number" name="price" value="<?= $part['price'] ?>" step="0.01" required>
                        <input type="text" name="transmission_type" value="<?= $part['transmission_type'] ?>" required>
                        <button type="submit">Update</button>
                    </form>
                    <form action="sql/delete_part.php" method="post" style="display:inline;">
                        <input type="hidden" name="car_id" value="<?= $part['car_id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
