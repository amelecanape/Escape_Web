<?php
namespace App\Models;
use CodeIgniter\Model;

class Db_model extends Model{
    protected $db;
    public function __construct(){
        $this->db = db_connect(); //charger la base de données
        // ou
        // $this->db = \Config\Database::connect();
    }


//----------------------------------------------------------Comptes----------------------------------------------------------//

    //Renvoie la liste de tout les comptes activés ou désactivés
    //Utilisé pour compte/lister
    public function get_all_compte(){
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt ORDER BY cpt_statut, cpt_date;");
        return $resultat->getResultArray();
    }

    //Renvoie l'id d'un compte à partir de son pseudo
    //Utilisé pour avoir l'auteur des scenarios notamment.
    public function get_id_compte($compte){
        $login=htmlspecialchars(addslashes($compte));
        $resultat = $this->db->query("SELECT cpt_id FROM t_compte_cpt WHERE cpt_pseudo='".$login."';");
        return $resultat->getRow();
    }

    //Renvoie toutes les informations d'un compte à partir de son pseudo
    public function get_compte($pseudo){
        $login=htmlspecialchars(addslashes($pseudo));
        $resultat = $this->db->query("SELECT * FROM t_compte_cpt WHERE cpt_pseudo='".$login."'");
        return $resultat->getRow();
    }

