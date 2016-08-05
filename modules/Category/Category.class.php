<?php
namespace modules\Category;

class Category extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_category';
        $this->key = 'categoryid';
        $this->time = true;
        $this->fichetype = 'category';
        
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

    public function getSlug() {
        return '/category/'.$this->infos['categoryid'].'/'.$this->slug($this->infos['titre']);
    }

    public function getChildren() {
        $sql = 'SELECT '.implode(', ', array_keys($this->schema)).' FROM site_category WHERE category_parentid ='.$this->infos['categoryid'].' ORDER BY ordre';
        $result = $this->db->query($sql)or error('Impossible de récupérer les catégories enfant', __FILE__, __LINE__, $this->db->error());
        $categories = $this->getResults($result);

        $this->infos['children'] = $this->generateCollection($categories);
    }
}