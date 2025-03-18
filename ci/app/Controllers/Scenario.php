<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Scenario extends BaseController
{
    public function __construct(){
        //...
    }
    public function afficher(){
                $model = model(Db_model::class);
                $data['titre'] = 'Scenarii ';
                $data['scenario'] = $model->get_all_scenario();
                    return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('affichage_scenario')
                . view('templates/bas2');
    }

    public function lister(){
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        if ($session->has('user') && $session->get('role')=='O'){
            $data['titre'] = 'Gestion des Scenarii ';
            $data['scenario'] = $model->get_all_scenario_ignore_status();
            $data['nb_scenario'] = $model->get_nb_scenario();
                return view('templates/haut2',$data)
            . view('templates/menu_administrateur.php')
            . view('liste_scenario')
            . view('templates/bas2');
        }else{
            return view('templates/haut2', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur2')
            . view('connexion/compte_connecter')
            . view('templates/bas2');
        }
    }

    public function jouer($code = '',$diff = 0){
        helper('form');
        $model = model(Db_model::class);
            if ($this->request->getMethod()=="post"){
            if (! $this->validate([
                'reponse' => 'required',
            ],
            [ // Configuration des messages d’erreurs
                'reponse' => [
                    'required' => 'Veuillez entrer une réponse !',
                ],     
            ]     
            ))
            { // La validation du formulaire a échoué, retour au formulaire !
                $data['etape'] = $model->get_premiere_etape($code,$diff);
                $data['titre'] = 'Esc@pe Web - Jouer ';
                return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('affichage_etape')
                . view('templates/bas2');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            $reponse=$this->request->getVar('reponse');
            $etape=$model->get_premiere_etape($code,$diff);
            if ($reponse==$etape->eta_reponse)
            {
            return redirect()->to('/scenario/franchir/'.$model->get_code_etape($etape->eta_suiv)->eta_code.'/'.$diff);    
            }
            else
                {
                $data['erreur']='Wrong answer, try again !';
                $data['etape'] = $model->get_premiere_etape($code,$diff);
                $data['titre'] = 'Esc@pe Web - Jouer ';
                return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('affichage_etape')
                . view('templates/bas2');
            }
            }
            $data['etape'] = $model->get_premiere_etape($code,$diff);
            $data['titre'] = 'Esc@pe Web - Jouer ';
            //$data['indice'] = $model->get_indice_premiere_etape($code,$diff);
            return view('templates/haut2',$data)
            . view('templates/menu_visiteur2.php')
            . view('affichage_etape')
            . view('templates/bas2');
    }

    public function franchir_etape($code = '',$diff = 0){
        helper('form');
        $model = model(Db_model::class);
            if ($this->request->getMethod()=="post"){
            if (! $this->validate([
                'reponse' => 'required',
            ],
            [ // Configuration des messages d’erreurs
                'reponse' => [
                    'required' => 'Veuillez entrer une réponse !',
                ],     
            ]     
            ))
            { // La validation du formulaire a échoué, retour au formulaire !
                $data['etape'] = $model->get_etape($code,$diff);
                $data['titre'] = 'Esc@pe Web - Jouer ';
                return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('franchir_etape')
                . view('templates/bas2');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            //$data['erreur']='Wrong answer, try again !';

            $reponse=$this->request->getVar('reponse');
            $etape=$model->get_etape($code,$diff);
            if ($reponse==$etape->eta_reponse)
            {
                if($etape->eta_suiv!=null){
                    return redirect()->to('/scenario/franchir/'.$model->get_code_etape($etape->eta_suiv)->eta_code.'/'.$diff);
                }else{
                $data['titre'] = 'Well Done ! ';
                $data['etape'] = $etape;
                return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('finir_scenario')
                . view('templates/bas2');
                }
            }
            else
                {
                $data['erreur']='Wrong answer, try again !';
                $data['etape'] = $model->get_etape($code,$diff);
                $data['titre'] = 'Esc@pe Web - Jouer ';
                return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('franchir_etape')
                . view('templates/bas2');
            }
            }
            $data['etape'] = $model->get_etape($code,$diff);
            $data['titre'] = 'Esc@pe Web - Jouer ';
            //$data['indice'] = $model->get_indice_premiere_etape($code,$diff);
            return view('templates/haut2',$data)
            . view('templates/menu_visiteur2.php')
            . view('franchir_etape')
            . view('templates/bas2');
    }


    public function visualiser($code){
        $model = model(Db_model::class);
        $session=session();
        if ($session->has('user') && $session->get('role')=='O'){
            $data['titre'] = 'Visualisation du Scenario ';
            $data['etapes'] = $model->get_all_etape($code);
            $data['scenario'] = $model->get_scenario($code);
                return view('templates/haut2',$data)
            . view('templates/menu_administrateur.php')
            . view('scenario_visualiser')
            . view('templates/bas2');
        }else{
            return view('templates/haut2', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur2')
            . view('connexion/compte_connecter')
            . view('templates/bas2');
        }
    }

    public function creer(){
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        if ($session->has('user') && $session->get('role')=='O'){
            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            if ($this->request->getMethod()=="post"){
                if (! $this->validate([
                    'titre' => 'required|max_length[150]',
                    'intitule' => 'required|max_length[500]',
                    'statut' => 'required',
                    'fichier' => [
                        'label' => 'Fichier image',
                        'rules' => [
                        'uploaded[fichier]',
                        'is_image[fichier]',
                        'mime_in[fichier,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[fichier,100]',
                        'max_dims[fichier,1024,768]',
                        ]]      
                ],
                [ // Configuration des messages d’erreurs
                    'titre' => [
                        'required' => 'Veuillez entrer un titre !',
                        'max_length' => 'Le pseudo saisi est trop long !(Maximum: 150)',
                    ],
                    'intitule' => [
                        'required' => 'Veuillez entrer un texte !',
                        'max_length' => "L'intitule saisi est trop long !(Maximum: 500)",
                    ],     
                ]           
                )){
                    // La validation du formulaire a échoué, retour au formulaire !
                    return view('templates/haut2', ['titre' => 'Créer un scenario'])
                    . view('templates/menu_administrateur')
                    . view('scenario_creer')
                    . view('templates/bas2');
                }
                // La validation du formulaire a réussi, traitement du formulaire
                    //$recuperation = $this->validator->getValidated();
                    $titre=$this->request->getVar('titre');
                    $intitule=$this->request->getVar('intitule');
                    $statut=$this->request->getVar('intitule');
                    $fichier=$this->request->getFile('fichier');
                    if(!empty($fichier)){
                    // Récupération du nom du fichier téléversé
                        $nom_fichier=$fichier->getName();
                    // Dépôt du fichier dans le répertoire ci/public/images
                        if(!$model->check_ressource($nom_fichier)){
                            if($fichier->move("ressource",$nom_fichier)){
                                $id=$model->get_id_compte($session->get('user'));
                                $id=$id->cpt_id;
                                $model->set_scenario($titre,$intitule,$statut,$nom_fichier,$id);
                                return redirect()->to('/scenario/lister');
                            }   
                        }else{
                            $data['titre']='Créer un Scenario';
                            $data['erreur']='Une image avec ce nom existe deja, veuillez renommer votre fichier';
                            return view('templates/haut2', $data)
                        . view('templates/menu_administrateur')
                        . view('scenario_creer')
                        . view('templates/bas2');

                        }
                    }    
            }
                    // L’utilisateur veut afficher le formulaire pour créer un scenario
                    return view('templates/haut2', ['titre' => 'Créer un Scenario'])
                    . view('templates/menu_administrateur')
                    . view('scenario_creer')
                    . view('templates/bas2');
        }else{
                    return view('templates/haut2', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur2')
            . view('connexion/compte_connecter')
            . view('templates/bas2');
        }
    }

    public function supprimer($code){
        helper('form');
        $model = model(Db_model::class);
        $session=session();
        $id=$model->get_id_compte($session->get('user'));
        $id=$id->cpt_id;
        if ($session->has('user') && $session->get('role')=='O' && $model->compare_auteur($code,$id) ){
            if ($this->request->getMethod()=="post"){
                    $model->delete_scenario($code);
                    return redirect()->to('/scenario/lister');
            }else{
                // L’utilisateur veut afficher le formulaire pour créer un scenario
                $data['titre']='Supprimer un Scenario';
                $data['code']=$code;
                return view('templates/haut2', $data)
                . view('templates/menu_administrateur')
                . view('scenario_supprimer')
                . view('templates/bas2');
            }         
        }else{
                    return view('templates/haut2', ['titre' => 'Se connecter'])
            . view('templates/menu_visiteur2')
            . view('connexion/compte_connecter')
            . view('templates/bas2');
        }
    }

}