<?php
namespace modules\Edition;

class Edition extends \library\BaseModel {
    public $formats;
    public $langs;

    public function __construct() {
        parent::__construct();
        $this->table = 'site_edition';
        $this->key = 'editionid';
        $this->time = true;
        $this->picture = true;

        $this->formats = array();
        $this->langs = array();
        
        $this->schema = array(
        'editionid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l edition'),
        'titre' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre de l edition'),
        'langid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Langue'),
        'datesortie' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de sortie'),
        'publisher' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Editeur'),
        'illustrateur' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Illustrateur'),
        'formatid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Format'),
        'nbpage' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Nb de page')
        );
    }

    public function getLangs() {
        $sql = 'SELECT langid, langname FROM site_langue ORDER BY langname';
        
        $result = $this->db->query($sql)or error('Impossible de récupérer le listing des langues', __FILE__, __LINE__, $this->db->error());
        
        while($cur = $this->db->fetch_assoc($result)) {
            $this->langs[$cur['langid']] = $cur['langname'];
        }
    }

    public function getFormats() {
        $sql = 'SELECT formatid, formatname FROM site_format ORDER BY formatname';
        
        $result = $this->db->query($sql)or error('Impossible de récupérer le listing des formats', __FILE__, __LINE__, $this->db->error());
       
        while($cur = $this->db->fetch_assoc($result)) {
            $this->formats[$cur['formatid']] = $cur['formatname'];
        }
    }

    public function generateCollection($datas) {
        $collection = array();
        $this->getLangs();
        $this->getFormats();

        foreach($datas AS $data) {
            $model = new Edition();
            $model->hydrate($data);

            $model->infos['langname'] = $this->langs[$model->infos['langid']];
            $model->infos['formatname'] = $this->formats[$model->infos['formatid']];

            $image = new \modules\Image\Image();
            $image->hydrate($data);
            $model->infos['image'] = $image;

            $collection[$model->infos[$this->key]] = $model;
        }
        return $collection;
    }
}