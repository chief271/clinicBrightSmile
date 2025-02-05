<?php
session_start();
if (!isset($_SESSION['UserId'])) {
    header('Location: signin.php');
    exit();
}

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['appointment_id'];
    $soin_id = $_POST['soin_id'];
    $user_id = $_SESSION['UserId'];

    try {
        // Start a transaction
        $con->beginTransaction();

        // Get the current progress of the soin
        $query = "SELECT progress, etat FROM soins WHERE soin_id = :soin_id AND user_id = :user_id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':soin_id', $soin_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $soin = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$soin) {
            throw new Exception("Soin not found.");
        }

        $progress = $soin['progress'];
        $etatS = $soin['etat'];

        // Check if progress is less than 100
        if ($progress < 100) {
            // Increase progress by 25%
            $update_progress_query = "
                UPDATE soins
                SET progress = progress + 25
                WHERE soin_id = :soin_id AND progress < 100
            ";
            $update_stmt = $con->prepare($update_progress_query);
            $update_stmt->bindParam(':soin_id', $soin_id, PDO::PARAM_INT);
            $update_stmt->execute();

            // Re-fetch the progress to ensure it's still less than 100
            $stmt->execute();
            $soin = $stmt->fetch(PDO::FETCH_ASSOC);
            $progress = $soin['progress'];

            // Mark the appointment as paid
            $update_appointment_query = "
                UPDATE appointments
                SET etatA = 1
                WHERE appointments_id = :appointment_id
            ";
            $update_stmt = $con->prepare($update_appointment_query);
            $update_stmt->bindParam(':appointment_id', $appointment_id, PDO::PARAM_INT);
            $update_stmt->execute();

            // If progress is still less than 100 = add  new appointment
            if ($progress < 100) {
                // Fetch the date of the current appointment
                $sql = "SELECT dateS FROM appointments WHERE soin_id = :soin_id AND appointments_id = :appointment_id";
                $tstmt = $con->prepare($sql);
                $tstmt->bindParam(':soin_id', $soin_id, PDO::PARAM_INT);
                $tstmt->bindParam(':appointment_id', $appointment_id, PDO::PARAM_INT);
                $tstmt->execute();
                $row = $tstmt->fetch(PDO::FETCH_ASSOC);

                if (!$row) {
                    throw new Exception("Appointment not found.");
                }

                $date = $row['dateS']; // Current RDV date

                // Calculate the new appointment date
                $new_dateS = date('Y-m-d H:i:s', strtotime($date . ' +1 week'));
                $new_amount = 2500;
                $new_etat = 0;

                // Insert the new appointment
                $insert_query = "
                    INSERT INTO appointments (user_id, soin_id, dateS, amount, etatA)
                    VALUES (:user_id, :soin_id, :dateS, :amount, :etatA)
                ";
                $insert_stmt = $con->prepare($insert_query);
                $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':soin_id', $soin_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':dateS', $new_dateS);
                $insert_stmt->bindParam(':amount', $new_amount, PDO::PARAM_INT);
                $insert_stmt->bindParam(':etatA', $new_etat, PDO::PARAM_INT);

                if (!$insert_stmt->execute()) {
                    throw new Exception("Failed to add new appointment.");
                }
            }
        }

        // Commit the transaction
        $con->commit();
        echo "Rendez-vous payé, progrès mis à jour, et nouveau rendez-vous ajouté si nécessaire!";
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $con->rollBack();
        echo "Erreur : " . $e->getMessage();
    }

    header("Location: soins.php");
    exit();
}
?>
