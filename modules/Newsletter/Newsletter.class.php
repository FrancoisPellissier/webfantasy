<?php
namespace modules\Newsletter;

class Newsletter extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'site_newsletter';
        $this->key = 'newsletterid';
        $this->fichetype = 'newsletter';
        $this->time = true;
        
        $this->schema = array(
        'domaine' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Domaine associé'),
        'email' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Adresse email')
        );
    }

    public function subscribe() {
        $this->db->query(\library\Query::insert($this->table, $this->infos, $this->time, true))or error('Impossible dinscrire l email', __FILE__, __LINE__, $this->db->error());
    }

    public function unsubscribe() {
        $this->db->query('DELETE FROM '.$this->table.' WHERE domaine = '.intval($this->infos['domaine']).' AND email = \''.$this->db->escape($this->infos['email']).'\'')or error('Impossible de désinscrire l email', __FILE__, __LINE__, $this->db->error());
    }
}