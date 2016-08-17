<?php
namespace modules\Actualite;

class ActualiteComment extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'pun_posts';
        $this->key = 'id';
        $this->time = false;
        $this->fichetype = 'actualite';
        $this->picture = false;
        
        $this->schema = array(
        'id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du topic'),
        'poster' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Redacteur'),
        'message' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Message'),
        'posted' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Timestamp du commentaire')
        );
    }
}