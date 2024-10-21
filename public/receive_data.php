<?php
// receive_data.php
include_once "../config/db.php";

// Retrieve the JSON data sent from the IoT device
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $sensor_id = $data['sensor_id'];
    $pH = $data['pH'];
    $turbidity = $data['turbidity'];
    $residual_chlorine = $data['residual_chlorine'];
    $conductivity = $data['conductivity'];
    $temperature = $data['temperature'];

    // Insert the received data into the database
    $sql = "INSERT INTO water_quality (sensor_id, pH, turbidity, residual_chlorine, conductivity, temperature) 
            VALUES (:sensor_id, :pH, :turbidity, :residual_chlorine, :conductivity, :temperature)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':sensor_id', $sensor_id);
    $stmt->bindParam(':pH', $pH);
    $stmt->bindParam(':turbidity', $turbidity);
    $stmt->bindParam(':residual_chlorine', $residual_chlorine);
    $stmt->bindParam(':conductivity', $conductivity);
    $stmt->bindParam(':temperature', $temperature);

    if ($stmt->execute()) {
        echo "Data successfully received and saved.";
    } else {
        echo "Failed to save data.";
    }
} else {
    echo "No data received.";
}
?>
