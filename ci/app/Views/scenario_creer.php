<section id="recent-blog-posts" class="recent-blog-posts" style="background: url(https://obiwan.univ-brest.fr/~e22103034/bootstrap2/assets/img/hero-bg.png) top center no-repeat;">
<div class style="height:90px;"></div>

<div class="container" data-aos="fade-up">


<div class style="display:flex; width:100%; height:700px;%; flex-direction:column; align-items:center">
  

	<div class="col-lg-4">
	<div class="post-box" style="width:600px; align-items:center; background: #fff;">
	<h3 class="post-title"> Créer un Scenario:</h3>
      <?= session()->getFlashdata('error') ?>
      
      <?php
      // Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
      echo form_open_multipart('/scenario/creer'); ?>
      <?= csrf_field() ?>
      
        <div class=inputbox style="height:40px;width:400px;">
        <input type="text" name="titre" value=""  onkeyup="this.setAttribute('value', this.value);" autocomplete="off"style="height:40px;width:285px;border-radius:5px;border-style:solid;background:transparent;;padding-left:15px;padding-right:15px;">
        <label style="left:10px;">Titre:</label>
        
        </div>
        <?php
            
        ?>
        <?='<p style="color:red">'. validation_show_error('titre').'</p>' ?>
        <div class=inputbox style="height:100px;width:400px;">
        <input type="text" name="intitule" value=""  onkeyup="this.setAttribute('value', this.value);" autocomplete="off"style="height:90px;width:285px;border-radius:5px;border-style:solid;background:transparent;padding-left:15px;padding-right:15px;">
        <label style="left:10px;">Intitule:</label>
        
        </div>
        <?='<p style="color:red">'. validation_show_error('intitule').'</p>' ?>
        
        <label for="fichier">Image pour le profil : </label>
        <input type="file" name="fichier">
        <?php
            if (isset($erreur)){
              echo '<p style="color:red">'.$erreur.'</p>';
          }
        ?>
        <?='<p style="color:red">'. validation_show_error('fichier').'</p>' ?>


        <div style="display: flex; flex-direction:row; align-items:center">

          <label for="statut">Choisir un statut:</label>
          </br>
          <select name="statut" class='form-control' style='width:100px; margin:10px'>
          <option value="C">Publié</option>
          <option value="P">Caché</option>
          </select>
        </div>
        </br>
        </hr>
        <input type="submit" style="height:40px;width:100px;border-radius:5px;background-color:#4154f1;font-weight:bold; color:#fff; border:none" value="Créer">
      </form>
        </div>
      </div>
		

  </div>

</div>

</section><!-- End Recent Blog Posts Section -->

