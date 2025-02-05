<?php
session_start();
$pagetitle = 'Manage Soins';
include 'init.php'; // Includes database connection, header, and navbar

// Get the service type from the query parameter
$service = isset($_GET['soins']) ? $_GET['soins'] : 'prothese';

// Validate the service type
$validServices = ['prothése', 'blanchiment', 'extraction dentaire'];
if (!in_array($service, $validServices)) {
    die("Invalid service type!");
}

try {
    // Fetch soins based on the service type
    $stmt = $con->prepare("SELECT soin_id, user_id, description, etat FROM soins WHERE description = ?");
    $stmt->execute([$service]);
    $soins = $stmt->fetchAll();

    echo "<div class='container mt-4'>
            <h2>Manage " . ucfirst($service) . " Soins</h2>
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>Soin ID</th>
                        <th>Client Username</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>";

    // Loop through the soins and fetch the corresponding username for each user_id
    foreach ($soins as $soin) {
        $userId = $soin['user_id']; // Get user_id for each soin

        // Prepare the SQL statement to get the username for the current user_id
        $stmtUser = $con->prepare("SELECT Username FROM users WHERE UserId = :userId");
        $stmtUser->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmtUser->execute();

        // Fetch the username for the current user_id
        $username = $stmtUser->fetchColumn();

        // Display the soin information along with the username
        echo "<tr>
                <td>" . htmlspecialchars($soin['soin_id']) . "</td>
                <td>" . htmlspecialchars($username) . "</td>
                <td>" . htmlspecialchars($soin['description']) . "</td>
                <td>" . ($soin['etat'] == 1 ? 'Completed' : 'In Progress') . "</td>
              </tr>";
    }

    echo "</tbody></table></div>";

} catch (PDOException $e) {
    die("Error fetching soins: " . $e->getMessage());
}
?>

<?php include $temp . "footer.php"; ?>
