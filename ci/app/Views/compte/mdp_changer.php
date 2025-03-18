
<section id="recent-blog-posts" class="recent-blog-posts" style="background: url(https://obiwan.univ-brest.fr/~e22103034/bootstrap2/assets/img/hero-bg.png) top center no-repeat;">
<div class style="height:90px;"></div>

<div class="container" data-aos="fade-up">


<div class style="display:flex; width:100%; height:700px;%; flex-direction:column; align-items:center">
  

	<div class="col-lg-4">
	<div class="post-box" style="width:600px; align-items:center; background: #fff;">
	<h3 class="post-title"> Changer de Mot de passe:</h3>
        <?= session()->getFlashdata('error') ?>
        <?php echo form_open('/compte/changermotdepasse'); ?>
        <?= csrf_field() ?>
        <?php
            if (isset($erreur)){
                echo $erreur;
            }
        ?>
        <div class=inputbox style="height:40px;width:400px;">
        <input type="password" name="mdp" value=""  onkeyup="this.setAttribute('value', this.value);" autocomplete="off"style="height:40px;width:285px;border-radius:5px;border-style:solid;background:transparent;;padding-left:15px;padding-right:15px;">
        <label style="left:10px;">Mot de Passe:</label>
        
        </div>
        <?='<p style="color:red">'. validation_show_error('mdp').'</p>' ?>
        <div class=inputbox style="height:40px;width:400px;">
        <input type="password" name="mdpconfirmer" value=""  onkeyup="this.setAttribute('value', this.value);" autocomplete="off"style="height:40px;width:285px;border-radius:5px;border-style:solid;background:transparent;padding-left:15px;padding-right:15px;">
        <label style="left:10px;">Confirmer Mot de Passe:</label>

        </div>
        <?='<p style="color:red">'. validation_show_error('mdpconfirmer').'</p>' ?>

        </br>
        </hr>
        <input type="submit" style="height:40px;width:100px;border-radius:5px;background-color:#4154f1;font-weight:bold; color:#fff; border:none" value="Valider">
        <a class="getstarted scrollto" href="https://obiwan.univ-brest.fr/~e22103034/index.php/compte/profil">     Annuler</a>
      </form>
        </div>
      </div>
		

  </div>

</div>

</section><!-- End Recent Blog Posts Section -->