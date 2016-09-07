<?php
namespace modules\User;

class User extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'pun_user';
        $this->key = 'id';
        $this->time = true;
        
        $this->schema = array(
        'id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => ''),
        'group_id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => ''),
        'username' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => ''),
        'email' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => ''),
        'is_guest' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => ''),
        'g_moderator' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => ''),
        'is_admmod' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => '')
        );
    }

    public function checkRight() {
        if($this->infos['is_admmod']) {
            return true;
        }
        else {
            return false;
        }
    }
}