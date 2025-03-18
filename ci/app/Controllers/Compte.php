<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Compte extends BaseController{
    public function __construct(){
        $this->db = db_connect(); //charger la base de données
        // ou
        // $this->db = \Config\Database::connect();
        helper('form');
    }
    public function lister(){
        helper('form');
        $model = model(Db_model::class);
            $session=session();
            if ($session->has('user') && $session->get('role')=='A'){
                $data['titre']="Comptes";
                $data['logins'] = $model->get_all_compte();
                $data['nb_compte'] = $model->get_nb_compte();
                return view('templates/haut2', $data)
                . view('templates/menu_administrateur.php')
                . view('affichage_comptes')
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
            if ($session->has('user') && $session->get('role')=='A'){
                // L’utilisateur a validé le formulaire en cliquant sur le bouton
                if ($this->request->getMethod()=="post"){
                    if (! $this->validate([
                        'pseudo' => 'required|max_length[50]|min_length[2]|',
                        'mdp' => 'required|max_length[50]|min_length[8]',
                        'statut' => 'required',
                        'role' => 'required'
                    ],
                    [ // Configuration des messages d’erreurs
                        'pseudo' => [
                            'required' => 'Veuillez entrer un pseudo pour le compte !',
                            'max_length' => 'Le pseudo saisi est trop long !(Maximum: 50)',
                            'min_length' => 'Le pseudo saisi est trop court !(Minimum: 8)',
                        ],
                        'mdp' => [
                            'required' => 'Veuillez entrer un mot de passe !',
                            'max_length' => 'Le mot de passe saisi est trop long !(Minimum: 50)',
                            'min_length' => 'Le mot de passe saisi est trop court !(Minimum: 8)',
                        ],        
                    ]           
                    )){
                        // La validation du formulaire a échoué, retour au formulaire !
                        return view('templates/haut2', ['titre' => 'Créer un compte'])
                        . view('templates/menu_administrateur')
                        . view('compte/compte_creer')
                        . view('templates/bas2');
                    }
                    // La validation du formulaire a réussi, traitement du formulaire
                    $recuperation = $this->validator->getValidated();
                    if($model->check_username($recuperation['pseudo'])){
                        $data['erreur']="Le Pseudo saisi existe déjà.";
                        $data['titre'] = 'Créer un compte';
                        return view('templates/haut2', $data)
                        . view('templates/menu_administrateur')
                        . view('compte/compte_creer')
                        . view('templates/bas2');
                    }
                    $model->set_compte($recuperation);
                    $data['le_compte']=$recuperation['pseudo'];
                    $data['le_message']="Nouveau nombre de comptes : ";
                    //Appel de la fonction créée dans le précédent tutoriel :
                    $data['le_total']=$model->get_nb_compte();
                    return redirect()->to('/compte/lister');
                }
                        // L’utilisateur veut afficher le formulaire pour créer un compte
                        return view('templates/haut2', ['titre' => 'Créer un compte'])
                        . view('templates/menu_administrateur')
                        . view('compte/compte_creer')
                        . view('templates/bas2');
            }else{
                        return view('templates/haut2', ['titre' => 'Se connecter'])
                . view('templates/menu_visiteur2')
                . view('connexion/compte_connecter')
                . view('templates/bas2');
            }
        }

    public function connecter(){
        $model = model(Db_model::class);
        if ($this->request->getMethod()=="post"){
        if (! $this->validate([
            'pseudo' => 'required',
            'mdp' => 'required'
        ],
        [ // Configuration des messages d’erreurs
            'pseudo' => [
                'required' => 'Veuillez entrer un pseudo pour le compte !',
            ],
            'mdp' => [
                'required' => 'Veuillez entrer un mot de passe !',

            ],        
        ]))
        { // La validation du formulaire a échoué, retour au formulaire !
        return view('templates/haut2', ['titre' => 'Se connecter'])
        . view('templates/menu_visiteur2')
        . view('connexion/compte_connecter')
        . view('templates/bas2');
        }
        // La validation du formulaire a réussi, traitement du formulaire
        $username=$this->request->getVar('pseudo');
        $password=$this->request->getVar('mdp');
        if ($model->connect_compte($username,$password)==true)
        {
            $session=session();
            $role=$model->get_role_compte($username);
            $session->set('user',$username);
            $session->set('role',$role->cpt_role);
                return view('templates/haut2',['titre' => 'Reussite'])
            . view('templates/menu_administrateur')
            . view('connexion/compte_accueil')
            . view('templates/bas2');
        }
        else
            { 
                $data['titre']='Se connecter';
                $data['erreur']='Les Identifiants saisis sont incorrects';
                return view('templates/haut2', $data)
                . view('templates/menu_visiteur2')
            . view('connexion/compte_connecter')
            . view('templates/bas2');
        }
        }
        return view('templates/haut2', ['titre' => 'Se connecter'])
        . view('templates/menu_visiteur2')
        . view('connexion/compte_connecter')
        . view('templates/bas2');
        }

    public function afficher_profil()
        {
        $model = model(Db_model::class);
        $session=session();
        if ($session->has('user'))
        {
        $data['titre']="Profil";
        $pfl=$session->get('user');
        $data['profil']=$model->get_compte($pfl);
        return view('templates/haut2',$data)
        . view('templates/menu_administrateur')
        . view('connexion/compte_profil')
        . view('templates/bas2');
        }
        else
        {
        return view('templates/haut2', ['titre' => 'Se connecter'])
        . view('templates/menu_visiteur2')
        . view('connexion/compte_connecter')
        . view('templates/bas2');
        }
        }

    public function deconnecter()
        {
        $session=session();
        $session->destroy();
        return view('templates/haut2', ['titre' => 'Se connecter'])
        . view('templates/menu_visiteur2')
        . view('connexion/compte_connecter')
        . view('templates/bas2');
        }


        public function changermotdepasse(){
            $model = model(Db_model::class);
            // L’utilisateur a validé le formulaire en cliquant sur le bouton
            $session=session();
            if ($session->has('user'))
            {
                if ($this->request->getMethod()=="post"){
                    if (! $this->validate([
                        'mdp' => 'required|max_length[50]|min_length[8]',
                        'mdpconfirmer' => 'required|max_length[50]|min_length[8]',
                    ],
                    [ // Configuration des messages d’erreurs
                        'mdp' => [
                            'required' => 'Veuillez entrer un mot de passe !',
                            'max_length' => 'Le mot de passe saisi est trop long !(Minimum: 50)',
                            'min_length' => 'Le mot de passe saisi est trop court !(Minimum: 8)',
        
                        ],
                        'mdpconfirmer' => [
                            'required' => 'Veuillez entrer un mot de passe !',
                            'max_length' => 'Le mot de passe saisi est trop long !(Minimum: 50)',
                            'min_length' => 'Le mot de passe saisi est trop court !(Minimum: 8)',
                        ],        
                    ]           
                    )){
                        // La validation du formulaire a échoué, retour au formulaire !
                        return view('templates/haut2', ['titre' => 'Changer de Mot de Passe'])
                        . view('templates/menu_administrateur')
                        . view('compte/mdp_changer')
                        . view('templates/bas2');
                    }
                    // La validation du formulaire a réussi, traitement du formulaire
                    $recuperation = $this->validator->getValidated();
                    $recuperation['pseudo']=$session->get('user');
                    if($recuperation['mdp']!=$recuperation['mdpconfirmer']){
                        $data['erreur']='Les deux mots de passe ne correspondent pas.';
                        $data['titre']='Les deux mots de passe ne correspondent pas.';
                        return view('templates/haut2',$data)
                        . view('templates/menu_administrateur')
                        . view('compte/mdp_changer')
                        . view('templates/bas2');
                    }else{
                        $model->change_password($recuperation);
                        return redirect()->to('/compte/profil');
                }
            }
                        // L’utilisateur veut afficher le formulaire pour créer un compte
                return view('templates/haut2', ['titre' => 'Changer de Mot de Passe'])
                . view('templates/menu_administrateur')
                . view('compte/mdp_changer')
                . view('templates/bas2');
            }
                    return view('templates/haut2', ['titre' => 'Se connecter'])
                . view('templates/menu_visiteur2')
                . view('connexion/compte_connecter')
                . view('templates/bas2');
        
    }

}