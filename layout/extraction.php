<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extraction dentaire</title>
    <style>
        body {
            background-color: rgb(151, 237, 245);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: black;
            font-size: 2.5rem;
            margin: 20px;
        }

        h3,
        h4 {
            text-align: center;
            color: dodgerblue;
            margin: 20px 0;
        }

        p {
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            font-size: 1rem;
            line-height: 1.5;
            color: rgb(5, 5, 5);
            background-color: white;
            max-width: 90%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .p8 {
            width: 150px;
            height: 150px;
            margin: 20px auto;
            border-radius: 50%;
            background-image: url(ext1.jpg);
            background-size: cover;
            background-position: center;
        }

        img {
            width: 100%;
            max-width: 300px;
            border-radius: 50%;
            margin: 20px auto;
            display: block;
        }

        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .text-with-image {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .text-with-image img {
            flex: 1 1 150px;
            max-width: 250px;
        }

        .text-with-image p {
            flex: 2 1 300px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 0.9rem;
                padding: 15px;
            }

            .text-with-image {
                flex-direction: column;
                text-align: center;
            }

            .text-with-image img {
                margin: 0 auto;
            }

            .p8 {
                width: 200px;
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
            }

            p {
                font-size: 0.8rem;
            }

            .p8 {
                width: 150px;
                height: 150px;
            }
        }

        .p1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Extraction Dentaires</h1>
    <img src="imgs/ext1.jpg" alt="" style="width: 250px;">

    <p class="p1">Extraction Dentaire Professionnel – garantir une bouche saine et sans douleur !</p>

    <div class="text-with-image">
        <img src="./imgs/ext2.webp" alt="Chez Bright Smile">
        <div class="p00">
            <p>Chez Bright Smile : nous vous offrons un service Professionnel d'extraction dentaire dans notre clinique spécialisée, grâce à :</p>
        </div>
    </div>

    <h4 class="h3">Technologie Avancée et Moderne :</h4>
    <div class="text-with-image">
        <img src="./imgs/ext1.jpg" alt="Technologie Avancée">
        <p>Avec nos technologies avancées et modernes, nous vous proposons un service d'extraction dentaire hautement professionnel et sans effets secondaires, grâce à notre équipement stérilisé et pur qui garantit votre sûreté et votre sécurité.</p>
    </div>

    <h4 class="h4">Médecins spécialisés :</h4>
    <div class="text-with-image">
        <img src="./imgs/ext4.jpg" alt="Médecins spécialisés">
        <p>Nos dentistes expérimentés utilisent des techniques avancées pour assurer une procédure rapide et sans douleur, avec des années d'expérience et des technologies de haute qualité.</p>
    </div>

    <h4 class="h5">Suivi médical :</h4>
    <div class="text-with-image">
        <img src="./imgs/ext3.jpg" alt="Suivi médical">
        <p>Nous offrons également un suivi personnalisé pour une récupération optimale. Retrouvez votre quotidien sans douleur dentaire.</p>
    </div>
</body>

</html>