<?php
session_start();
include('init.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the results
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a product was found
    if ($product) {
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<h1 style='font-family: Arial, sans-serif; color: #333;'>DETAILS D'ACHAT</h1>";
        echo "</div>";

        echo "<table style='width: 60%; margin: 20px auto; border-collapse: collapse; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>";
        echo "<thead>";
        echo "<tr style='background-color: #f4f4f4;'>";
        echo "<th style='padding: 10px; text-align: left; font-size: 16px; color: #555;'>Field</th>";
        echo "<th style='padding: 10px; text-align: left; font-size: 16px; color: #555;'>Value</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr style='border-bottom: 1px solid #ddd;'>";
        echo "<td style='padding: 10px; font-size: 14px; color: #333;'>Name</td>";
        echo "<td style='padding: 10px; font-size: 14px; color: #555;'>" . htmlspecialchars($product['product_name']) . "</td>";
        echo "</tr>";
        echo "<tr style='border-bottom: 1px solid #ddd;'>";
        echo "<td style='padding: 10px; font-size: 14px; color: #333;'>Price</td>";
        echo "<td style='padding: 10px; font-size: 14px; color: #555;'>" . htmlspecialchars($product['prix']) . "</td>";
        echo "</tr>";
        echo "<tr style='border-bottom: 1px solid #ddd;'>";
        echo "<td style='padding: 10px; font-size: 14px; color: #333;'>Quantity</td>";
        echo "<td style='padding: 10px; font-size: 14px; color: #555;'>" . htmlspecialchars($product['quantity']) . "</td>";
        echo "</tr>";
        echo "<tr style='border-bottom: 1px solid #ddd;'>";
        echo "<td style='padding: 10px; font-size: 14px; color: #333;'>Fournisseur</td>";
        echo "<td style='padding: 10px; font-size: 14px; color: #555;'>" . htmlspecialchars($product['fournisseur']) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='padding: 10px; font-size: 14px; color: #333;'>Date D'achat</td>";
        echo "<td style='padding: 10px; font-size: 14px; color: #555;'>" . htmlspecialchars($product['date']) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td style='padding: 10px; font-size: 14px; color: #333;'>Date d'Expiration</td>";
        echo "<td style='padding: 10px; font-size: 14px; color: #555;'>" . htmlspecialchars($product['dateex']) . "</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p style='text-align: center; color: red;'>No product found with the given ID.</p>";
    }
} else {
    echo "<p style='text-align: center; color: red;'>No ID was provided.</p>";
}

include $temp . 'footer.php';
?>
