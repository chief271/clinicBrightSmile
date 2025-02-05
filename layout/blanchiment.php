<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prothèses dentaires</title>
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
            margin: 20px 0;
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
            width: 200px;
            height: 200px;
            margin: 20px auto;
            border-radius: 50%;
            background-image: url(pro8.png);
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
                width: 150px;
                height: 250px;
                background-image: url(imgs/pro8.png);
                background-size: cover;
                background-position: center;
                border-radius: 50px;
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
                width: 120px;
                height: 120px;
            }
        }

        .p1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Blanchement Dentaires</h1>
    <div class="p8">
        <img src="imgs/BLA66.jpg" alt="" style="width: 250px;">
    </div>

    <p class="p1">Blanchiment Dentaire Professionnel – Retrouvez un Sourire Éclatant</p>



    <div class="text-with-image">
        <img src="imgs/bla7.jpg" alt="Prothèses fixes">
        <h3>Chez Bright smile :</h3>
        <p>Nous offrons des solutions de blanchiment dentaire professionnel qui éclaircissent vos dents de manière sécurisée et efficace.</p>
    </div>
    <h4>Technologie Avancées et Modernes :</h4>
    <div class="text-with-image">
        <img src="./imgs/bla1.jfif" alt="Prothèses amovibles">
        <p>Grâce à des techniques modernes et à des produits de haute qualité, nous éliminons les taches causées par des facteurs comme le café, le thé, le tabac ou le vieillissement naturel.</p>
    </div>
    <h4>Fournissez vos besoins :</h4>

    <div class="text-with-image">
        <img src="./imgs/bla3.jfif" alt="Prothèses sur implants">
        <p>Chaque traitement est adapté à vos besoins pour vous garantir des résultats visibles tout en respectant la santé de vos dents et gencives.</p>
    </div>

    <h4>Le Suivi Thérapeutique :</h4>
    <div class="text-with-image">
        <img src="./imgs/bla8.webp" alt="Prothèses sur implants">
        <p>Optez pour un soin en cabinet, pour un résultat rapide et spectaculaire, ou pour un kit personnalisé à domicile, vous permettant de blanchir vos dents à votre rythme.</p>
    </div>


</body>

</html>