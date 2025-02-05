<?php
session_start();
include "init.php";
$userid = $_SESSION['UserId'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $description = $_POST['select'];
    $daterdv= $_POST['daterdv'];

    $description = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);

    if (empty($description)) {
        throw new Exception("Description is required.");
    }

    try {



        // Insert a new record into the soins table
        $querysoin = "
            INSERT INTO soins (user_id, description , daterdv)
            VALUES (:userid, :description, :daterdv)
        ";
        $querysoin = $con->prepare($querysoin);
        $querysoin->bindParam(':description', $description);
        $querysoin->bindParam(':userid', $userid);
        $querysoin->bindParam(':daterdv', $daterdv);

        // Execute the query
        if ($querysoin->execute()) {
            header("Location: client.php");
            
        } else {
            throw new Exception("Failed to insert into the database.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }



    $query = "UPDATE users 
            SET 
                nomcomplet=:name,
                Email=:email,
                Numero=:phone 
                WHERE UserId=:userid";
    $query = $con->prepare($query);
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':userid', $userid);
    if (!$query->execute()) {
        throw new Exception("failed insertion");
    }
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre Rendez-vous - Cabinet Dentaire</title>
    <link rel="stylesheet" href="css/rendezvous.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1><span>Bright</span><span>Smile</span></h1>
        <p>Souriez, nous prenons soin de vous</p>
    </header>
    <a href="client.php"><i class="mb-2 fa-solid fa-house fa-1x "> Retour au page principale </i></a>
    <main>
        <section class="appointment-form">
            <h2>Prendre Rendez-vous</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="daterdv">
                </div>
                <div class="select">
                    <label for="select">Type de soin</label>
                    <select name="select" id="select">
                        <option value="0">selectioner</option>
                        <option value="prothése">Prothèse</option>
                        <option value="blanchiment">Blanchiment</option>
                        <option value="extraction dentaire">Extraction dentaire</option>
                    </select>
                </div>
                <br>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2025 Cabinet Dentaire. Tous droits réservés.</p>
    </footer>
</body>

</html>