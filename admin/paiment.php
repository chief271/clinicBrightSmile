<?php
session_start();
$pagetitle = "paiment";

$fixedfrais=20000;
include 'init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] == "paiment123") {
        header('location:paiment.php');
    } else {
        header('location:dashboard.php');
    }
}
include $temp .
    'footer.php';


try {
    $sql = "SELECT SUM(amount) AS total_amount
            FROM soins
            WHERE Etat = 1";

    $stmt = $con->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //  total amount, default to 0 if no result
    $total_amount = $result['total_amount'] ?? 0;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
//-------------------------------
try {
    $sql = "SELECT SUM(amount) AS encour_amount
            FROM soins
            WHERE Etat = 0";

    $stmt = $con->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //  total amount, default to 0 if no result
    $encour_amount = $result['encour_amount'] ?? 0;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
//-------------------------------
try {
    $sql = "SELECT SUM(prix) AS frais
            FROM products
            ";

    $stmt = $con->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //  total amount, default to 0 if no result
    $frais = $result['frais'] ?? 0;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<div class="container">
    <div class="card  ">
        <div class="pretcard"><i class="fas fa-check-circle"></i> Pret <br>
            <p>
                <?php echo "Total a pret: " . $total_amount . "Da"; ?></p>
        </div>
        <div class="encourscard"><i class="fas fa-spinner"></i> En cours <br>
            <p>
                <?php echo "Total a pret: " . $encour_amount . "Da"; ?></p>
        </div>
        <div class="fraitcard"><i class="fas fa-money-bill-wave"></i> Frait a Paye <br>
            <p>
                <?php echo "Total de produits: " . $frais . "Da <br>";
                echo "frait fix ". $fixedfrais . "Da" ?></p>
        </div>
    </div>
</div>