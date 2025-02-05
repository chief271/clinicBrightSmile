<?php
session_start();
$noNavbar='';
$pagetitle='login';
if (isset($_SESSION['Username'])) {
    header('Location: dashboard.php');
    exit();
}

include "init.php";

include("connect.php");





if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);

    //check if username exist
    $stmt = $con->prepare("SELECT UserId ,Username, Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1 ");
    $stmt->execute(array($username, $hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();







    //if $count>0 user exist in database
    if ($count > 0) {
        $_SESSION['Username'] = $username;
        $_SESSION['UserId'] =$row['UserId'];
        echo "welcom";
        header('Location: dashboard.php');
        exit();
    } else {
        echo "non admin  " . $username;
    }
}
?>
<!-- login form  -->
<form class="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <h4 class="text-center">Admin Login </h4>
    <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="password">
    <div class="d-grid">
        <input type="submit" class="btn btn-primary  btn-block" value="login">
    </div>
</form>

<?php
include  $temp . "footer.php";
?>