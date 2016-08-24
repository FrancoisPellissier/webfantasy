<?php
namespace modules\Concours;

class ConcoursParticipant extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'form_participants';
        $this->key = 'userid';
        $this->fichetype = 'concours';
        $this->time = true;
        
        $this->schema = array(
        'userid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de participation'),
        'formid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du concours'),
        'email' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Adresse email'),
        'user_ip' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Adresse IP'),
        'all_right' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Bonnes réponses'),
        'subsidiaire' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Question subsidiaire'),
        'statut' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Statut de participation'),
        'ordre' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Ordre d affichage'),
        'nom' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom'),
        'prenom' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Prénom'),
        'adresse_1' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Adresse'),
        'adresse_2' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Complément d adresse'),
        'zipcode' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Code postal'),
        'city' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Ville'),
        'country' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Pays')
        );

    /*
    Les statuts utilisés sont les suivants :
    0 : Normal
    1 : Gagnant
    2 : Email
    3 : Retour
    4 : Reçu
    */
    }

    public function clean() {
        $fields = array('nom', 'prenom', 'adresse_1', 'adresse_2', 'city');

        foreach($fields AS $field) {
            $this->infos[$field] = mb_strtoupper($this->infos[$field]);
        }
    }

    public function sendEmail(Concours $concours) {
        $email = new \library\Email('concours_valid', 'WebFantasy - Concours '.$concours->infos['titre'], $this->infos['email']);
        $email->setVar('nom', $this->infos['nom']);
        $email->setVar('prenom', $this->infos['prenom']);
        $email->setVar('concours', $concours->infos['titre']);
        $email->setVar('date', $concours->infos['date_fin']);

        $email->send();
    }

    public function verif($concours, $request, $response) {
        // Captcha
        if($request->postData('verif') != 9) {
            $response->redirect($concours->getSlug().'/error/1');
        }
        // Réglement
        else if(!$request->postExists('lu')) {
            $response->redirect($concours->getSlug().'/error/2');
        }
        // Champs de coordonnées
        else {
            $fields = array('nom', 'prenom', 'adresse_1', 'zipcode', 'city');
            foreach($fields AS $field) {
                if(empty($this->infos[$field])) {
                    $response->redirect($concours->getSlug().'/error/3');
                }
            }
        }
    }
}