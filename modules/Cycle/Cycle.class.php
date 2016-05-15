<?php
namespace modules\Cycle;

class Cycle extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'cycle';
        $this->key = 'cycleid';
        $this->time = true;
        $this->picture = true;
        
        $this->schema = array(
        'cycleid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle'),
        'titre_vo' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre original'),
        'titre_vf' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre français'),
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Présentation du cycle'),
        'cycleparentid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle parent si existe')
        );
    }

    public function getLivres() {
        
    }
}