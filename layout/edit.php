<?php
session_start();
include 'connect.php';
include '../include/function/funtion.php';
$pagetitle = "edit";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagetitle ?></title>
    <link rel="stylesheet" href="css/index.css">
    <!-- normalize -->
    <link rel="stylesheet" href="/css/normalized.css">
    <!-- font awesome library -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/edit.css">
    <!-- icon  -->
    <link rel="icon" type="image/png" href="/imgs/Smile_Care.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>

<body>
    <?php
    $userid = $_SESSION['UserId'];


    // Fetch user data
    $sql = "SELECT * FROM users WHERE UserId = :userid";
    $stmtt = $con->prepare($sql);
    $stmtt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmtt->execute();
    $data = $stmtt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $username = $data['Username'];
        $email = $data['Email'];
        $phone = $data['Numero'];
    }

    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nusername = isset($_POST['username']) ? trim($_POST['username']) : null;
        $nphone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
        $nemail = isset($_POST['email']) ? trim($_POST['email']) : null;

        if (!empty($nusername) && !empty($nphone) && !empty($nemail)) {
            $query = "
                UPDATE users
                SET Username = :nusername,
                    Numero = :nphone,
                    Email = :nemail
                WHERE UserId = :userid
            ";

            $stmt = $con->prepare($query);
            $stmt->bindParam(':nusername', $nusername, PDO::PARAM_STR);
            $stmt->bindParam(':nphone', $nphone, PDO::PARAM_STR);
            $stmt->bindParam(':nemail', $nemail, PDO::PARAM_STR);
            $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

            if ($stmt->execute()) {
                
                
            } else {
                
                
            }
        } else {
            
           
        }
    }

    ?>
    <div class=" header ">
        <h3>Welcome <?php echo " $username  " ?> </i></h3>
    </div>
    <a href="client.php"><i class="fa-solid fa-house fa-2x mt-5"> Retour au page principale </i></a>
    

    <div class="container editform">
        <form action="edit.php" method="POST">
            <legend>
            <table>
                <tr>
            <td><label for="username">Username:</label></td>
            <td><input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" id="username"></td>
            </tr>
            
            <tr>
            <td><label for="email">Email:</label></td>
           <td> <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" id="email"></td>
            </tr>
            <td><label for="phone">Phone:</label></td>
            <td><input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" id="phone"></td>
            <tr>
            </tr>
            <tr><td><input class="btn btn-primary" type="submit" value="Save"></td></tr>
            </table>
            </legend>
        </form>
        
    </div>
    <script src="layout/js/bootstrap.bundle.min.js"></script>
    <script src="layout/js/jquery-3.7.1.js"></script>
    <script src="layout/js/all.min.js"></script>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            let nusername = document.getElementById('username').value.trim();
            let nphone = document.getElementById('phone').value.trim();
            let nemail = document.getElementById('email').value.trim();

            // Validate username
            if (!nusername) {
                e.preventDefault();
                alert('Username cannot be empty.');
                return;
            }

            // Validate email
            if (!nemail.match(/^\S+@\S+\.\S+$/)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return;
            }

            // Validate phone
            if (!nphone.match(/^\d+$/)) {
                e.preventDefault();
                alert('Phone must contain only numbers.');
                return;
            }
        });
    </script>
</body>

</html>