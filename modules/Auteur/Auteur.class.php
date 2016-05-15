<?php
namespace modules\Auteur;

class Auteur extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_auteur';
        $this->key = 'auteurid';
        $this->fichetype = 'auteur';
        $this->time = true;
        
        $this->schema = array(
        'auteurid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l auteur'),
        'fullname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom complet de l auteur'),
        'firstname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Prénom'),
        'lastname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom de famille'),
        'gender' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Genre (m/f)'),
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Présentation de l auteur')
        );
    }

    public function getCycles() {

    }

    public function getLivres() {

    }
}