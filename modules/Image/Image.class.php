<?php
namespace modules\Image;

class Image extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_image';
        $this->key = 'imageid';
        $this->time = true;
        
        $this->schema = array(
            'imageid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l image'),
            'categoryid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '0', 'publicname' => 'Categorie principale associée'),
            'titre' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre de l image'),
            'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Description de l image'),
            'folder' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Dossier de stockage'),
            'filename' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom du fichier')
        );
    }
}