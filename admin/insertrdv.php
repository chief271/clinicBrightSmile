<?php
session_start();
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_rdv'])) {
    // Get the submitted date, user_id, and soin_id from the form
    $selectedDate = $_POST['date'];
    $userId = $_POST['user_id'];
    $soinId = $_POST['soin_id'];

    try {
        // Prepare the insert query
        $insertQuery = "INSERT INTO appointments (user_id, soin_id, dateS) 
                        VALUES (:userId, :soinId, :selectedDate)";
        $insertStmt = $con->prepare($insertQuery);

        // Bind the parameters
        $insertStmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
        $insertStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $insertStmt->bindParam(':soinId', $soinId, PDO::PARAM_INT);

        // Execute the query and check if it was successful
        if ($insertStmt->execute()) {
            // If the insert is successful, update the rdv field in soins
            $updateQuery = "UPDATE soins 
                            SET rdv = 1 
                            WHERE soin_id = :soinId AND rdv = 0";
            $updateStmt = $con->prepare($updateQuery);
            $updateStmt->bindParam(':soinId', $soinId, PDO::PARAM_INT);

            // Execute the update query
            if ($updateStmt->execute()) {
               header(("location:rendezvous.php"));
            } else {
                echo "Error: Could not update the RDV in soins.";
            }
        } else {
            echo "Error: Could not insert the RDV. Please try again.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
