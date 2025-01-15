<?php
include('connection.php');

if (isset($_GET['id'])) {
    $food_id = intval($_GET['id']); // Sanitize the ID parameter

    // Prepare and execute the delete query
    $delete_query = "DELETE FROM foods WHERE id = :id"; 
    $stmt = $pdo->prepare($delete_query);
    
    // Bind the parameter using bindValue
    $stmt->bindValue(':id', $food_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $message = "Food item deleted successfully!";
        $message_type = "success";
    } else {
        $message = "Failed to delete food item.";
        $message_type = "danger";
    }


    $stmt->closeCursor(); 
}

// Redirect back to the food list page
header("Location: view_foods.php?message=" . urlencode($message) . "&type=" . urlencode($message_type));
exit();
?>
