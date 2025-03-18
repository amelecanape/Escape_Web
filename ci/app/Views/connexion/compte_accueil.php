
<?php
$session=session();
?>
</h2>
<div class style="height:90px;"></div>

 <!-- ======= Services Section ======= -->
 <section id="services" class="services">

<div class="container" data-aos="fade-up">

<header class="section-header">
    <h2>Administration</h2>
    <p>Bienvenue, <?php echo $session->get('user'); ?></p>
  </header>

  <div class="row gy-4">

    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-box blue">
        <i class="ri-discuss-line icon"></i>
        <h3>Mon Profil</h3>
        <p>Consulter et modifier son profil.</p>
        <a href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/profil" class="read-more"><span>Y aller</span> <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
    <?php
    if($session->get('role')=='A'){
     echo'<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">';
     echo' <div class="service-box red">';
     echo'  <i class="ri-discuss-line icon"></i>';
     echo'  <h3>Gestion Des Comptes</h3>';
     echo"  <p>Modifier, ajouter, supprimer les comptes de l'application.</p>";
     echo'   <a href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/lister" class="read-more"><span>Y aller</span> <i class="bi bi-arrow-right"></i></a>';
     echo' </div>';
     echo'  </div>';
    }else{
      echo' <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">';
      echo'<div class="service-box green">';
      echo'  <i class="ri-discuss-line icon"></i>';
      echo'  <h3>Gestion Des Scenarios</h3>';
      echo' <p>Créer et gérez vos scenarios.</p>';
      echo'  <a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/lister" class="read-more"><span>Y aller</span> <i class="bi bi-arrow-right"></i></a>';
      echo' </div>';
      echo' </div>';
    }
?> 
    

    

  </div>

</div>

</section><!-- End Services Section -->
