<?php session_start();
include('init.php'); ?>

<?php
if (isset($_GET['SRVS'])) {
    $id = $_GET['SRVS'];

    try {
        $query = "SELECT * FROM ALL_SRV WHERE SRVS = :id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception("No data found for the given ID.");
        }
    } catch (Exception $e) {
        die("Query failed: " . $e->getMessage());
    }
}
?>

<?php
if (isset($_POST['modifie_t'])) {
    if (isset($_GET['id_new'])) {
        $idnew = $_GET['id_new'];
    }

    $SOCOM = $_POST['so_com'];
    $SOINCOM = $_POST['so_incom'];
    $SOTOT = $_POST['so_ttl'];

    try {
        $query = "UPDATE ALL_SRV SET SO_COM = :SOCOM, SO_INCOM = :SOINCOM, SO_TOT = :SOTOT WHERE SRVS = :idnew";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':SOCOM', $SOCOM, PDO::PARAM_INT);
        $stmt->bindParam(':SOINCOM', $SOINCOM, PDO::PARAM_INT);
        $stmt->bindParam(':SOTOT', $SOTOT, PDO::PARAM_INT);
        $stmt->bindParam(':idnew', $idnew, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: statictique.php?update_msg=done.');
        exit;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
?>

<form action="upd.php?id_new=<?php echo htmlspecialchars($id); ?>" method="POST">
    <div class="upd">
        <label for="so_incom">SOINS INCOMPLETES</label>
        <input type="number" name="so_incom" class="form-control" value="<?php echo htmlspecialchars($row['SO_INCOM']); ?>">
    </div>

    <div class="upd">
        <label for="so_com">SOINS COMPLETED</label>
        <input type="number" name="so_com" class="form-control" value="<?php echo htmlspecialchars($row['SO_COM']); ?>">
    </div>

    <div class="upd">
        <label for="so_ttl">SOINS TOTALES</label>
        <input type="number" name="so_ttl" class="form-control" value="<?php echo htmlspecialchars($row['SO_TOT']); ?>">
    </div> <br>

    <button type="submit" class="btn btn-success" name="modifie_t">Update</button>
</form>

<?php include $temp . 'footer.php'; ?>
