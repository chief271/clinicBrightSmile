

<?php
session_start();
include('init.php');
include $temp . 'footer.php';


if (isset($_POST['add_products'])) {
    $product_name = $_POST['product_name'];
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $fournisseur = $_POST['fournisseur'];
    $prix = $_POST['prix'] * $_POST['quantity'];
    $dateex = $_POST['dateex'] ;

    if ($product_name == "" || empty($product_name)) {
        header('Location: product.php?message=you need to fill in the name of the product');
        exit;
    } else {
        try {
            $query = "INSERT INTO products (product_name, id, quantity, prix, fournisseur, dateex) VALUES (:product_name, :id, :quantity, :prix, :fournisseur, :dateex)";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
            $stmt->bindParam(':fournisseur', $fournisseur, PDO::PARAM_STR);
            $stmt->bindParam(':dateex', $dateex);
            $stmt->execute();

            
            header('Location: product.php?insert_msg=you have successfully added data');
            exit;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}
?>

    


