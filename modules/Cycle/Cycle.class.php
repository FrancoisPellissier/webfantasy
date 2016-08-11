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
        'cycleparentid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du cycle parent si existe'),
        'is_cycle' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Cycle ou juste groupement de livres')
        );
    }

    public function getLivres() {
        $livreCollection = new \modules\Livre\Livre();
        $auteurid = $this->auteur->infos['auteurid'];
        $image = new \modules\Image\Image();
       
        // Présence d'un auteurid ?
        if($auteurid != 0) {
            $sql = 'SELECT l.'.implode(', l.', array_keys($livreCollection->schema)).', i.'.implode(', i.', array_keys($image->schema)).' FROM site_livre AS l INNER JOIN site_livre_auteur AS sla ON l.livreid = sla.livreid AND l.cycleid = '.$this->infos['cycleid'].' AND sla.auteurid = '.$auteurid.' LEFT JOIN site_image AS i ON i.imageid = l.pictureid  ORDER BY l.cycleordre, date_vo, date_vf';
        }
        else  {
            $sql = 'SELECT l.'.implode(', l.', array_keys($livreCollection->schema)).', i.'.implode(', i.', array_keys($image->schema)).' FROM site_livre AS l LEFT JOIN site_image AS i ON i.imageid = l.pictureid  WHERE l.cycleid = '.$this->infos['cycleid'].' ORDER BY l.cycleordre, date_vo, date_vf';
        }
        $result = $this->db->query($sql)or error('Impossible de récupérer les livres de ce cycle', __FILE__, __LINE__, $this->db->error());
        $cycles = $this->getResults($result);

        $livreCollection = new \modules\Livre\Livre();
        $this->infos['livre'] = $livreCollection->generateCollection($cycles, $this->auteur);
    }

    // Génération des sections de la sidebar
    public function sidebar($section) {
        $auteurid = $this->auteur->infos['auteurid'];
        $items = array();

        if($section == 'main') {
            $baselink = $this->getSlug();

            $items[] = array(
                'href' => $baselink,
                'value' => 'Fiche'
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
            
            if(isset($this->infos['livre'])) {
                foreach($this->infos['livre'] AS $livre) {
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
            return 'cycle/'.$this->auteur->infos['auteurid'].'/'.$this->infos['cycleid'].'/'.$this->slug($this->infos['titre']);
        }
        else  {
            return $this->infos['cycleid'].'/'.$this->slug($this->infos['titre']);
        }
    }

    public function getCycles($auteurid = 0) {
        // Présence d'un auteurid ?
        if($auteurid != 0) {
            $sql = $sql = 'SELECT c.cycleid, IF(c.titre_vf = \'\', c.titre_vo, c.titre_vf) AS titre FROM site_cycle AS c INNER JOIN site_cycle_auteur AS sc ON sc.cycleid = c.cycleid AND sc.auteurid = '.intval($auteurid).' ORDER BY titre';
        }
        else  {
            $sql = 'SELECT cycleid, IF(titre_vf = \'\', titre_vo, titre_vf) AS titre FROM site_cycle ORDER BY titre';
        }

        $result = $this->db->query($sql)or error('Impossible de récupérer les cycles', __FILE__, __LINE__, $this->db->error());
        $cycles = array();

        while($cur = $this->db->fetch_assoc($result)) {
                $cycles[$cur['cycleid']] = $cur['titre'];
            }

        return $cycles;
    }
}