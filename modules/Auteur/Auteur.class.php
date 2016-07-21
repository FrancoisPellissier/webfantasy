<?php
namespace modules\Auteur;

class Auteur extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_auteur';
        $this->key = 'auteurid';
        $this->fichetype = 'auteur';
        $this->time = true;
        
        $this->schema = array(
        'auteurid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l auteur'),
        'fullname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom complet de l auteur'),
        'firstname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Prénom'),
        'lastname' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom de famille'),
        'gender' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Genre (m/f)'),
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Présentation de l auteur')
        );
    }

    public function getCycles() {
        $cycleCollection = new \modules\Cycle\Cycle();
        $sql = 'SELECT c.'.implode(', c.', array_keys($cycleCollection->schema)).' FROM site_cycle AS c INNER JOIN site_cycle_auteur AS sca ON c.cycleid = sca.cycleid AND sca.auteurid ='.$this->infos['auteurid'].' ORDER BY sca.ordre';

        $result = $this->db->query($sql)or error('Impossible de récupérer les cycles de cet auteur', __FILE__, __LINE__, $this->db->error());
        $cycles = $this->getResults($result);

        $cycleCollection = new \modules\Cycle\Cycle();
        $this->infos['cycle'] = $cycleCollection->generateCollection($cycles);
    }

    public function getLivres() {

    }

    // Génération des sections de la sidebar
    public function sidebar($section) {
        $items = array();

        if($section == 'cycle') {
            $baselink = 'cycle/'.$this->infos['auteurid'].'/';
            

            if(isset($this->infos['cycle'])) {
                foreach($this->infos['cycle'] AS $cycle) {
                    $items[] = array(
                        'href' => $baselink.$cycle->infos['cycleid'].'/'.$this->slug($cycle->infos['titre']),
                        'value' => $cycle->infos['titre']
                    );
                }
            }
        }
        else if($section == 'page') {
            $baselink = 'auteur/'.$this->infos['auteurid'].'/'.$this->slug($this->infos['fullname']).'/';

            $items[] = array(
                'href' => $baselink.'page/1/interviews',
                'value' => 'Interviews'
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
        return $items;
    }
}