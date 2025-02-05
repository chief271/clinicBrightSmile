<?php
session_start();

if (isset($_SESSION['Username'])) {
    $pagetitle = "Membres";
    include 'init.php';
    include $temp . "footer.php";
}
?>
<div class="mt-4 container">
    <h4>Gérer les rendez-vous</h4>
    <?php
    // Query for soins where rdv = 0
    $query = "
    SELECT
        soins.soin_id, 
        soins.description, 
        soins.user_id, 
        soins.daterdv, 
        users.nomcomplet, 
        users.Numero
    FROM soins
    LEFT JOIN users ON soins.user_id = users.UserId
    WHERE soins.rdv = 0
    ";

    $stmt = $con->prepare($query);
    $stmt->execute();

    // Fetch all results
    $soins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the results in a table
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Description</th>
                    <th>Date Suggérée</th>
                    <th>Nom Complet</th>
                    <th>Numéro</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

    // Loop through the results and display the data in table rows
    foreach ($soins as $row) {
        // Check if daterdv exists in the appointments table
        $checkQuery = "SELECT COUNT(*) FROM appointments WHERE dateS = ?";
        $checkStmt = $con->prepare($checkQuery);
        $checkStmt->execute([$row['daterdv']]);
        $dateExists = $checkStmt->fetchColumn() > 0;

        $color = $dateExists ? 'lightcoral' : 'lightgreen';

        echo "<tr>
                <td>" . htmlspecialchars($row['user_id']) . "</td>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td style='background-color: $color;'>" . htmlspecialchars($row['daterdv'] ?? 'Non définie') . "</td>
                <td>" . htmlspecialchars($row['nomcomplet']) . "</td>
                <td>" . htmlspecialchars($row['Numero']) . "</td>
                <td>
                    <!-- Modal Trigger Button with dynamic user_id and soin_id -->
                    <button class='btn btn-primary float-end' data-bs-toggle='modal' data-bs-target='#exampleModal'
                            data-user_id='" . htmlspecialchars($row['user_id']) . "'
                            data-soin_id='" . htmlspecialchars($row['soin_id']) . "'
                            data-daterdv='" . htmlspecialchars($row['daterdv'] ?? '') . "'
                            data-date_exists='" . ($dateExists ? '1' : '0') . "'>
                        Saisir RDV
                    </button>
                </td>
              </tr>";
    }
    ?>
    </tbody>
    </table>

    <hr>

    <!-- Modal Form for RDV -->
    <form action="insertrdv.php" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un RDV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Date Suggérée -->
                        <div class="form-group">
                            <label for="daterdv">Date suggérée</label><br>
                            <input type="date" name="daterdv" id="daterdv" class="form-control" readonly>
                        </div>
                        <!-- Date Confirmée -->
                        <div class="form-group mt-3">
                            <label for="date">Date confirmée</label><br>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <!-- Hidden Fields for user_id and soin_id -->
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="soin_id" id="soin_id">
                    </div>
                    <div class="modal-footer">
                        <!-- Button to Accept RDV -->
                        <button type="button" class="btn btn-success" id="acceptRdv" style="display:none;">Accepter RDV</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" name="save_rdv">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // JavaScript to populate modal fields with dynamic data
    const exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const userId = button.getAttribute('data-user_id');
        const soinId = button.getAttribute('data-soin_id');
        const daterdv = button.getAttribute('data-daterdv');
        const dateExists = button.getAttribute('data-date_exists') === '1';

        // Populate modal fields
        document.getElementById('user_id').value = userId;
        document.getElementById('soin_id').value = soinId;
        document.getElementById('daterdv').value = daterdv;

        // Highlight daterdv field and toggle the "Accepter RDV" button
        const daterdvField = document.getElementById('daterdv');
        const acceptRdvButton = document.getElementById('acceptRdv');
        daterdvField.style.backgroundColor = dateExists ? 'lightcoral' : 'lightgreen';
        acceptRdvButton.style.display = dateExists ? 'none' : 'inline-block';
    });

    // JavaScript to accept suggested date
    document.getElementById('acceptRdv').addEventListener('click', function () {
        const suggestedDate = document.getElementById('daterdv').value;
        document.getElementById('date').value = suggestedDate;
    });
</script>



<div class="container">
    <h3>Mes Rendez-vous</h3>
    <?php
    // Query for soins where rdv = 1
    $query = "
    SELECT
    soins.soin_id, 
    soins.description, 
    soins.user_id, 
    users.nomcomplet, 
    users.Numero, 
    GROUP_CONCAT(appointments.dateS SEPARATOR ', ') AS dates
FROM soins
LEFT JOIN users ON soins.user_id = users.UserId
LEFT JOIN appointments ON soins.soin_id = appointments.soin_id
WHERE soins.rdv = 1
GROUP BY soins.soin_id, soins.description, soins.user_id, users.nomcomplet, users.Numero;

    ";

    $stmt = $con->prepare($query);
    $stmt->execute();

    // Fetch all results
    $soins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the results in a table
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Description</th>
                    <th>Nom Complet</th>
                    <th>Numéro</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>";

    // Loop through the results and display the data in table rows
    foreach ($soins as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['user_id']) . "</td>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td>" . htmlspecialchars($row['nomcomplet']) . "</td>
                <td>" . htmlspecialchars($row['Numero']) . "</td>
                <td>" . htmlspecialchars($row['dates']) . "</td>
              </tr>";
    }
    ?>
    </tbody>
    </table>
</div>

<script>
    // When a modal button is clicked, populate the hidden user_id and soin_id fields
    const modal = document.getElementById('exampleModal');
    modal.addEventListener('show.bs.modal', function(event) {
        // Get data attributes from the button that triggered the modal
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-user_id');
        const soinId = button.getAttribute('data-soin_id');

        // Set the values of the hidden fields
        document.getElementById('user_id').value = userId;
        document.getElementById('soin_id').value = soinId;
    });
</script>