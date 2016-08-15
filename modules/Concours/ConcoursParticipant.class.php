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
}