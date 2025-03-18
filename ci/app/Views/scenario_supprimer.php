
<section id="recent-blog-posts" class="recent-blog-posts" style="background: url(https://obiwan.univ-brest.fr/~e22103034/bootstrap2/assets/img/hero-bg.png) top center no-repeat;">
<div class style="height:90px;"></div>

<div class="container" data-aos="fade-up">


<div class style="display:flex; width:100%; height:700px;%; flex-direction:column; align-items:center">
  

	<div class="col-lg-4">
	<div class="post-box" style="width:600px; align-items:center; background: #fff;">
	<h3 class="post-title"> Suppression:</h3>
        <?= session()->getFlashdata('error') ?>
        <?php echo form_open('/scenario/supprimer/'.$code); ?>
        <?= csrf_field() ?>
        <h3>Êtes-vous sur de vouloir supprimer ce scenario?</h3>
        <input type="submit" style="height:40px;width:125px;border-radius:5px;background-color:#4154f1;font-weight:bold; color:#fff; border:none" value="Supprimer">
      </form>
        </div>
      </div>
		

  </div>

</div>

</section><!-- End Recent Blog Posts Section -->