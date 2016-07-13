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

    public function getLivres() {
        
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
                        'href' => $baselink.'/'.$page->infos['pageid'].'/'.$this->slug($page->infos['titre']),
                        'value' => $page->infos['titre']
                    );
                }
            }
        }
        else if($section == 'livre') {
            $baselink = 'livre/'.$this->infos['auteurid'].'/';
            
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