<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Équipe</title>
    <link rel="stylesheet" href="./css/medecin.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="header">
        <h2>NOTRE ÉQUIPE</h2>
        <div class="container">
            <div class="rectangle">
                <img src="./imgs/doctorAhmed.jpg" class="img1" alt="Dr. Ahmad">
                <img src="./imgs/png.jpg" class="img2" alt="Dr. Brahim">
            </div>
        </div>
    </div>

    <div class="main">
        <img src="./imgs/doctorAhmed.jpg" alt="Dr. Ahmad">
        <div class="content">
            <h2>DR. AHMAD</h2>
            <h4>Chirurgien-dentiste</h4>
            <p>Dr. Ahmad, chirurgien-dentiste, possède plus de 15 ans d'expérience dans le domaine dentaire, avec une spécialisation en prothèses dentaires. Passionné par la restauration et la réhabilitation dentaire, il met son expertise au service de ses patients pour leur offrir des solutions sur mesure adaptées à leurs besoins et à leur confort.</p>
            <a href="rendezvous.php" class="btn"><h4>Prendre un rendez-vous</h4></a>
        </div>
    </div>

    <div class="doc">
        <img src="./imgs/png.jpg" alt="Dr. Brahim">
        <div class="content">
            <h2>DR. BRAHIM</h2>
            <h4>Chirurgien-dentiste</h4>
            <p>Le Dr. Brahim est un chirurgien-dentiste hautement qualifié, doté de plus de 20 ans d'expérience dans le domaine de la santé bucco-dentaire. Passionné par son métier, il combine expertise technique et approche personnalisée pour offrir à ses patients des soins de qualité exceptionnelle.</p>
            <a href="rendezvous.php"class="btn"><h4>Prendre un rendez-vous</h4></a>
        </div>
    </div>
</body>
</html>

