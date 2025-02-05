<?php
session_start();
include "init.php";
include "connect.php"; // Include your PDO database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['user']; // Username
    $password = $_POST['pass']; // Original password
    $email = $_POST['email']; // Email
    $phone = $_POST['phone']; // Phone number (Numero)
    $hashedPass = sha1($password); // Hash the password (consider using password_hash for better security)

    try {
        // SQL query to insert data into the database
        $sql = "INSERT INTO users (Username, Numero, Email, Password) 
                VALUES (:username, :phone, :email, :hashedPass)";

        // Prepare the statement
        $stmt = $con->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR); // Bind the phone number
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':hashedPass', $hashedPass, PDO::PARAM_STR); // Bind the hashed password

        // Execute the statement
        if ($stmt->execute()) {
            // Get the last inserted ID
            $userId = $con->lastInsertId();

            // Store Username and UserId in the session
            $_SESSION['Username'] = $username;
            $_SESSION['UserId'] = $userId;

            // Redirect to the client page
            header('Location: client.php');
            exit; // Ensure no further code runs after the redirect
        } else {
            echo "Failed to add user.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/signin.css">
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
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="mb-3">
                    <input type="text" placeholder="Nom d'utilisateur" name="user" class="input-field" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="+213" name="phone" class="input-field" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <input type="text" placeholder="Email" name="email" class="input-field" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <input type="password" placeholder="Mot de pass" name="pass" class="input-field" required autocomplete="off">
                </div>

                <div class="text-center">
                    <button type="submit" class="submitbtn">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>