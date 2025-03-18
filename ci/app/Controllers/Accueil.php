<?php
namespace App\Controllers;
use App\Models\Db_model;
use CodeIgniter\Exceptions\PageNotFoundException;
class Accueil extends BaseController
{
    public function __construct(){
        //...
    }
    public function afficher(){
        $model = model(Db_model::class);
        $data['titre'] = 'Es@pe Web';
        $data['news'] = $model->get_all_actualite();
            return view('templates/haut2',$data)
        . view('templates/menu_visiteur2.php')
        . view('affichage_accueil')
        . view('templates/bas2');
    }

    public function test(){
        $model = model(Db_model::class);
        $data['titre'] = 'Actualités :';
        $data['news'] = $model->get_all_actualite();
            return view('templates/haut2',$data)
        . view('templates/menu_visiteur2.php')
        . view('affichage_accueil')
        . view('templates/bas2');
    }
}