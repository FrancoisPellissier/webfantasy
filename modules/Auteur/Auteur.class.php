<?php
namespace modules\Auteur;

class Auteur extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'auteur';
        $this->key = 'auteurid';
        $this->time = true;
        
        $this->schema = array(
        'auteurid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l auteur'),
        'fullname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom complet de l auteur')
        );
    }

    public function getCycles() {

    }

    public function getLivres() {

    }
}