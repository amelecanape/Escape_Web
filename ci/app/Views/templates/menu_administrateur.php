<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="https://obiwan.univ-brest.fr/~e22103034/" class="logo d-flex align-items-center">
        <img src="https://obiwan.univ-brest.fr/~e22103034/ressource/logotffbleu.png" alt="">
        <span>Esc@pe Web - Learn English</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="https://obiwan.univ-brest.fr/~e22103034/">Accueil</a></li>
          <li class="dropdown"><a href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/profil" ><span>Compte</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a class="nav-link scrollto active" href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/profil">Profil</a></li>
                <li><a class="nav-link scrollto active" style="color:red" href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/deconnexion">Déconnexion</a></li>
            </ul>
          <li><a class="getstarted scrollto" href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario">Start Playing</a></li>
          <?php
          $session=session();
          //echo $session->get('role');
          if ($session->get('role')=='A'){
          echo '<li class="dropdown"><a href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/lister" ><span>Gérer les comptes</span></a>';
          }else{
            echo '<li class="dropdown"><a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/lister" ><span>Gérer les scénarii</span></a>';
          }
          ?>
        </ul>
        
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->