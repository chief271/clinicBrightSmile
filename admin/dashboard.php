<?php
session_start();

if (isset($_SESSION['Username'])) {
    $pagetitle = "Dashboard";
    include 'init.php';


?>
    <?php
    //tous les ons
    $stmt = $con->prepare("SELECT COUNT(*) AS total_soins FROM soins");
    $stmt->execute();
    $result = $stmt->fetch();
    $totalSoins = $result['total_soins'];

    $stmt = $con->prepare("SELECT COUNT(*) AS total_prothese FROM soins WHERE description = 'prothese'");
    $stmt->execute();
    $result = $stmt->fetch();
    $totalProthese = $result['total_prothese'];


    $stmt = $con->prepare("SELECT COUNT(*) AS total_Blanchements FROM soins WHERE description = 'Blanchements'");
    $stmt->execute();
    $result = $stmt->fetch();
    $totalBlanchements = $result['total_Blanchements'];


    $stmt = $con->prepare("SELECT COUNT(*) AS total_extraction FROM soins WHERE description = 'extraction dentaire'");
    $stmt->execute();
    $result = $stmt->fetch();
    $totalExtraction = $result['total_extraction'];

    ?>
    <div class="container dashboard mt-3">
        <h3>Bienvenu Au Dashboard, <span class="username"><?php echo htmlspecialchars($_SESSION['Username']); ?></span>!</h3>
        <hr>
    </div>
    
    <div class=" soins container ">
        <h5> <a class="lien" href="soins.php">Soins</a> </h5>

        <div class="soins-cards">

            <div>
                <div class="hover-text"><a href="manage.php?soins=prothese&page=1">Détails sur les prothèses </a> </div>
            </div>
            <div>
                <div class="hover-text"><a href="manage.php?soins=blanchements&page=1">Détails sur les blanchiments </a> </div>
            </div>
            <div>
                <div class="hover-text"><a href="manage.php?soins=extraction dentaire&page=1">Détails sur l'extraction dentaire </a></div>
            </div>
        </div>

    </div>
    <div class=" rendez-vous container bg-white ">
        <h5>Rendez-Vous</h5>
        <button class="btn btn-primary" onclick="location.href='rendezvous.php'" >Gérer les Rendez-vous</button>
    </div>
    <div class=" payments container bg-white ">
        <h5 class="mb-3"><i class="fa-solid fa-wallet"></i> Mes paiments</h5>
        <div class="pcontainer p-4 bg-light">
            <div class="">Identification
                <hr>
            </div>
            <div class="mb-3">Pour voir les details de paiments , veuillez ecrire votre mot de passe de paiment.

            </div>
            <div class=" p-3 note"><span>Note: </span>un mot de passe de paiment ,n'set pas le mot de passe de connexion

            </div>
            <form action=paiment.php method="POST">
                <div class="motpasse mt-2">
                    <label for="password"> Mot de Passe </label>
                    <input id="motpaseeinput" type="password" name="password">
                </div>
                <input  type="submit" style="background-color: #218838; color:white" class="btn mt-4 " value="Afficher Paiment">
            </form>


        </div>

    </div>

    <script>
        document.getElementById("motpaseeinput").addEventListener("click", function() {
            alert("Entrez SuperAdmin mot de passe")
        })
    </script>
<?php
    include  $temp . "footer.php";
} else {
    header('Location: index.php');
    exit();
}

?>