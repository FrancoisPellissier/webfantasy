<?php
namespace modules\Page;

class Page extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_page';
        $this->key = 'pageid';
        $this->time = true;
        $this->fichetype = 'page';
        $this->picture = true;
        
        $this->schema = array(
        'pageid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de la page'),
        'page_parent_id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de la page parente'),
        'typepage' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Type de la page'),
        'ficheid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de la fiche associée'),
        'ordre' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Ordre de la page'),
        'titre' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre de la page'),
        'texte' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Contenu de la page'),
        'source' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Source de la page'),
        );
    }
}