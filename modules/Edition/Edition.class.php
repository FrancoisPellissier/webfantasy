<?php
namespace modules\Edition;

class Edition extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'edition';
        $this->key = 'editionid';
        $this->time = true;
        
        $this->schema = array(
        'editionid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l edition'),
        'titre' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre de l edition'),
        'langid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Langue'),
        'datesortie' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de sortie'),
        'publisherid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Editeur',
        'formatid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Format'
        'nbpage' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Nb de page'
        );
    }
}