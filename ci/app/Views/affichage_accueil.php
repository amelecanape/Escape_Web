<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Learn English while having fun !</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">We offer serveral scenariis that will entertain you and will allow you to deepen your knowledge in english. Let's have fun, shall we?</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Start Playing</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="<?php echo base_url();?>bootstrap2/assets/img/our_img_1.svg" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->
<section id="values" class="values">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <h2>Our News</h2>
    <p>Discover what's happening on our app currently !</p>
  </header>

  <div class="actualites" data-aos="fade-up" style="box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08); padding:20px; border-radius:5px;">
        <?php
            if (! empty($news) && is_array($news))
            {
                echo "<br />";
                echo '<table class="table ">';
                echo '<tr style="background-color:#f2f5fc;">';
                echo '<th style="background-color:#f2f5fc;">Titre</th> <th style="background-color:#f2f5fc;">Intitulé</th> <th style="background-color:#f2f5fc;">Date</th> <th style="background-color:#f2f5fc;">Auteur</th>';
                echo '</tr>';
                foreach ($news as $act){
                    echo '<tr>';
                    echo '<td > '.$act['act_titre'].'</td>';
                    echo '<td>'.$act['act_texte'].'</td>';
                    echo '<td>'.$act['act_date'].'</td>';
                    echo '<td>'.$act['cpt_pseudo'].'</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo "<br />";


            }else {
                    echo("<h3>Aucune actualité pour le moment ! Repassez plus tard.</h3>");
            }
            ?>
    </div>

</div>

</section><!-- End Values Section -->

