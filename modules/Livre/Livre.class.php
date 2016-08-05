<?php
namespace modules\Livre;

class Livre extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_livre';
        $this->key = 'livreid';
        $this->time = true;
        $this->fichetype = 'livre';
        $this->picture = true;
        
        $this->schema = array(
        'livreid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l auteur'),
        'titre_vo' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre original'),
        'titre_vf' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre français'),
        'date_vo' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de sortie originale'),
        'date_vf' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de sortie française'),
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Présentation du livre'),
        'cycleid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle associé'),
        'cycleordre' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Ordre du livre dans le cycle'),
        );
    }

    public function getCycle() {
        $auteurid = $auteurid = $this->auteur->infos['auteurid'];

        // On récupère le cycle associé
        $cycle = new \modules\Cycle\Cycle();
        $cycle->exists($this->infos['cycleid']);
        $cycle->getAuteur();
        $cycle->getLivres();

        $this->infos['cycle'] = $cycle;
    }

    public function getEditions() {
        $editionCollection = new \modules\Edition\Edition();
        $sql = 'SELECT e.'.implode(', e.', array_keys($editionCollection->schema)).' FROM site_edition AS e INNER JOIN site_livre_edition AS le ON e.editionid = le.editionid AND le.livreid = '.$this->infos[$this->key] .' ORDER BY langid, datesortie DESC';

        $result = $this->db->query($sql)or error('Impossible de récupérer les éditions  de ce livre', __FILE__, __LINE__, $this->db->error());
        $editions = $this->getResults($result);

        $editionCollection = new \modules\Edition\Edition();
        $this->infos['editions'] = $editionCollection->generateCollection($editions);       
    }

    // Génération des sections de la sidebar
    public function sidebar($section, $cycleid = 0) {
        $auteurid = $this->auteur->infos['auteurid'];
        $items = array();

        if($section == 'main') {
            $baselink = $this->getSlug();

            $items[] = array(
                'href' => $baselink,
                'value' => 'Fiche'
            );

            $items[] = array(
                'href' => $baselink.'/edition',
                'value' => 'Editions'
            );

            // Affichage de la liste des catégories de 1er niveau
            if(isset($this->infos['categories'])) {
                foreach($this->infos['categories'] AS $page) {
                    $items[] = array(
                        'href' => $baselink.$page->getSlug(),
                        'value' => $page->infos['titre']
                    );
                }
            }

            /* **** TO DO
            ** A paramétrer si un topic d'avis existe (ou nouveau système s'il y a)
            */
            $items[] = array(
                'href' => $baselink.'',
                'value' => 'Avis'
            );

            // Affichage de la liste des pages de 1er niveau
            if(isset($this->infos['pages'])) {
                foreach($this->infos['pages'] AS $page) {
                    $items[] = array(
                        'href' => $baselink.$page->getSlug(),
                        'value' => $page->infos['titre']
                    );
                }
            }
        }
        else if($section == 'livre') {
            $baselink = 'livre/'.$auteurid.'/';
            
            if(isset($this->infos['cycle']->infos['livre'])) {
                foreach($this->infos['cycle']->infos['livre'] AS $livre) {
                    $items[] = array(
                        'href' => $baselink.$livre->getSlug(false),
                        'value' => $livre->infos['titre']
                    );
                }
            }
        }
        return $items;
    }

    public function getSlug($complete = true) {
        if($complete) {
            return 'livre/'.$this->auteur->infos['auteurid'].'/'.$this->infos['livreid'].'/'.$this->slug($this->infos['titre']);
        }
        else {
            return $this->infos['livreid'].'/'.$this->slug($this->infos['titre']);
        }
    }

    public function assocEdition($editionid) {
        $result = $this->db->query('INSERT IGNORE INTO site_livre_edition (livreid, editionid) VALUES('.$this->infos['livreid'].', '.intval($editionid).') ')or error('Impossible de lier auteur et edition', __FILE__, __LINE__, $this->db->error());
    }
}