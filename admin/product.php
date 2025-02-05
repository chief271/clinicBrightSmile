<?php
session_start();
$pagetitle = "product";
include 'init.php';

?>


<div class="box">
    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">ACHETER PRODUIT</button>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>nom de produit</th>
            <th>quantité</th>
            <th>prix</th>
            <th>Bon d'achat</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Ensure PDO throws exceptions for errors
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the query
    $query = "SELECT * FROM products";
    $stmt = $con->prepare($query);

    if ($stmt->execute()) { // Check if the query executes successfully
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Determine the row class based on the quantity
            $rowClass = ($row['quantity'] < 20) ? 'table-danger' : '';
    ?>
            <tr class="<?php echo $rowClass; ?>">
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['prix']) . " Da"; ?></td>
                <td><a href="bonachat.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-success">Bon Achat</a></td>
                <td><a href="update.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-success">Update</a></td>
                <td><a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger" name="delete">Delete</a></td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='7'>Failed to fetch products.</td></tr>";
    }
    ?>
</tbody>
</table>

<?php
if (isset($_GET['message'])) {
    echo "<h6>" . htmlspecialchars($_GET['message']) . "</h6>";
}
if (isset($_GET['insert_msg'])) {
    echo "<h6>" . htmlspecialchars($_GET['insert_msg']) . "</h6>";
}
?>

<form action="insert.php" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Acheter un produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form_groupe">
                        <label for="product_name">Nom du produit</label><br>
                        <input type="text" name="product_name" id="product_name" class="form-controle" required>
                    </div>
                    <div class="form_groupe">
                        <label for="id">id</label><br>
                        <input type="text" name="id" id="id" class="form-controle" >
                    </div>
                    <div class="form_groupe">
                        <label for="quantity">Quantité</label><br>
                        <input type="text" name="quantity" id="quantity" class="form-controle" required>
                    </div>
                    <div class="form_groupe">
                        <label for="prix">Prix</label><br>
                        <input type="text" name="prix" id="quantity" class="form-controle" required>
                    </div>
                    <div class="form_groupe">
                        <label for="fournisseur">Fournisseur</label><br>
                        <input type="text" name="fournisseur" id="fournisseur" class="form-controle" required>
                    </div>
                    <div class="form_groupe">
                        <label for="dateex">Date Expiration</label><br>
                        <input type="date" name="dateex" id="dateex" class="form-controle" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_products">Ajouter</button>
                </div>
            </div>
        </div>
    </div>
</form>


<?php include $temp . 'footer.php'; ?>