<?php
namespace modules\Domaine;

class Domaine extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_domaine';
        $this->key = 'domaine';
        $this->time = false;
        $this->fichetype = 'domaine';
        $this->picture = false;
        
        $this->schema = array(
        'domaine' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du domaine'),
        'auteur' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre du domaine')
        );
    }
}