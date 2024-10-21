<?php
// index.php
include_once "../config/db.php";

// Fetch the latest water quality data from the database
$sql = "SELECT * FROM water_quality ORDER BY created_at DESC LIMIT 10";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Quality Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Water Quality Dashboard</h1>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Sensor ID</th>
                <th>pH</th>
                <th>Turbidity (NTU)</th>
                <th>Residual Chlorine (mg/l)</th>
                <th>Conductivity (μS/cm)</th>
                <th>Temperature (°C)</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['sensor_id']); ?></td>
                    <td><?= htmlspecialchars($row['pH']); ?></td>
                    <td><?= htmlspecialchars($row['turbidity']); ?></td>
                    <td><?= htmlspecialchars($row['residual_chlorine']); ?></td>
                    <td><?= htmlspecialchars($row['conductivity']); ?></td>
                    <td><?= htmlspecialchars($row['temperature']); ?></td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Data is updated every time the page is refreshed.</p>

</body>
</html>
