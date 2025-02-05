<?php

    session_start();
    include 'init.php'; // Ensure this includes the $con PDO connection
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve selected user ID and date
        $selectedUserId = $_POST['submit']; // User ID from the submit button
        $selectedDate = $_POST['date'][$selectedUserId]; // Date for the specific user ID
    
        // Validate inputs
        if (!empty($selectedUserId) && !empty($selectedDate)) {
            try {
                // Fetch the soin_id for the selected user_id
                $query = "SELECT soin_id FROM soins WHERE user_id = :userId LIMIT 1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(':userId', $selectedUserId, PDO::PARAM_INT);
                $stmt->execute();
    
                $soin = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($soin) {
                    $soinId = $soin['soin_id'];
    
                    // Insert into appointments table
                    $insertQuery = "INSERT INTO appointments (user_id, soin_id, dateS) VALUES (:selectedUserId, :soinId, :selectedDate)";
                    $insertStmt = $con->prepare($insertQuery);
                    $insertStmt->bindParam(':selectedUserId', $selectedUserId, PDO::PARAM_INT);
                    $insertStmt->bindParam(':soinId', $soinId, PDO::PARAM_INT);
                    $insertStmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
    
                    if ($insertStmt->execute()) {
                        echo "Appointment successfully added for User ID: $selectedUserId";
                    } else {
                        echo "Error: Could not insert the appointment.";
                    }
                } else {
                    echo "Error: No soin found for the selected user ID.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error: Please select a valid user ID and date.";
        }
    } else {
        echo "Invalid request method.";
    }
    ?>
    

