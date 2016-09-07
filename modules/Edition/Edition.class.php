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

    public function sortieExists($domaine, $version) {
        $sql = 'SELECT
            e.titre,
            e.datesortie,
            l.livreid,
            l.titre_vo,
            l.titre_vf,
            i.title AS t_title,
            i.folder AS t_folder,
            i.filename AS t_filename
            FROM site_edition AS e
            INNER JOIN site_livre_edition AS le
                ON e.editionid = le.editionid
                AND e.editionid = '.$domaine->infos['edition'.$version.'id'].'
            INNER JOIN site_livre AS l
                ON le.livreid = l.livreid
            INNER JOIN site_livre_auteur AS la
                ON l.livreid = la.livreid
                AND la.auteurid = '.$domaine->infos['domaine'].'
            LEFT JOIN site_image AS i
                ON e.pictureid = i.imageid';

        $result = $this->db->query($sql)or error('Impossible de récupérer l edition', __FILE__, __LINE__, $this->db->error());
        if($this->db->num_rows($result)) {
            $this->exists = true;
            $cur = $this->db->fetch_assoc($result);
            $this->hydrate($cur);
            $this->setImage($cur);

            $livre = new \modules\Livre\Livre();
            $livre->hydrate($cur);
            $livre->setTitreUsuel();
            $livre->auteur->infos['auteurid'] = $domaine->infos['domaine'];
            $this->infos['livre'] = $livre;
        }
        else {
            $this->exists = false;
            }
    }

    public function sidebar() {
        if($this->exists) {
            $texte = '<a href="'.$this->infos['livre']->getSlug().'"><img src="'.$this->infos['image']->getUrl('thumbnail').'" /></a>'.$this->infos['date_sortie'];
            $texte .= '<br /><br />'.\library\Date::nextSortie($this->infos['datesortie']);
            return $texte;
        }
        else {
            return '';
        }
        // <img title="Prochaine sortie originale : Death\'s Mistress" src="http://www.terrygoodkind.fr/img/terrygoodkind/livres/edition/miniature/196_Deaths_Mistress.jpg" /><br /><br />10 janvier 2017 / J -192 jours'
        // '<img title="Prochaine sortie française : le Coeur de la Guerre" src="http://www.terrygoodkind.fr/img/terrygoodkind/livres/edition/miniature/190_Le_Coeur_de_la_Guerre.jpg" /><br /><br />18 novembre 2015'
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

    public function generateCollection($datas, $auteur = null) {
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