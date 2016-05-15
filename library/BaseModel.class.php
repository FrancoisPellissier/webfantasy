<?php
namespace library;

abstract class BaseModel {
    public $db;
    public $fichetype;
    public $table;
    public $key;
    public $schema;
    /**
     * Le schema doit être indiqué de la façon suivante :
     * 'fieldname' => 'fieldtype' => 'VARCHAR', 'INT', 'DATE', ...
     *             => 'required'  => true / false
     *             => 'default'   => '', NULL, 0, ...
     *             => 'publicname' =>
     */
    public $order;
    public $time;
    public $picture;
    public $infos;
    public $exists = false;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function all() {
        // On génère la liste des champs à récupérer
        $sql_fields = implode(', ', array_keys($this->schema));
        if($this->time)
            $sql_fields .= ', created_at, updated_at';

        $result = $this->db->query('SELECT '.$sql_fields.' FROM '.$this->table.($this->order != '' ? ' ORDER BY '.$this->order : ''))or error('Impossible tous les éléments de la table "'.$this->table.'"', __FILE__, __LINE__, $this->db->error());
        
        $all = array();
        if($this->db->num_rows($result)) {
            while($cur = $this->db->fetch_assoc($result)) {
                $all[$cur[$this->key]] = $cur;
            }
        }
        return $all;
    }

    public function exists($id, $track = false) {
        global $pun_user;
        
        // On génère la liste des champs à récupérer
        $sql_fields = implode(', ', array_keys($this->schema));
        if($this->time)
            $sql_fields .= ', created_at, updated_at';

        // Génération de la clause WHERE
        $where = 'WHERE '.$this->key.' = '.intval($id);

        // Il existe un lien avec les images ?
        if($picture) {
            // Génération d'une jointure avec la table image pour récupérer les informations...
        }

        // On teste l'existence en récupérant les informations de la table
        $result = $this->db->query('SELECT '.$sql_fields.' FROM '.$this->table.' '.$where)or error('Impossible de tester l\'existence dans la table "'.$this->table.'" pour la valeur "'.intval($id).'"', __FILE__, __LINE__, $this->db->error());
        
        if($this->db->num_rows($result)) {
            $cur = $this->db->fetch_assoc($result);
            $this->exists = true;
            $this->infos = $cur;
            
            // On enregistre la visite de cette "page" pour pouvoir faire des stats plus tard
            // L'info n'est pertinente que pour le fiche vu, pas pour la récupération dans le cadre d'un test d'existence
            if($track) {
                $this->db->query(Query::insert('stats_log', array('tablename' => $this->table, 'tableid' => $this->infos[$this->key], 'ip' => get_remote_address(), 'userid' => $pun_user['id']) , true));
            }
        }
        else 
           $this->exists = false;
    }

    public function getPages() {
        $types = array('auteur', 'cycle', 'livre');

        // Ne fonctionne que si la fiche existe et est dans la liste
        if($this->exists AND in_array($this->fichetype, $types)) {
            
            $result = $this->db->query('SELECT pageid, pagetitre FROM page WHERE fichetype = \''.$this->fichetype.'\' AND ficheid = '.intval($this->infos[$this->key]).' AND pageparentid = 0 ORDER BY ordre')or error('Impossible de récupérer les pages de la fiche "'.$this->table.' '.intval($id).'"', __FILE__, __LINE__, $this->db->error());
            
            $pages = array();
            if($this->db->num_rows($result)) {
                $pages[] = $this->db->fetch_assoc($result);
                }

            $this->infos['pages'] = $pages;
        }
        else {
            $this->infos['pages'] = array();
        }
    }

    public function hydrate($datas) {
        // On parcourt le schema pour insérer les données correspondant dans les data
        foreach($this->schema AS $field => $infos) {
            if(isset($datas[$field]))
                $this->infos[$field] = $datas[$field];
            }
        }
    }

    public function checkData($modiftype, $post, $errors) {
        $data = array();
        $error = array();
        
        /**
         * ATTENTION : NE PREND PAS EN COMPTE LE CAS DES CASES A COCHER
         */
        
        if($modiftype == 'insert') {
            foreach($this->schema AS $field => $fieldinfo) {
                if($fieldinfo['required'] && !isset($post[$field])) {
                    $error[] = 'Le champ '.$fieldinfo['publicname'].' est requis';
                }
                
                // On passe la clé
                if($field != $this->key) {
                    // On nettoie les données, et on met les valeurs par défaut quand il y a des manques
                    if($fieldinfo['fieldtype'] == 'VARCHAR') {
                        $data[$field] = pun_trim(isset($post[$field]) ? $post[$field] : $fieldinfo['default']);
                    }
                    else if($fieldinfo['fieldtype'] == 'INT') {
                        $data[$field] = intval(isset($post[$field]) ? $post[$field] : $fieldinfo['default']);
                    }
                    else if($fieldinfo['fieldtype'] == 'TEXT') {
                        $data[$field] = pun_trim(isset($post[$field]) ? $post[$field] : $fieldinfo['default']);
                    }
                    else if($fieldinfo['fieldtype'] == 'DATE') {
                        $data[$field] = pun_trim(isset($post[$field]) ? $post[$field] : $fieldinfo['default']);
                    }
                }
            }
        }
        else if($modiftype == 'update') {            
            foreach($this->schema AS $field => $fieldinfo) {
                // On ne modifie que les champs transmis
                if(isset($post[$field])) {
                    if($fieldinfo['fieldtype'] == 'VARCHAR') {
                        $data[$field] = pun_trim($post[$field]);
                    }
                    else if($fieldinfo['fieldtype'] == 'INT') {
                        $data[$field] = intval($post[$field]);
                    }
                    else if($fieldinfo['fieldtype'] == 'DATE') {
                        $data[$field] = $post[$field];
                    }
                    else if($fieldinfo['fieldtype'] == 'TEXT') {
                        $data[$field] = pun_trim(isset($post[$field]) ? $post[$field] : $fieldinfo['default']);
                    }
                }
            }     
        }
        return $data;
    }
    
    public function add() {
        $error = array();
        // On vérifie les données, les remplaçant par la valeur par défaut si besoin
        $datas = $this->checkData('insert', $this->infos, $error);
        
        // On insère les données en base
        $this->db->query(Query::insert($this->table, $datas, $this->time))or error('Impossible de créer la fiche dans la table : '.$this->table, __FILE__, __LINE__, $this->db->error());
        $id =  $this->db->insert_id();
        
        // On renvoit l'ID généré
        return $id;
    }

    public function edit($post, $get = array()) {
        // On vérifie les données, les remplaçant par la valeur par défaut si besoin
        $datas = $this->checkData('update', $post, $error);
        
        // On enregistre les modifications en base
        $this->db->query(Query::update($this->table, $datas, array($this->key => $this->infos[$this->key]), $this->time))or error('Impossible de modifier la fiche '.$this->infos[$this->key].' dans la table : '.$this->table, __FILE__, __LINE__, $this->db->error());
    }
}