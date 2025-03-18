
<section id="recent-blog-posts" class="recent-blog-posts" style="background: url(https://obiwan.univ-brest.fr/~e22103034/bootstrap2/assets/img/hero-bg.png) top center no-repeat;">
<div class style="height:90px;"></div>

<div class="container" data-aos="fade-up">


<div class style="display:flex; width:100%; height:1000px;%; flex-direction:column; align-items:center">

	
	<?php
		if (isset($etape)){
		echo '	<div class="col-lg-4">';
		echo '	<div class="post-box" style="height:700px; width:600px; align-items:center; background: #fff;">';
		echo '	<div class="post-img"><img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$etape->rsc_chemin.'" class="img-fluid" alt=""></div>';
		echo '	<h3 class="post-title">'.$etape->eta_titre.'</h3>';
		echo '	<p>'.$etape->eta_texte.'</p>';
		echo '	<p class="post-title">'.$etape->eta_question.'</p>';
		?>

	<?php echo form_open('/scenario/jouer/'.$etape->sce_code.'/'.$etape->ind_niveau); ?>
      <?= csrf_field() ?>
        <div class=inputbox style="height:40px;width:400px;">
        <input type="text" name="reponse" value=""  onkeyup="this.setAttribute('value', this.value);" autocomplete="off"style="height:40px;width:285px;border-radius:5px;border-style:solid;background:transparent;;padding-left:15px;padding-right:15px;">
        <label style="left:10px;">Answer:</label>
        </div>
		<?php
            if (isset($erreur)){
                echo '<p style="color:red">'.$erreur.'</p>';
            }
        ?>
        <?='<p style="color:red">'. validation_show_error('reponse').'</p>' ?>
        </hr>
        <input type="submit" style="height:40px;width:100px;border-radius:5px;background-color:#4154f1;font-weight:bold; color:#fff; border:none" value="Validate">
      </form>
	  <?php
		echo '</br>';
		echo '</br>';
		if ($etape->ind_id!=null){
			echo "Tip:".$etape->ind_texte;
			echo "<a href='".$etape->ind_lien."' target='_blank'> Tip Link </a>"; 
		}else{
			echo "No tip for this question !";
			}
		echo '	</div>';
		}
		else {
		echo ("Pas d'étapes lié a ce code.");
		}
		?>

  </div>

</div>

</section><!-- End Recent Blog Posts Section -->

<?php
?>