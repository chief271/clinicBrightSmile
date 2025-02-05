<?php
session_start();
include 'connect.php';
include '../include/function/funtion.php';
$pagetitle = "Soins";


if (!isset($_SESSION['UserId'])) {
    echo "Vous devez être connecté pour voir vos soins !.";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php GetTitle() ?></title>
    <link rel="stylesheet" href="css/soins.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <div class="header   sticky-top">
        <h1 class="text-dark">Votre Soins</h1>
    </div>
    <a  href="client.php"><i class="mb-2 fa-solid fa-house fa-1x mt-5"> Retour au page principale </i></a>
    <!-- prochain rdv section  -->
    <div class="container mb-3  rounded p-3 bg-light">
        <?php
        $user_id = $_SESSION['UserId'];


        // FETCH RDV NON PAYE 

        $sql = "SELECT soin_id, description 
                FROM soins 
                WHERE etat = 0";

        $stmt = $con->prepare($sql);
        $stmt->execute();
        $resl = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $foundRdv = false; // no RDV

        foreach ($resl as $row) {
            $currentSoin = $row['soin_id'];
            $descr = $row['description'];

            // FETCH RDV 
            $query = "SELECT dateS, amount 
                      FROM appointments 
                      WHERE soin_id = :currentSoin AND etatA=0";

            $stmt = $con->prepare($query);
            $stmt->bindParam(':currentSoin', $currentSoin, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // display RDV 
            if ($result) {
                echo "Prochain RDV: " . htmlspecialchars($result['dateS']) . "<br>";
                echo "Montant: " . htmlspecialchars($result['amount']) . "DA<br>";
                echo "Description: " . htmlspecialchars($descr) . "<br>";
                $foundRdv = true;
            }
        }

        // Step 5: Display "Aucun RDV à venir" if no RDV 
        if (!$foundRdv) {
            echo "Aucun RDV à venir.<br>";
        }
        ?>




    </div>


    <!-- -------------------------------------- -->
    <!-- soins of clients  -->
    <div class="container mb-5  rounded p-3 bg-light">
        <h4>vos soins </h4>
        <?php
        //---------update amount in soins------------------
        $query = "
        UPDATE soins s
        SET s.amount = (
            SELECT SUM(a.amount)
            FROM appointments a
            WHERE a.soin_id = s.soin_id
              AND a.user_id = s.user_id
              AND a.etata = 1
        )
        WHERE s.soin_id = :soin_id
          AND s.user_id = :user_id
    ";
    
            
            $stmt = $con->prepare($query);
    
            
            $stmt->bindParam(':soin_id', $currentSoin, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
            
            if ($stmt->execute()) {
            } else {
                echo "Error: Could not update the amount.";
            }
    
        //-------------------------------------------------------------//
        $sql = "UPDATE soins SET etat = 1 WHERE progress = 100";
        $sttt = $con->prepare($sql);
        $sttt->execute();

        $user_id = $_SESSION['UserId'];

        $query = "
        SELECT
        description AS type,
        etat AS status,
        progress

        FROM
        soins
        WHERE
        user_id = :user_id;
        ";

        $stmt = $con->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<table class='table'>
            <thead>
                <tr>
                    <th>Type de Soins</th>
                    <th>Progress</th>
                    <th>Status </th>
                </tr>
            </thead>
            <tbody>";

            // DISPLAY SOINS DE USER ID
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['type']) . "</td>
                    <td>" . htmlspecialchars($row['progress']) . "%</td>
                    <td>" . ($row['status'] == 1 ? "Terminé" : "En cours") . "</td>
                </tr>";
            }

            echo "</tbody>
        </table>";
        } else {
            echo "<p>Aucun soin trouvé pour ce client.</p>";
        }
        ?>

    </div>
    <!-- ------------------------------------------------- -->

    <div class="container rounded p-3 bg-light">
        <?php

        $user_id = $_SESSION['UserId'];

        $sql = "SELECT soin_id , description 
FROM soins 
WHERE etat = 0";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $resl = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resl as $row) {
            $currentSoin = $row['soin_id'];
            $descr = $row['description'];
        }
        $sql = "UPDATE soins SET etat = 1 WHERE progress = 100";
        $sttt = $con->prepare($sql);
        $sttt->execute();


        $sql = "SELECT * FROM appointments WHERE soin_id = :currentSoin  ";

        $stmtt = $con->prepare($sql);
        $stmtt->bindParam(':currentSoin', $currentSoin, PDO::PARAM_INT);
        $stmtt->execute();




        if ($stmt->rowCount() > 0) {
            echo "<table class='table'>
    <thead>
        <tr>
            <th>Date de RDV</th>
            <th>Type de Soins</th>
            <th>Montant</th>
            <th>Statut du Paiement</th>
            
        </tr>
    </thead>
    <tbody>";

            // DISPLAY RDV OF CURRENT RDV 
            while ($row = $stmtt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
            <td>" . htmlspecialchars($row['dateS']) . "</td>
            <td>" . $descr . "</td>
            <td>" . htmlspecialchars($row['amount']) . " DZD</td>
            <td>" . ($row['etatA'] == 1 ? 'Payé' : "
            <form action='update_appointment.php' method='POST'>
                <input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['appointments_id']) . "'>
                <input type='hidden' name='soin_id' value='" . htmlspecialchars($row['soin_id']) . "'>  <!-- Include soin_id here -->
                <button type='submit' class='btn btn-primary'>Payer</button>
            </form>
        </td>") . "
            
        </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>Aucun rendez-vous trouvé pour ce client.</p>";
        }


        ?>

    </div>


    <!-- ---------------------------------------------------------  -->

    <div class="container">
        
    </div>

    </div>
    <script src="layout/js/bootstrap.bundle.min.js"></script>
    <script src="layout/js/jquery-3.7.1.js"></script>
    <script src="layout/js/all.min.js"></script>
    <script src="layout/js/backend.js"></script>


</body>

</html>