    //Renvoie le nombre de comptes dans la BDDR
    //Utilisé dans compte/lister
    public function get_nb_compte(){
        $requete="SELECT COUNT(cpt_id) AS nb FROM t_compte_cpt";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    //Crée un compte dans la base de données a partir des informations saisies par l'utilisateur
    //Est utilisé lors de la création d'un compte par un administrateur
    public function set_compte($saisie){
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $login=htmlspecialchars(addslashes($saisie['pseudo']));
        $mot_de_passe=htmlspecialchars(addslashes($saisie['mdp']));
        $statut=htmlspecialchars(addslashes($saisie['statut']));
        $role=htmlspecialchars(addslashes($saisie['role']));
        $sql="INSERT INTO t_compte_cpt VALUES(NULL,'".$login."',sha2('".$mot_de_passe."LESELCBIENJADORE"."',256),'".$role."','".$statut."', CURDATE());";
        return $this->db->query($sql);
    }

    //Renvoie vrai si le coupe pseudo/mdp existe dans la base, faux sinon.
    //Est utilisé pour l'authentification lors de la connexion
    public function connect_compte($pseudo,$password){
        $login=htmlspecialchars(addslashes($pseudo));
        $mdp=htmlspecialchars(addslashes($password));
        $sql="SELECT cpt_pseudo,cpt_mdp FROM t_compte_cpt WHERE cpt_pseudo='".$login."' AND cpt_mdp=sha2('".$mdp."LESELCBIENJADORE',256);";
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    //Renvoie vrai si le pseudo est dans la base de donnée, faux sinon
    //Est utilisé pour empecher la présence de deux pseudos identiques
    public function check_username($pseudo){
        $login=htmlspecialchars(addslashes($pseudo));
        $sql="SELECT cpt_pseudo FROM t_compte_cpt WHERE cpt_pseudo='".$login."'";
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    //Renvoie le role (O ou A) du compte lié au pseudo
    // Est utilisé pour charger la bonne version du back office selon le role de l'utilisateur
    public function get_role_compte($pseudo){
        $login=htmlspecialchars(addslashes($pseudo));
        $sql="SELECT cpt_role FROM t_compte_cpt WHERE cpt_pseudo='".$login."';";
        $resultat=$this->db->query($sql);
        return $resultat -> getRow();
    }
    public function change_password($saisie){
        $login=htmlspecialchars(addslashes($saisie['pseudo']));
        $mot_de_passe=htmlspecialchars(addslashes($saisie['mdp']));
        $sql="UPDATE t_compte_cpt SET cpt_mdp=sha2('".$mot_de_passe."LESELCBIENJADORE',256) WHERE cpt_pseudo='".$login."';";
    }
    
//----------------------------------------------------------Actualités----------------------------------------------------------//

    //Renvoie les informations de l'actualité dont l'id est passé en paramètres
    public function get_actualite($numero){
        $requete="SELECT * FROM t_actualite_act WHERE act_id=".$numero.";";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
        }

    //Renvoie tout les 5 dernières actualités de la BDD publiées    /!\UTILISATION DE LA VIEW 'actualite'
    public function get_all_actualite(){
        // $requete="SELECT act_titre, act_texte, act_date, cpt_pseudo FROM t_actualite_act JOIN t_compte_cpt USING(cpt_id) WHERE act_statut='P' LIMIT 5";
        $requete='SELECT * FROM actualite';
        $resultat = $this->db->query($requete);
            return $resultat->getResultArray();
        }

//----------------------------------------------------------Scenarii----------------------------------------------------------//

    //Renvoie le nombre de scenarios dans la base de données
    //Utilisé dans la page scenario/lister
    public function get_nb_scenario(){
        $requete="SELECT COUNT(sce_id) AS nb FROM t_scenario_sce";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    //Renvoie les informations du scenario lié au code est passé en paramètre.
    //Utilisé dans la page scenario/lister
    public function get_scenario($code){
        $code=htmlspecialchars(addslashes($code));
        $requete="SELECT * FROM t_scenario_sce WHERE sce_code='".$code."'";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    //Créé un scénario avec les informations passé en paramètre
    //Utilisé lors de la création d'un scenario par un organisateur
    public function set_scenario($titre,$intitule,$statut,$nomfichier,$id){
        //Récuparation (+ traitement si nécessaire) des données du formulaire
        $titre=htmlspecialchars(addslashes($titre));
        $texte=htmlspecialchars(addslashes($intitule));
        $statut=htmlspecialchars(addslashes($statut));
        $nomfichier=htmlspecialchars(addslashes($nomfichier));
        $id=htmlspecialchars(addslashes($id));
        $sql="INSERT INTO t_scenario_sce VALUES(NULL, 'code', '".$titre."','".$texte."','".$statut."', '".$nomfichier."', '".$id."', NULL );";
        return $this->db->query($sql);
    }

    //Renvoie vrai si le scenario lié au code $scenario a été fait par l'auteur lié a l'id passé au paramètre, fax sino,
    //Utilisé dans la page scenario/lister
    public function compare_auteur($scenario,$id){
        $code=htmlspecialchars(addslashes($scenario));
        $sql="SELECT sce_id FROM t_scenario_sce JOIN t_compte_cpt USING(cpt_id) WHERE sce_code='".$code."' AND cpt_id=".$id;
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0){
            return true;
        }
        else{
            return false;
        }

    }


    //Supprime dans l'ordre: les indices, les participations, les étapes puis le scénario lui même lié au code passé en paramètre.
    //Utilisé dans la page scenario/supprimer
    public function delete_scenario($code){
        $code=htmlspecialchars(addslashes($code));
        $sql="DELETE FROM t_indice_ind WHERE ind_id IN(SELECT ind_id FROM t_etape_eta JOIN t_scenario_sce USING(sce_id) WHERE sce_code='".$code."');";
        $resultat=$this->db->query($sql);
        $sql="DELETE FROM t_victoire_vct WHERE sce_id IN(SELECT sce_id FROM t_scenario_sce WHERE sce_code='".$code."');";
        $resultat=$this->db->query($sql);
        $sql="UPDATE t_scenario_sce SET sce_debut=NULL WHERE sce_code='".$code."';";
        $this->db->query($sql);
        $sql="DELETE FROM t_etape_eta WHERE eta_id IN (SELECT eta_id FROM t_etape_eta JOIN t_scenario_sce USING(sce_id) WHERE sce_code='".$code."');";
        $resultat=$this->db->query($sql);
        $sql="DELETE FROM t_scenario_sce WHERE sce_code='".$code."';";
        $resultat=$this->db->query($sql);

    }

    //Renvoie tout les scenarii PUBLIÉS de la base de données
    //Utilisé dans la gallerie des scénarios
    public function get_all_scenario(){
        $requete="SELECT sce_code, sce_titre, sce_texte, sce_image, cpt_pseudo FROM t_scenario_sce JOIN t_compte_cpt USING(cpt_id) WHERE sce_statut='P'";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    //Renvoie tout les scenarii PUBLIÉS OU NON de la base de données
    //Utilisé dans la page scenario/lister
    public function get_all_scenario_ignore_status(){
        $requete="SELECT sce_code, sce_titre, sce_texte, sce_image,sce_statut, cpt_pseudo, nb_etapes(sce_id) AS nb FROM t_scenario_sce JOIN t_compte_cpt USING(cpt_id)";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }


    //Renvoie vraie si une ressource (liée a un scenario ou dans la table ressource) a le même nom que la nom de ressource passé en paramètre, faux sinon
    //Utilisé pour l'upload d'une ressource pendant la création d'un scenario
    public function check_ressource($f){
        $f=htmlspecialchars(addslashes($f));
        $sql="SELECT sce_id FROM t_scenario_sce WHERE sce_image='".$f."'";
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0){
            return true;
        }
        else{
            $sql="SELECT rsc_id FROM t_ressource_rsc WHERE rsc_chemin='".$f."'";
            $resultat=$this->db->query($sql);
            if($resultat->getNumRows() > 0){
                return true;
            }
            else{
                return false;
            }
        }
    }
//----------------------------------------------------------Etapes----------------------------------------------------------//

    //Renvoie la première étape du scenarios passé en paramètre, avec les indices correspondant a la difficulté passée en paramètre
    //Utilisé dans scenario/jouer/...
    public function get_premiere_etape($code,$diff){
        $code=htmlspecialchars(addslashes($code));
        $requete="SELECT * FROM t_scenario_sce LEFT JOIN t_etape_eta ON t_scenario_sce.sce_id=t_etape_eta.sce_id LEFT JOIN t_ressource_rsc ON t_ressource_rsc.rsc_id=t_etape_eta.rsc_id LEFT JOIN t_indice_ind ON t_etape_eta.eta_id=t_indice_ind.eta_id AND ind_niveau=".$diff." WHERE t_scenario_sce.sce_code='".$code."'AND t_etape_eta.eta_id=t_scenario_sce.sce_debut"; 
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    //Renvoie tout les étapes d'un scénario
    //Utilisé dans scenario/visualiser
    public function get_all_etape($code){
        $code=htmlspecialchars(addslashes($code));
        $requete="SELECT * FROM t_etape_eta JOIN t_scenario_sce USING(sce_id) LEFT JOIN t_ressource_rsc USING(rsc_id) WHERE sce_code='".$code."'";
        $resultat = $this->db->query($requete);
        return $resultat->getResultArray();
    }

    //Renvoie le code d'une étape à partir de son id
    //Utilisé dans franchir_etapes 
    public function get_code_etape($id){
        $requete="SELECT eta_code FROM t_etape_eta WHERE eta_id='".$id."'";
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    //Renvoie les informatios d'une étape à partir de son code, avec les indices correspondant a la difficulté passée en paramètre
    //Utilisé dans franchir_etapes
    public function get_etape($code,$diff){
        $code=htmlspecialchars(addslashes($code));
        $requete="SELECT * FROM t_etape_eta LEFT JOIN t_ressource_rsc ON t_ressource_rsc.rsc_id=t_etape_eta.rsc_id LEFT JOIN t_indice_ind ON t_etape_eta.eta_id=t_indice_ind.eta_id AND ind_niveau=".$diff." WHERE t_etape_eta.eta_code='".$code."'"; 
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }

    //Renvoie l'indice de la première étape d'un scénario
    //Non Utilisée
    public function get_indice_premiere_etape($code,$diff){
        $requete="SELECT ind_niveau, ind_texte, ind_lien FROM t_scenario_sce JOIN t_etape_eta USING(sce_id)JOIN t_indice_ind USING(eta_id) WHERE sce_code='".$code."' AND eta_id=sce_debut AND ind_niveau=".$diff;
        $resultat = $this->db->query($requete);
        return $resultat->getRow();
    }



//---------------------------------------------------------Victoire----------------------------------------------------------//

    //Regarde si un participant existe dans la table participants à partir de son mail et de son nom. Renvoie son id si oui, 0 sinon.
    //Utilisé dans finir_scenario
    public function check_participant($mail,$nom){
        $mail=htmlspecialchars(addslashes($mail));
        $nom=htmlspecialchars(addslashes($nom));
        $sql="SELECT prt_id FROM t_participant_prt WHERE prt_adresse='".$mail."' AND prt_nom='".$nom."';";
        $resultat=$this->db->query($sql);
        if($resultat->getNumRows() > 0){
            $res=$resultat -> getRow();
            return $res->prt_id;
        }
        else{
            return 0;
        }
    }

    //Ajoute un participant à la table participants avec les infomations passées en paramètres. Renvoie l'id du participant créé
    //Utilisé dans finir_scenario
    public function add_participant($mail,$nom){
        $mail=htmlspecialchars(addslashes($mail));
        $nom=htmlspecialchars(addslashes($nom));
        $sql="INSERT INTO t_participant_prt VALUES(NULL,'".$mail."','".$nom."')";
        $resultat=$this->db->query($sql);
        $sql="SELECT prt_id FROM t_participant_prt WHERE prt_adresse='".$mail."' AND prt_nom='".$nom."';";
        $resultat=$this->db->query($sql);
        $res=$resultat -> getRow();
        return $res->prt_id;
    }

    //Regarde si un participant a dejà fini un scénario. Renvoie vrai si oui, faux sinon.
    //Utilisé dans finir_scenario
    public function check_victoire($num,$id){
        $sql="SELECT * FROM t_victoire_vct WHERE sce_id='".$id."' AND prt_id='".$num."';";
        $resultat=$this->db->query($sql);

        if($resultat->getNumRows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    //Ajoute une victoire d'un participant à un scenario avec une difficulté (tout les trois passés en paramètre)
    //Utilisé dans finir_scenario
    public function add_victoire($num,$id,$diff){
        $sql="INSERT INTO t_victoire_vct VALUES('".$id."','".$num."',CURDATE(),CURDATE(),".$diff.")";
        return $this->db->query($sql);
    }

    //Met à jour une victoire d'un participant à un scenario avec une difficulté (tout les trois passés en paramètre) et met le champs denière victoire à la date aujourd'hui
    //Utilisé dans finir_scenario
    public function update_victoire($num,$id,$diff){
        $sql="UPDATE t_victoire_vct SET vct_dernierevic=CUDATE(), vct_niveau=".$diff." WHERE sce_id='".$id."' AND prt_id='".$num."';";
        return $this->db->query($sql);
    }
}