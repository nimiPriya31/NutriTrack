<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $food_id = $_POST['food_id'];
    $quantity = $_POST['quantity'];
    $intake_date = date('Y-m-d'); // Current date
    $day_name = date('l', strtotime($intake_date)); // Day name (e.g., Monday, Tuesday)

    // Insert data into food_intake table
    $query = "INSERT INTO food_intake (user_id, food_id, quantity, intake_date, day_name) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisss", $user_id, $food_id, $quantity, $intake_date, $day_name);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Intake saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save intake']);
    }
    $stmt->close();
}
?>
