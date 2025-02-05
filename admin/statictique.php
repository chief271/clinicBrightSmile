<?php 
session_start();
$pagetitle = "Statistics";
include('init.php');

// Calculate total amount
try {
    $sql = "SELECT SUM(amount) AS total_amount FROM soins WHERE Etat = 1";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Total amount, default to 0 if no result
    $total_amount = $result['total_amount'] ?? 0;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<div class="container my-4">
    <div class="row g-4">
        <!-- Card for Total Amount -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Total Amount</h5>
                    <p class="card-text display-6 fw-bold">
                        <?php echo number_format($total_amount, 2); ?> DA
                    </p>
                </div>
            </div>
        </div>

        <?php
        try {
            // Update the all_srv table
            $sql = "
                UPDATE all_srv
                SET 
                    SO_COM = (
                        SELECT COUNT(*) 
                        FROM soins 
                        WHERE Etat = 1 AND description = all_srv.SRVS
                    ),
                    SO_INCOM = (
                        SELECT COUNT(*) 
                        FROM soins 
                        WHERE Etat = 0 AND description = all_srv.SRVS
                    ),
                    SO_TOT = (
                        SELECT COUNT(*) 
                        FROM soins 
                        WHERE description = all_srv.srvs
                    );
            ";
            $stmt = $con->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES) . "</div>";
        }

        // Retrieve the updated data
        try {
            $query = "SELECT * FROM ALL_SRV";
            $stmt = $con->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <!-- Cards for all_srv data -->
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?php echo htmlspecialchars($row['SRVS']); ?></h5>
                            <p class="card-text">
                                <strong>Soins Complétés: </strong><?php echo htmlspecialchars($row['SO_COM']); ?><br>
                                <strong>Soins Incomplets: </strong><?php echo htmlspecialchars($row['SO_INCOM']); ?><br>
                                <strong>Total Soins: </strong><?php echo htmlspecialchars($row['SO_TOT']); ?>
                            </p>
                            <a href="upd.php?SRVS=<?php echo htmlspecialchars($row['SRVS']); ?>" class="btn btn-success">Modifier</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Query failed: " . htmlspecialchars($e->getMessage(), ENT_QUOTES) . "</div>";
        }
        ?>
    </div>
</div>

<?php include $temp . 'footer.php'; ?>
