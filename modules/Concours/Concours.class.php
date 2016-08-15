<?php
namespace modules\Concours;

class Concours extends \library\BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'form';
        $this->key = 'formid';
        $this->fichetype = 'concours';
        $this->time = true;
        $this->test = false;
        
        $this->schema = array(
        'formid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du concours'),
        'titre' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom du concours'),
        'titre_forum' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre pour le forum'),
        'description' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Description'),
        'partenaire' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Editeur partenaire'),
        'exemplaires' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Nombre d exemplaires en jeu'),
        'date_debut' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de début'),
        'date_fin' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de fin'),
        'date_sortie' => array('fieldtype' => 'DATE', 'required' => false, 'default' => '', 'publicname' => 'Date de sortie'),
        'participants' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Nombre de participants')
        );
    }

    public function exists($id, $track = false) {        
        global $pun_user;

        if(isset($_GET['test'])) {
            $this->test = true;
        }

        // On génère la liste des champs à récupérer
        $sql_fields = 't.'.implode(', t.', array_keys($this->schema));

        // On teste l'existence en récupérant les informations de la table
        $result = $this->db->query('SELECT '.$sql_fields.' FROM '.$this->table.' AS t WHERE t.'.$this->key.' = '.intval($id).($this->test ? '' : ' AND CURDATE() BETWEEN date_debut AND date_fin'))or error('Impossible de tester l\'existence dans la table "'.$this->table.'" pour la valeur "'.intval($id).'"', __FILE__, __LINE__, $this->db->error());
        
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

    public function listAll() {
        $sql = 'SELECT '.implode(', ', array_keys($this->schema)).' FROM form WHERE date_debut <= CURDATE() ORDER BY date_debut DESC';
        $result = $this->db->query($sql)or error('Impossible de récupérer les concours', __FILE__, __LINE__, $this->db->error());
        $concours = $this->getResults($result);

        $concoursCollection = new \modules\Concours\Concours();
        return $concoursCollection->generateCollection($concours);
    }

    public function getSlug() {
        if($this->test) {
            return 'concours/test/'.$this->infos['formid'].'/'.$this->slug($this->infos['titre']);
        }
        else  {
            return 'concours/'.$this->infos['formid'].'/'.$this->slug($this->infos['titre']);
        }
    }

    public function getQuestions() {
        $sql = 'SELECT q.questionid, q.libelle AS qlib, q.answerid AS good_anwer, a.answerid, a.libelle AS alib FROM form_question AS q INNER JOIN form_answer AS a ON q.questionid = a.questionid AND q.formid = '.$this->infos['formid'].' ORDER BY q.ordre, a.ordre';
        $result = $this->db->query($sql)or error('Impossible de récupérer les questions/réponses du concours', __FILE__, __LINE__, $this->db->error());

        $qa = array();
        while($cur = $this->db->fetch_assoc($result)) {
            // Question
            $qa[$cur['questionid']]['libelle'] = $cur['qlib'];
            $qa[$cur['questionid']]['good'] = $cur['good_anwer'];
            $qa[$cur['questionid']]['answer'][$cur['answerid']] = $cur['alib'];
        }
        
        $this->infos['question'] = $qa;
    }

    public function checkAnswer($datas) {
        $this->getQuestions();
        $is_allright = '1';
        foreach($this->infos['question'] AS $id => $cur) {
            if(isset($datas[$id])) {
                if($datas[$id] != $cur['good']) {
                    $is_allright = '0';
                }
            }
            else {
                $is_allright = '0';
            }
        }
        return $is_allright;
    }

    public function saveAnswer($userid, $datas) {
        foreach($datas AS $questionid => $answerid) {
            $data = array(
                'questionid' => $questionid,
                'userid' => $userid,
                'answerid' => $answerid,
                'formid' => $this->infos['formid']);
            
            $sql = \library\Query::insert('form_user_answer', $data);
            $this->db->query($sql)or error('Impossible d enregistrer la réponse', __FILE__, __LINE__, $this->db->error());
        }
    }
}