<?php
    namespace App\Controllers;
    use App\Models\Db_model;
    use CodeIgniter\Exceptions\PageNotFoundException;
    class VICTOIRE extends BaseController
    {
        public function __construct(){
        //...
    }
    public function creer_participant($mail,$nom){
        $model = model(Db_model::class);
        $num=$model->check_participant($mail,$nom);
        if($num==0){
            return $model->add_participant($mail,$nom);
        }else{
            return $num;
        }

    }
    
    public function creer_victoire($num,$id,$diff){
        $model = model(Db_model::class);
        if($model->check_victoire($num,$id,$diff)){
            $model->update_victoire($num,$id,$diff);
        }else{
            $model->add_victoire($num,$id,$diff);
        }

    }

    public function finir($id,$diff){
        helper('form');
        $model = model(Db_model::class);
            if ($this->request->getMethod()=="post"){
            if (! $this->validate([
                'email' => 'required|max_length[100]',
                'nom' => 'required|max_length[80]',
            ],
            [ // Configuration des messages d’erreurs
                'email' => [
                    'required' => 'Veuillez entrer un mail !',
                    'max_length' => 'Le mail saisi est trop long !(Maximum: 100)',

                ],  
                 'nom' => [
                    'required' => 'Veuillez entrer un nom !',
                    'max_length' => 'Le nom saisi est trop long !(Maximum: 40)',

                ],     
            ]     
            ))
            { // La validation du formulaire a échoué, retour au formulaire !
                $data['titre'] = 'Well Done !';
                return view('templates/haut2',$data)
                . view('templates/menu_visiteur2.php')
                . view('finir_scenario')
                . view('templates/bas2');
            }
            // La validation du formulaire a réussi, traitement du formulaire
            //$data['erreur']='Wrong answer, try again !';
                $email=$this->request->getVar('email');
                $nom=$this->request->getVar('nom');
                $num=$this->creer_participant($email,$nom);
                $this->creer_victoire($num,$id,$diff);
                return redirect('/');
            }

    }

    
}