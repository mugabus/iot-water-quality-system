<?php
// process_data.php
include_once "../config/db.php";

// Check if the request method is POST (assuming the IoT devices are sending data via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Retrieve data from the request
    $sensor_id = isset($_POST['sensor_id']) ? $_POST['sensor_id'] : null;
    $pH = isset($_POST['pH']) ? $_POST['pH'] : null;
    $turbidity = isset($_POST['turbidity']) ? $_POST['turbidity'] : null;
    $residual_chlorine = isset($_POST['residual_chlorine']) ? $_POST['residual_chlorine'] : null;
    $conductivity = isset($_POST['conductivity']) ? $_POST['conductivity'] : null;
    $temperature = isset($_POST['temperature']) ? $_POST['temperature'] : null;

    // Validate required data
    if ($sensor_id && $pH && $turbidity && $residual_chlorine && $conductivity && $temperature) {
        
        // Prepare SQL insert query
        $sql = "INSERT INTO water_quality (sensor_id, pH, turbidity, residual_chlorine, conductivity, temperature, created_at) 
                VALUES (:sensor_id, :pH, :turbidity, :residual_chlorine, :conductivity, :temperature, NOW())";
        
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters to the statement
        $stmt->bindParam(':sensor_id', $sensor_id);
        $stmt->bindParam(':pH', $pH);
        $stmt->bindParam(':turbidity', $turbidity);
        $stmt->bindParam(':residual_chlorine', $residual_chlorine);
        $stmt->bindParam(':conductivity', $conductivity);
        $stmt->bindParam(':temperature', $temperature);

        // Execute the query
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
