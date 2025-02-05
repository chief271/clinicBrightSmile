<?php
session_start();
require 'init.php'; // Your database connection is included here

// Get the logged-in user's ID
$userId = $_SESSION['UserId']; // Assuming UserId is stored in the session

try {
    // Update the 'notified' column for all appointments of the user
    $sql = "UPDATE appointments 
            SET notified = 1 
            WHERE user_id = :user_id AND notified = 0";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
