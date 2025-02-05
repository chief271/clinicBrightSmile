<?php 
include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from form input
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    // Check if both fields are filled
    if (!empty($username) && !empty($pass)) {
        // Hash the password
        $hashedPass = sha1($pass); // Use password_hash() for stronger security

        try {
            // Prepare the SQL statement
            $query = $con->prepare("UPDATE users SET Password = :password WHERE Username = :username");
            $query->bindParam(':password', $hashedPass);
            $query->bindParam(':username', $username);

            // Execute the query
            if ($query->execute()) {
                // Check if any row was updated
                if ($query->rowCount() > 0) {
                    echo "<div class='alert alert-success'>Mot de passe mis à jour avec succès pour $username !</div>";
                } else {
                    echo "<div class='alert alert-warning'>Nom d'utilisateur introuvable.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Une erreur s'est produite lors de la mise à jour. Veuillez réessayer.</div>";
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Erreur : " . htmlspecialchars($e->getMessage(), ENT_QUOTES) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Veuillez remplir tous les champs.</div>";
    }
}
?>

<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES); ?>" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" placeholder="Enter nom d'utilisateur" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="pass">Nouveau Mot de passe</label>
            <input type="password" id="pass" placeholder="Entrer Nouveau Mot de passe" name="pass" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
    </form>
</div>
