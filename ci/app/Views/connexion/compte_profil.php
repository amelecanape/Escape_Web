<?php
$session=session();
//echo $session->get('user');
?>
</h2>
<section id="recent-blog-posts" class="recent-blog-posts" style="background: url(https://obiwan.univ-brest.fr/~e22103034/bootstrap2/assets/img/hero-bg.png) top center no-repeat;">
<div class style="height:90px;"></div>

<div class="container" data-aos="fade-up">


<div class style="display:flex; width:100%; height:1000px;%; flex-direction:column; align-items:center">

	
	<?php
		echo '	<div class="col-lg-4">';
		echo '	<div class="post-box" style="height:400px; width:600px;display:flex; flex-direction:row; align-items:center;  background: #fff;">';
        echo "<img src='https://obiwan.univ-brest.fr/~e22103034/ressource/blank-profile-picture-973460_960_720.webp' style='border-radius:50%; height:50%'>";
        echo "<div class='barre' style='height:90%; width:3px;px; background-color:#f2f5fc;; margin:20px;'></div>";
        echo "<div style='display:flex; flex-direction:column; padding: 20px;'> <h2>Profil: ".$profil->cpt_pseudo."</h2>";
        if ($profil->cpt_role=='O'){
            echo '	<p>Rôle: Organisteur</p>';
        }else{
            echo '	<p>Rôle: Administrateur</p>';
        }
        echo' <a href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/changermotdepasse">Changer de mot de passe</a>';
		echo '</br>';
		echo '</br>';
		?>

  </div>

</div>

</section><!-- End Recent Blog Posts Section -->