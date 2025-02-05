<?php
session_start();
include 'connect.php';


$userId = $_SESSION['UserId'];
// Assuming UserId is stored in the session

$sql = "SELECT COUNT(*) AS new_appointments 
        FROM appointments 
        WHERE user_id = :user_id AND notified = 0 ";
$stmt = $con->prepare($sql);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$newAppointments = $result['new_appointments'];





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>template 1</title>
  <!-- main css -->
  <link rel="stylesheet" href="css/index.css">
  <!-- normalize -->
  <link rel="stylesheet" href="/css/normalized.css">
  <!-- font awesome library -->
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- icon  -->
  <link rel="icon" type="image/png" href="/imgs/Smile_Care.png">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/all.min.js"></script>
  <!-- navbar star  -->
  <nav class="navbar navbar-expand-lg sticky-top ">
    <div class="container">
      <!-- logo  -->
      <a class="navbar-brand" href="#"><span class="bright">Bright</span><span class="Smile">Smile</span></a>
      <!-- ----------------  -->
      <!-- menu button  -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main" aria-controls="main"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <!-- ------------  -->
      <!-- nav links  -->
      <div class="collapse navbar-collapse" id="main">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa-solid fa-house"></i> Acceuil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services"><i class="fa-solid fa-tooth"></i>  Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#avis"><i class="fa-regular fa-face-smile"></i> Avis</a>
          </li>


          <li class="nav-item dropdown"><span id="notification-dot" class="red-dot" style="display: none;"></span>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> <?php echo $_SESSION['Username'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="edit.php">Edit profil</a></li>
              <li>
                
                  <span id="notification-dot" class="red-dot" style="display: none;"></span>
                  <a class="dropdown-item" id="soins-link" href="soins.php"><i class="fa-solid fa-tooth"></i>Soins</a>
                
              </li>
              <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
          </li>
        </ul>

      </div>
      <!-- end nav links  -->
    </div>
  </nav>
  <!-- navbar end  -->
  <!-- hero section start  -->
  <div class="landing d-flex justify-content-center align-items-center">
    <div class="text-center text-light">
      <h1>Votre Sourire, Notre Priorité</h1>
      <p class=" ">Des soins dentaires experts pour un sourire sain et éclatant</p>
      <p class=" text-white-50  fs-5">Emplacement Pratique | Équipement de Pointe | Soins Attentionnés</p>
      <a class="  btn btn-primary me-2 ms-2 rounded-pill " href="rendezvous.php">Rendez-vous</a>
    </div>
  </div>
  <!-- herosection end  -->

  <!-- medcin  -->
  <div class="equipe text-center pb-5 pt-5">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <div class="container">
        <div class="main-title">
          <i class="fa-solid fa-people-group custom-icon"></i>
          <h1 class="text-center">Notre Equipe </h1>
          <p class="text-black-50 text-uppercase">Une équipe de médecins dédiée à des soins d'excellence</p>
        </div>
      </div>
      <div class="container">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="d-flex align-items-center justify-content-center">
              <div class="container">
                <div class="row align-items-center g-4">

                  <div class="col-2 d-none d-md-flex d-flex flex-column">
                    <div class=" mb-4 p-3 bg-info text-white text-center rounded">
                      15 Ans EXPERIENCE
                    </div>
                    <div class=" p-3 bg-info text-white text-center rounded">
                      +150 OPERATIONS
                    </div>
                  </div>


                  <div class="col-4 text-center">
                    <img src="./imgs/doctorAhmed.jpg" alt="Image de Médecin" class=" img-cover img-fluid rounded mb-5"
                      style="max-height: 300px;">
                  </div>


                  <div class="col-6">
                    <h3>DR. Ahmed</h3>
                    <p>
                      Engagé à offrir des soins dentaires exceptionnels, spécialisé en traitements préventifs,
                      restaurateurs
                      et esthétiques.
                    </p>
                    <p>
                      Spécialiste en prothèses dentaires, nous vous offrons des solutions sur mesure pour restaurer
                      votre
                      confort et votre confiance.
                    </p>
                    <div class="d-flex gap-2">
                    <a href="rendezvous.php"><button class="btn btn-primary mb-2">Prendre un Rendez-vous !</button></a>
                      <a href="medecin2.php"><button class="btn btn-outline-secondary btn-sm">Voir Plus</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="carousel-item">
            <div class="d-flex align-items-center justify-content-center" ">
              <div class=" container">
              <div class="row align-items-center g-4">

                <div class="col-2 d-none d-md-flex d-flex flex-column">
                  <div class=" mb-4 p-3 bg-info text-white text-center rounded">
                    20 Ans EXPERIENCE
                  </div>
                  <div class=" p-3 bg-info text-white text-center rounded">
                    +450 OPERATIONS
                  </div>
                </div>


                <div class="col-4 text-center">
                  <img src="./imgs/png.jpg" alt="Image de Médecin" class=" img-cover img-fluid rounded mb-5"
                    style="max-height: 300px;">
                </div>


                <div class="col-6">
                  <h3>DR.Brahim</h3>
                  <p>
                    Engagé à offrir des soins dentaires exceptionnels, spécialisé en traitements préventifs,
                    restaurateurs
                    et esthétiques.
                  </p>
                  <p>
                    Spécialiste en prothèses dentaires, nous vous offrons des solutions sur mesure pour restaurer
                    votre
                    confort et votre confiance.
                  </p>
                  <div class="d-flex gap-2">
                    <a href="rendezvous.php"><button class="btn btn-primary mb-2">Prendre un Rendez-vous !</button></a>
                    <a href="medecin2.php"><button class="btn btn-outline-secondary btn-sm">Voir Plus</button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


      <button class="carousel-control-prev " type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-black " aria-hidden="true"></span>
        <span class="visually-hidden ">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  </div>
  <!-- SERVICES  -->
  <div id="services" class=" text-center pb-5 pt-5">
    <div class="container">
      <div class="main-title">
        <i class="fa-solid fa-tooth custom-icon"></i>
        <h2>Notre Soins</h2>
        <p class="text-black-50 text-uppercase">Nous offrons des consultations sur mesure pour vous aider à trouver les
          meilleures solutions adaptées à vos besoins</p>
      </div>
    </div>
    <div class="container">
      <div class="row ">
        <div class=" col-md-6 col-lg-4">
          <div class="  prothese ">
            <!-- overlay start  -->
            <div class="overlay d-flex justify-content-between flex-wrap">
              <div>
                <a class=" vb btn   " href="prothese.php">Voir Plus</a>
              </div>
              <div class="align-self-end">
                <h4 class="mb-3 mt-3 text-uppercase">Prothése</h4>
                <p class=" lh-base">Des solutions sur mesure pour restaurer votre sourire et votre
                  confort,avec des matériaux durables et un résultat naturel</p>
              </div>
            </div>
            <!-- overlay end -->
          </div>
        </div>
        <!-- ----------- -->
        <div class=" col-md-6 col-lg-4">
          <div class="  blanchement ">
            <!-- overlay start  -->
            <div class="overlay d-flex justify-content-between flex-wrap ">
              <div>
                <a class=" vb btn   " href="blanchiment.php">Voir Plus</a>
              </div>
              <div class="align-self-end">
                <h4 class="mb-3 mt-3 text-uppercase">Blanchiment</h4>
                <p class=" lh-base">Des traitements personnalisés pour sublimer votre sourire, alliant
                  efficacité, confort et des résultats naturellement éclatants</p>
              </div>
            </div>
            <!-- overlay end  -->

          </div>
        </div>
        <!-- ------------- -->
        <div class=" col-md-6 col-lg-4">
          <div class="  Extraction-Dentaire ">
            <!-- overlay start  -->
            <div class="overlay d-flex justify-content-between flex-wrap">
              <div>
                <a class=" vb btn   " href="extraction.php">Voir Plus</a>
              </div>
              <div class="align-self-end">
                <h4 class="mb-3 mt-3 text-uppercase">Extraction Dentaire</h4>
                <p class=" lh-base">Une solution efficace pour enlever une dent abîmée ou douloureuse, en
                  toute sécurité, avec un maximum de confort pour le patient.</p>
              </div>
            </div>
            <!-- overlay end  -->
          </div>


        </div>
      </div>
    </div>

    <!-- partie resultas  -->
    <div class="container">
      <h1 id="avis" class="text-center text-uppercase mt-5 mb-5">Nos patients témoignent</h1>

      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

          <div class="carousel-item active">
            <div class="row justify-content-center">
              <div class="col-md-4 text-center">
                <div class="bg-grey d-flex justify-content-center align-items-center rounded-circle"
                  style="width: 100px; height: 100px; margin: 0 auto; background-color: #5fea0e;">
                  <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                </div>
                <h3>Mohamed</h3>
                <p>J'ai récemment fait réaliser une prothèse dentaire chez cette clinique, et je suis très satisfait du
                  résultat. Dr. Ahmed a pris le temps d'expliquer chaque étape du processus et m'a mis à l'aise tout au
                  long du traitement. Les matériaux utilisés sont de qualité et le résultat final est naturel. Je me
                  sens enfin confiant avec mon sourire ! Je recommande vivement ce service.</p>
                <div>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star-half-alt text-warning"></i>
                  <i class="far fa-star text-warning"></i>
                </div>
              </div>
            </div>
          </div>


          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-4 text-center">
                <div class="d-flex justify-content-center align-items-center rounded-circle"
                  style="width: 100px; height: 100px; margin: 0 auto; background-color: #3b19ba;">
                  <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                </div>

                <h3>Ramy</h3>
                <p>Le service de blanchiment dentaire offert par Dr. Shaun a vraiment changé mon sourire ! Mes dents
                  sont beaucoup plus blanches et éclatantes. L'ensemble du traitement a été rapide et sans douleur, et
                  j'ai apprécié l'attention portée à ma confortabilité.</p>
                <div>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star-half-alt text-warning"></i>
                </div>
              </div>
            </div>
          </div>


          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-4 text-center">
                <div class="d-flex justify-content-center align-items-center rounded-circle"
                  style="width: 100px; height: 100px; margin: 0 auto; background-color: #5c0808;">
                  <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                </div>

                <h3>Rassim</h3>
                <p>Une clinique exceptionnelle ! Les deux docteurs, Ahmed et Shaun, sont très professionnels et
                  compétents. Je suis allé pour un traitement de blanchiment et de prothèses, et chaque étape a été
                  réalisée avec soin. Les services sont de qualité, et l'équipe s'assure de la satisfaction du patient
                  à chaque visite. Je recommande vivement cette clinique pour tous vos besoins dentaires.</p>
                <div>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="far fa-star text-warning"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-4 text-center">
                <div class="d-flex justify-content-center align-items-center rounded-circle"
                  style="width: 100px; height: 100px; margin: 0 auto; background-color: #d2fa0a;">
                  <i class="fas fa-user text-white" style="font-size: 40px;"></i>
                </div>

                <h3>Abdou</h3>
                <p>Le Dr. Shaun a effectué un blanchiment dentaire exceptionnel. Mes dents sont beaucoup plus blanches
                  et je suis très content du résultat. La procédure a été rapide et sans douleur. Je recommande
                  vivement ce service !</p>
                <div>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="far fa-star text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev"
          aria-label="Previous">
          <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next"
          aria-label="Next">
          <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
        </button>
      </div>
    </div>

    <!-- foteer start    -->
    <footer class="row row-cols-1 row-cols-md-2 row-cols-lg-5 p-3 py-5 my-5 border-top">
      <!-- Logo and Contact Info -->
      <div class="col mb-3 mb-md-0">
        <a href="#" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
          <div class="logo-img bg-secondary d-flex justify-content-center align-items-center rounded-circle"
            style="width: 100px; height: 100px; margin: 0 auto;">
            <!-- Logo content here -->
          </div>
        </a>
        <p class="text-muted mt-3">
          <i class="fas fa-map-marker-alt"></i> <a href="https://maps.app.goo.gl/eLFB6ECumrHNVnNY8" target="_blank">123 Rue Principale, Alger, Algérie</a>
        </p>
        <p class="text-muted">
          <i class="fas fa-phone-alt"></i> +213 00 00 00 00
        </p>
      </div>

      <!-- Empty Column for spacing (can be removed or adjusted if needed) -->
      <div class="col"></div>

      <!-- Menu Section -->
      <div class="col">
        <h5>Menu</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#services" class="nav-link p-0 text-muted">Services</a></li>
          <li class="nav-item mb-2"><a href="#avis" class="nav-link p-0 text-muted">Avis</a></li>
        </ul>
      </div>

      <!-- Services Section -->
      <div class="col">
        <h5>Services</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#services" class="nav-link p-0 text-muted">Prothèse</a></li>
          <li class="nav-item mb-2"><a href="#services" class="nav-link p-0 text-muted">Blanchement</a></li>
          <li class="nav-item mb-2"><a href="#services" class="nav-link p-0 text-muted">Extraction Dentaire</a></li>
        </ul>
      </div>

      <!-- Opening Hours Section -->
      <div class="col">
        <h5>Heures d'Ouverture</h5>
        <p><i class="fas fa-clock"></i> Lundi - Vendredi: 08h00 - 17h00</p>
        <p><i class="fas fa-clock"></i> Samedi: 09h00 - 14h00</p>
        <p><i class="fas fa-clock"></i> Dimanche: Fermé</p>
      </div>
    </footer>
    <!-- fotter end  -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const newAppointments = <?php echo $newAppointments; ?>;
        const notificationDot = document.getElementById('notification-dot');

        if (newAppointments > 0) {
          notificationDot.style.display = 'block';
        }
      });
      document.getElementById('soins-link').addEventListener('click', function() {
        fetch('update_notified.php')
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              document.getElementById('notification-dot').style.display = 'none';
              console.log('Notifications updated successfully.');
            } else {
              console.error('Failed to update notifications.');
            }
          })
          .catch(error => console.error('Error:', error));
      });
    </script>

</body>

</html>