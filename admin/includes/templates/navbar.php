<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"> BrightSmile</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="dashboard.php"><i class="fa-solid fa-house"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="soins.php"><i class="fa-solid fa-tooth"></i> Soins</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="product.php"><i class="fa-solid fa-teeth"></i> Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="membres.php"> <i class="fa-solid fa-person"></i> Members</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rendezvous.php" > <i class="fa-regular fa-calendar-check"></i> Rendez-vous</a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="statictique.php"><i class="fa-solid fa-chart-simple"></i> Statistics</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-user"></i> <?php echo $_SESSION['Username'] ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"> 
            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>