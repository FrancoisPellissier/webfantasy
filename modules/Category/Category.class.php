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

    public function getImages() {
        $image = new \modules\Image\Image();
        $sql = 'SELECT i.'.implode(', i.', array_keys($image->schema)).' FROM site_image AS i INNER JOIN site_image_category AS ic ON ic.imageid = i.imageid AND ic.categoryid = '.$this->infos['categoryid'].' ORDER BY i.created_at DESC';
        $result = $this->db->query($sql)or error('Impossible de récupérer les images de cette catégorie', __FILE__, __LINE__, $this->db->error());
        $images = $this->getResults($result);

       $this->infos['images'] = $image->generateCollection($images);
    }

    public function getPrevNext($imageid) {
        if(!isset($this->infos['images'])) {
            $this->getImages();
        }

        $prev = '';
        $next = false;

        foreach($this->infos['images'] AS $image) {
            if($next) {
                $this->infos['next'] = $image;
                $next = false;
            }
            else if($image->infos['imageid'] == $imageid) {
                if($prev != '') {
                    $this->infos['previous'] = $prev;
                    $prev = '';
                }

                $next = true;
            }
            $prev = $image;
        }
    }

    public function setDefaultOrder() {
        $result = $this->db->query('SELECT IFNULL(MAX(ordre), 0) AS ordre FROM site_category WHERE category_parentid = '.intval($this->infos['category_parentid']).' AND fichetype =\''.$this->db->escape($this->infos['fichetype']).'\' AND ficheid = '.intval($this->infos['ficheid']))or error('Impossible de récupérer le dernier ordre', __FILE__, __LINE__, $this->db->error()); 
        $cur = $this->db->fetch_assoc($result);
        $this->infos['ordre'] = $cur['ordre'] + 1;
    }

    public function setFolder() {
        $this->infos['folder'] = 'img/'.intval($this->infos[$this->key]);
    }

    public function add() {
        $id = parent::add();
        $this->exists($id);
        $this->setDefaultOrder();
        $this->setFolder();
        $this->edit();
    }
}