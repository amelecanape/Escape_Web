<div class style="height:90px;"></div>

    <section id="values" class="values">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <h2>Administration</h2>
    <p>Liste des scenarios</p>
  </header>

  <div class="actualites" data-aos="fade-up" style="box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08); padding:20px; border-radius:5px;">
        <?php
            $session=session();
            if (! empty($scenario) && is_array($scenario))
            {
                echo "<h2>Nombre de Scénarii:  ".$nb_scenario->nb."</h2>";
                echo "<a href='https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/creer' target='_blank'><h2>+</h2></a></li>";
                echo "<br />";
                echo '<table class="table ">';
                echo '<tr style="background-color:#f2f5fc;">';
                echo '<th style="background-color:#f2f5fc;">Code</th> <th style="background-color:#f2f5fc;">Titre</th> <th style="background-color:#f2f5fc;">Texte</th> <th style="background-color:#f2f5fc;">Statut</th><th style="background-color:#f2f5fc;">Etapes</th><th style="background-color:#f2f5fc;">Image</th> <th style="background-color:#f2f5fc;">Auteur</th><th style="background-color:#f2f5fc;"> </th>';
                echo '</tr>';
                
                foreach ($scenario as $sce){
                    echo '<tr>';
                    echo '<td > '.$sce["sce_code"].'</td>';
                    echo '<td > '.$sce["sce_titre"].'</td>';
                    echo '<td>'.$sce["sce_texte"].'</td>'; 
                   // echo '<td>'.$sce["sce_statut"].'</td>';
                    echo '<td>';
                    if ($sce["sce_statut"]=='P'){
                        echo 'Publié';
                    }else{
                        echo 'Caché';
                    }
                    echo '</td>';
                    echo '<td>'.$sce["nb"].'</td>';
                    echo '<td><img src="https://obiwan.univ-brest.fr/~e22103034/ressource/'.$sce["sce_image"].'" style="height:50px"></td>';
                    echo '<td>'.$sce["cpt_pseudo"].'</td>';
                    echo '<td> <a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/visualiser/'.$sce["sce_code"].'"><i class="bi bi-eye"></i></a>';
                    if($sce["cpt_pseudo"]==$session->get('user')){
                     echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/editer/'.$sce["sce_code"].'"><i class="bi bi-pen"></i></a>';
                     echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/copier/'.$sce["sce_code"].'"><i class="bi bi-clipboard"></i></a>';
                     echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/supprimer/'.$sce["sce_code"].'"><i class="bi bi-trash"></i></a>';
                     echo '<a href="https://obiwan.univ-brest.fr/~e22103034/index.php/scenario/supprimer/'.$sce["sce_code"].'"><i class="bi bi-bootstrap-reboot"></i></a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo "<br />";


            }else {
                    echo("<h3>Aucun Scenario pour le moment ! Repassez plus tard.</h3>");
            }
            ?>
    </div>

</div>

</section><!-- End Values Section -->
