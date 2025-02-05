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

        h3, h4 {
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
                height: 150px;
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
    </style>
</head>
<body>
    <h1>Prothèses Dentaires</h1>
    <img src="imgs/pro8.png" alt="" style="width: 250px;">

    <p class="p1">La prothèse dentaire est une solution moderne et personnalisée pour restaurer l'esthétique et la fonctionnalité de votre sourire. Que vous ayez perdu une ou plusieurs dents, ou que vos dents nécessitent un renforcement, nos prothèses sont conçues pour s'adapter parfaitement à vos besoins.</p>

    <h3>Nos services incluent :</h3>
    <h4>Prothèses fixes:</h4>
    
    <div class="text-with-image">
        <img src="./imgs/pro2.jfif" alt="Prothèses fixes">
        
        <p>Couronnes, bridges et facettes pour une restauration permanente et esthétique.</p>
    </div>
   <h4> Prothèses amovibles:</h4>
    <div class="text-with-image">
        <img src="./imgs/pro3.jpg" alt="Prothèses amovibles">
        <p>Partielles ou complètes, elles offrent une option flexible et confortable pour remplacer plusieurs dents.</p>
    </div>
    <h4>Prothèses sur implants:</h4>

    <div class="text-with-image">
        <img src="./imgs/pro.jfif" alt="Prothèses sur implants">
        <p>Une solution durable combinant les avantages des implants dentaires et des prothèses, pour un confort optimal et une stabilité incomparable.</p>
    </div>

    <p>Avec des matériaux de haute qualité et des technologies de pointe, nous garantissons des résultats naturels et durables. Notre équipe d'experts vous accompagne à chaque étape, de la consultation initiale jusqu'à l'ajustement final, afin de vous offrir une expérience sereine et personnalisée.</p>
</body>
</html>