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

    public function getEditions() {
        $editions = array();
        if($this->exists) {
            $sql = 'SELECT editionid, titre, datesortie, nbpage
                FROM site_edition AS e
                INNER JOIN site_livre_edition AS le
                    ON e.editionid = le.editionid
                    AND le.livreid = '.$this->infos[$this->key] .'
                ORDER BY langid, datesortie DESC';

            $editions = $this->getResults($sql);
        }
        return $editions;
    }
}