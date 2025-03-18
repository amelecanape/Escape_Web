
<section id="recent-blog-posts" class="recent-blog-posts" styrle="background: url(https://obiwan.univ-brest.fr/~e22103034/bootstrap2/assets/img/hero-bg.png) top center no-repeat;">
<div class style="height:90px;"></div>

<div class="container" data-aos="fade-up">



<div style=" display:flex; flex-direction:column; align-items:center; flex-wrap: wrap;"> 

<?php
                echo '	<div class="post-box" style="height:500px; width:400px; align-items:center; margin-top:20px;margin-bottom :20px; background: #fff;">';
                echo '	<div class="post-img"><img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$scenario->sce_image.'" class="img-fluid" alt=""></div>';
                echo '	<h3 class="post-title">'.$scenario->sce_titre.'</h3>';
                echo '	<p>'.$scenario->sce_texte.'</p>';
                echo '	</div>';
?>


	<?php
     if (! empty($etapes) && is_array($etapes))
     {
         
        echo '<table class="table ">';
        echo '<tr style="background-color:#f2f5fc;">';
        echo '<th style="background-color:#f2f5fc;">Code</th> <th style="background-color:#f2f5fc;">Titre</th> <th style="background-color:#f2f5fc;">Texte</th> <th style="background-color:#f2f5fc;">Question</th> <th style="background-color:#f2f5fc;">Reponse</th> <th style="background-color:#f2f5fc;">Statut</th><th style="background-color:#f2f5fc;">Image</th>';
        echo '</tr>';
        
        foreach ($etapes as $eta){
            echo '<tr>';
            echo '<td > '.$eta["eta_code"].'</td>';
            echo '<td > '.$eta["eta_titre"].'</td>';
            echo '<td>'.$eta["eta_texte"].'</td>'; 
            echo '<td>'.$eta["eta_question"].'</td>'; 
            echo '<td>'.$eta["eta_reponse"].'</td>'; 
            echo '<td>'.$eta["eta_statut"].'</td>';
            echo '<td><img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$eta["rsc_chemin"].'" style="height:50px"></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo "<br />";


    }else {
            echo("<h3>Aucun scenario pour le moment ! Repassez plus tard.</h3>");
    }
         /*foreach ($etapes as $eta){
                echo '	<div class="post-box" style="height:600px; width:400px; align-items:center; margin-top:20px;margin-bottom :20px; background: #fff;">';
                echo '	<div class="post-img"><img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$eta['rsc_chemin'].'" class="img-fluid" alt=""></div>';
                echo '	<h3 class="post-title">'.$eta['eta_titre'].'</h3>';
                echo '	<p>'.$eta['eta_texte'].'</p>';
                echo '	<h5 class="post-title">'.$eta['eta_question'].'</h5>';
                echo '	<p> ->'.$eta['eta_reponse'].'</p>';
                if ($eta['ind_id']=null){
                    echo "Tip:".$$eta['ind_texte'];
                    echo "<a href='".$eta['ind_lien']."' target='_blank'> Tip Link </a>"; 
                }else{
                    echo "No tip for this question !";
                    }
                echo '	</div>';
        }
     }else {
             echo("<h3>Aucun scenario pour le moment ! Repassez plus tard.</h3>");
     }*/
		
		?>

</div>

</div>

</section><!-- End Recent Blog Posts Section -->

<?php
/*if (isset($etape)){
echo '<div class style="display:flex; width:100%; height:1000px;%; flex-direction:column; justify-content:center; align-items:center">';
echo '</br>';
echo '<div class=scenario style="display:flex; flex-direction:column; align-items:center; justify-content:center; background-color:#1a1a1a; width:800px; height:90vh; padding:10px; border:1px solid white; border-radius:5px;">';
echo '<h1>'.$etape->eta_titre.'</h1>';
echo '<img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$etape->rsc_chemin.'">';
echo '</br>';
echo $etape->eta_texte;
echo '</br>';
echo '</br>';
echo "Question:".$etape->eta_question;
echo '</br>';
echo '->'.$etape->eta_reponse;
echo '</br>';
echo '</br>';
if ($etape->eta_id!=null){
	echo "Tip:".$etape->ind_texte;
	echo "<a href='".$etape->ind_lien."' target='_blank'> Tip Link </a>"; 
}else{
	echo "No tip for this question !";
	}
echo'</div>';
echo'</div>';


}
else {
echo ("Pas de scenario lié a ce code,ou pas de première étape");
}*/
?>