<!-- ======= Portfolio Section ======= -->
<div class style="height:90px;"></div>
<section id="portfolio" class="portfolio">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <h2>Scenarii</h2>
    <p>Time to play ! Choose any scenario and a Difficulty !</p>
  </header>

  <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

    

    <?php
    if (! empty($scenario) && is_array($scenario))
    {
        foreach ($scenario as $sce){
         echo'<div class="col-lg-4 col-md-6 portfolio-item filter-app">';
         echo'<div class="portfolio-wrap">';
         echo'<img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$sce['sce_image'].'" class="img-fluid" alt="">';
         echo'<div class="portfolio-info">';
        echo'<h4>'.$sce['sce_titre'].'</h4>';
        echo'<p>'.$sce['sce_texte'].'</p>';
        echo'<p style="color:black"> Auteur: '.$sce['cpt_pseudo'].'</p>';
         echo'<div class="portfolio-links">';
         echo'<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/jouer/'.$sce['sce_code'].'/1" style="background:green;">1</a>';
         echo'<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/jouer/'.$sce['sce_code'].'/2"  style="background:orange;">2</a>';
         echo'<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/jouer/'.$sce['sce_code'].'/3"  style="background:red;">3</a>';
         //echo'<a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>';
         echo'</div>';
         echo'</div>';
         echo'</div>';
         echo'</div>';
        //echo '<div class style="display:flex; width:100%; height:1000px;%; flex-direction:row; justify-content:space-around;">';
            /*echo '<div class=scenario style="display:flex; flex-direction:column; align-items:center; justify-content:center; background-color:#1a1a1a; width:300px; height:500px; padding:10px;border-radius:5px;">';
            echo '<img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$sce['sce_image'].'" height=100px;>';
            echo "<br />";
            echo '<h3>'.$sce['sce_titre'].'</h3>';
            echo "<br />";
            echo $sce['sce_texte'];
            echo "<br />";
            echo "<h4>Levels:</h4>";
            echo '<div style="display:flex; width:100%; flex-direction:row; justify-content:space-around; padding-left:30px; padding-right:30px;">';
            echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/jouer/'.$sce['sce_code'].'/1" style="color:green"> 1 </a>';
            echo "<br />";
            echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/jouer/'.$sce['sce_code'].'/2" style="color:orange"> 2 </a>';
            echo "<br />";
            echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/jouer/'.$sce['sce_code'].'/3"style="color:red"> 3 </a>';
            echo '</div>';
            echo '</div>';*/

        }
        echo '</div>';
        echo "<br />";


    }else {
            echo("<h3>Aucun scenario pour le moment ! Repassez plus tard...</h3>");
    }
    ?>

  </div>

</div>

</section><!-- End Portfolio Section -->
