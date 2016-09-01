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
        'auteur' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre du domaine'),
        'forum_desc' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Description pour le forum'),
        'editionvoid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de la prochaine sortie VO'),
        'editionvfid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de la prochaine sortie VF')
        );
    }
}