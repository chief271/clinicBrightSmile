<?php
session_start();
include('init.php');
include $temp . 'footer.php';


if (isset($_GET['id'])) {
   $id = $_GET['id'];

   try {
      $query = "SELECT * FROM products WHERE id = :id";
      $stmt = $con->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!$row) {
         die("No product found with ID $id");
      }
   } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
   }
}

if (isset($_POST['update_products'])) {
   if (isset($_GET['id_new'])) {
      $idnew = $_GET['id_new'];
   }

   $productname = $_POST['product_name'];
   $qte = $_POST['quantity'];

   try {
      $query = "UPDATE products SET product_name = :product_name, quantity = :quantity WHERE id = :id";
      $stmt = $con->prepare($query);
      $stmt->bindParam(':product_name', $productname, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $qte, PDO::PARAM_INT);
      $stmt->bindParam(':id', $idnew, PDO::PARAM_INT);
      $stmt->execute();

      header('Location: product.php');
      exit;
   } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
   }
}
?>

<form action="update.php?id_new=<?php echo htmlspecialchars($id); ?>" method="POST">
   <div class="modal-body">
      <div class="form_groupe">
         <label for="product_name">Nom du produit</label><br>
         <input type="text" name="product_name" id="product_name" class="form-controle" value="<?php echo htmlspecialchars($row['product_name']); ?>">
      </div>
      <div class="form_groupe">
         <label for="quantity">Quantité</label><br>
         <input type="text" name="quantity" id="quantity" class="form-controle" value="<?php echo htmlspecialchars($row['quantity']); ?>">
      </div> <br>

      <button type="submit" class="btn btn-success" name="update_products">Update</button>
   </div>
</form>