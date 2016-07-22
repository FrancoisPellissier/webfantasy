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
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Présentation du livre'),
        'cycleid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle associé'),
        'cycleordre' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Ordre du livre dans le cycle'),
        );
    }

    public function getCycle($auteurid = 0) {
        // On récupère le cycle associé
        $cycle = new \modules\Cycle\Cycle();
        $cycle->exists($this->infos['cycleid']);
        $cycle->getLivres();

        $this->infos['cycle'] = $cycle->infos;
    }

    public function getEditions() {
        $editions = array();
        if($this->exists) {
            $sql = 'SELECT e.editionid, e.titre, e.datesortie, e.nbpage
                FROM site_edition AS e
                INNER JOIN site_livre_edition AS le
                    ON e.editionid = le.editionid
                    AND le.livreid = '.$this->infos[$this->key] .'
                ORDER BY langid, datesortie DESC';

            $result = $this->db->query($sql)or error('Impossible de récupérer les éditions du livre '.$this->infos[$this->key], __FILE__, __LINE__, $this->db->error());
            $editions = $this->getResults($result);
        }
        return $editions;
    }

    // Génération des sections de la sidebar
    public function sidebar($section, $auteurid = 0, $cycleid = 0) {
        $items = array();

        if($section == 'main') {
            $baselink = 'livre/'.$auteurid.'/'.$this->infos['livreid'].'/'.$this->slug($this->infos['titre']);

            $items[] = array(
                'href' => $baselink,
                'value' => 'Fiche'
            );

            $items[] = array(
                'href' => $baselink.'/edition',
                'value' => 'Editions'
            );

            /* **** TO DO
            ** A paramétrer si une galerie existe
            */
            $items[] = array(
                'href' => $baselink.'',
                'value' => 'Galerie'
            );

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
                        'href' => $baselink.'/page/'.$page->infos['pageid'].'/'.$this->slug($page->infos['titre']),
                        'value' => $page->infos['titre']
                    );
                }
            }
        }
        else if($section == 'livre') {
            $baselink = 'livre/'.$auteurid.'/';
            
            if(isset($this->infos['cycle']['livre'])) {
                foreach($this->infos['cycle']['livre'] AS $livre) {
                    $items[] = array(
                        'href' => $baselink.$livre->infos['livreid'].'/'.$this->slug($livre->infos['titre']),
                        'value' => $livre->infos['titre']
                    );
                }
            }
        }
        return $items;
    }
}