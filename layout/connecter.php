<?php
session_start();
include "connect.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $hashedPass = sha1($pass);



    $stmt = $con->prepare("SELECT UserId, Username, Password FROM users WHERE Username = ? AND Password = ? ");
    $stmt->execute(array($username, $hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();







    //if $count>0 user exist in database
    if ($count > 0) {
        $_SESSION['Username'] = $username;
        $_SESSION['UserId'] =$row['UserId'];
        echo "welcom";
        header('Location: client.php');
        exit();
    } else {
        echo "<script>
        alert('$username est pas un Membre');
         
    </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecter</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/connecter.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <div class="popup position-relative">

        <div class="login-box mx-auto">
            <div class="login-header">
                <header>
                    Se connecter au
                    <span class="bright">Bright</span>
                    <span class="smile">Smile</span>
                </header>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="mb-3">
                    <input type="text" placeholder="Nom d'utilisateur" name="username" class="input-field" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <input type="password" name=" pass" placeholder="Mot de passe" class="input-field" required autocomplete="off">
                </div>
                <div class="forgot text-center mb-3">
                    <a href="motpasse.php">MOT DE PASS OUBLIER?</a>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="submitbtn">SE CONNECTER</button>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>