<div class style="height:90px;"></div>

    <section id="values" class="values">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <h2>Administration</h2>
    <p>Liste des comptes</p>
  </header>

  <div class="actualites" data-aos="fade-up" style="box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08); padding:20px; border-radius:5px;">
        <?php
            if (! empty($logins) && is_array($logins))
            {
                echo "<h2>Nombre de comptes:  ".$nb_compte->nb."</h2>";
                echo "<a href='https://obiwan.univ-brest.fr/~e22103034/index.php/compte/creer' target='_blank'><h2>+</h2></a></li>";
                echo "<br />";
                echo '<table class="table ">';
                echo '<tr style="background-color:#f2f5fc;">';
                echo '<th style="background-color:#f2f5fc;">Pseudo</th> <th style="background-color:#f2f5fc;">Rôle</th> <th style="background-color:#f2f5fc;">Statut</th> <th style="background-color:#f2f5fc;">Création</th>';
                echo '</tr>';
                
                foreach ($logins as $pseudos){
                    echo '<tr>';
                    echo '<td > '.$pseudos["cpt_pseudo"].'</td>';
                    echo '<td>';
                    if ($pseudos["cpt_role"]=='O'){
                        echo 'Organisteur';
                    }else{
                        echo 'Administrateur';
                    }
                    echo '</td>';
                    echo '<td>';
                    if ($pseudos["cpt_statut"]=='A'){
                        echo 'Activé';
                    }else{
                        echo 'Désactivé';
                    }
                    echo '</td>';
                    //echo '<td>'.$pseudos["cpt_role"].'</td>';
                    //echo '<td>'.$pseudos["cpt_statut"].'</td>';
                    echo '<td>'.$pseudos["cpt_date"].'</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo "<br />";


            }else {
                    echo("<h3>Aucune compte pour le moment ! Repassez plus tard.</h3>");
            }
            ?>
    </div>

</div>

</section><!-- End Values Section -->
    <?php
    /*echo "<a href='https://obiwan.univ-brest.fr/~e22103034/index.php/compte/creer' target='_blank'><h2>+</h2></a></li>";

    if (! empty($logins) && is_array($logins)) {
        echo "Nombre de comptes:  ".$nb_compte->nb;
        foreach ($logins as $pseudos){
            echo "<br />";
            echo " -- ";
            echo $pseudos["cpt_pseudo"];
            echo " -- ";
            echo $pseudos["cpt_statut"];
            echo "<br />";
        }    
    }else {
            echo("<h3>Aucun compte pour le moment</h3>");
    }*/
    ?>
