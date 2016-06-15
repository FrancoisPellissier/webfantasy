<?php
namespace modules\Category;

class Categorie extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_category';
        $this->key = 'categoryid';
        $this->time = true;
        
        $this->schema = array(
            'categoryid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '0', 'publicname' => 'ID de la catégorie'),
            'titre' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre de l image'),
            'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Description de l image'),
            'fichetype' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Type de fiche associée'),
            'ficheid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '0', 'publicname' => 'ID de la fiche associée'),
            'folder' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom du dossier physique'),
            'category_parentid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '0', 'publicname' => 'ID de la catégorie parente'),
            'ordre' => array('fieldtype' => 'INT', 'required' => false, 'default' => '0', 'publicname' => 'Ordre dans la catégorie parente'),
        );
    }
}