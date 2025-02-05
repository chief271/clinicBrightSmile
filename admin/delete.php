



<?php
session_start();
include('init.php');
include $temp . 'footer.php';


if (isset($_POST['add_products'])) {
  $product_name = $_POST['product_name'];
  $id = $_POST['id'];
  $quantity = $_POST['quantity'];

  if ($product_name == "" || empty($product_name)) {
    header('Location: product.php?message=you need to fill in the name of the product');
    exit;
  } else {
    try {
      $query = "INSERT INTO products (product_name, id, quantity) VALUES (:product_name, :id, :quantity)";
      $stmt = $con->prepare($query);
      $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->execute();

      header('Location: product.php?insert_msg=you have successfully added data');
      exit;
    } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
    }
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  try {
    $query = "DELETE FROM products WHERE id = :id";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: Product.php');
    exit;
  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }
}
?>

