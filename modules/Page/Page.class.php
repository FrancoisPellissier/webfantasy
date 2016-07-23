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
        'extrait' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Extrait de la page'),
        'texte' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Contenu de la page'),
        'source' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Source de la page'),
        'traducteur' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Traducteur de la page'),
        'poster_id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du créateur de la page'),
        'publish_date' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de publication originale')
        );
    }

    public function exists($id, $track = false) {
        parent::exists($id, $track);

        if($this->exists) {
            $pageCollection = new \modules\Page\Page();
            $sql = 'SELECT pageid, titre FROM site_page WHERE page_parent_id = '.intval($id).' ORDER BY ordre';

            $result = $this->db->query($sql)or error('Impossible de récupérer les enfants de la page '.intval($id), __FILE__, __LINE__, $this->db->error());
            $pages = $this->getResults($result);

            $pageCollection = new \modules\Page\Page();
            $this->infos['childpages'] = $pageCollection->generateCollection($pages);
        }

    }
}