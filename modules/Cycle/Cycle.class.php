<?php
namespace modules\Cycle;

class Cycle extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_cycle';
        $this->key = 'cycleid';
        $this->time = true;
        $this->fichetype = 'cycle';
        $this->picture = true;
        
        $this->schema = array(
        'cycleid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle'),
        'titre_vo' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre original'),
        'titre_vf' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre français'),
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Présentation du cycle'),
        'cycleparentid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle parent si existe')
        );
    }

    public function getLivres($auteurid = 0) {
        $livreCollection = new \modules\Livre\Livre();
        $auteurid = intval($auteurid);
       
        /* ** TO DO **
        ** Trier par date de sortie VO en plus de cycleordre
        ** ** Fin du TO **
        */

        // Présence d'un auteurid ?
        if($auteurid != 0) {
            $sql = 'SELECT l.'.implode(', l.', array_keys($livreCollection->schema)).' FROM site_livre AS l INNER JOIN site_livre_auteur AS sla ON l.livreid = sla.livreid AND l.cycleid ='.$this->infos['cycleid'].' AND sla.auteurid = '.$auteurid.' ORDER BY l.cycleordre, titre_vo';
        }
        else  {
            $sql = 'SELECT l.'.implode(', l.', array_keys($livreCollection->schema)).' FROM site_livre AS l WHERE l.cycleid ='.$this->infos['cycleid'].' ORDER BY l.cycleordre, titre_vo';
        }

        $result = $this->db->query($sql)or error('Impossible de récupérer les livres de ce cycle', __FILE__, __LINE__, $this->db->error());
        $cycles = $this->getResults($result);

        $livreCollection = new \modules\Livre\Livre();
        $this->infos['livre'] = $livreCollection->generateCollection($cycles); 
    }

    // Génération des sections de la sidebar
    public function sidebar($section, $auteurid = 0) {
        $items = array();

        if($section == 'main') {
            $baselink = 'cycle/'.$auteurid.'/'.$this->infos['cycleid'].'/'.$this->slug($this->infos['titre']);

            $items[] = array(
                'href' => $baselink,
                'value' => 'Fiche'
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
            
            if(isset($this->infos['livre'])) {
                foreach($this->infos['livre'] AS $livre) {
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