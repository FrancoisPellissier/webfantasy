<?php
namespace modules\Actualite;

class Actualite extends \library\BaseModel {
    public $annee, $mois;

    public function __construct() {
        parent::__construct();
        $this->table = 'pun_topics';
        $this->key = 'id';
        $this->time = false;
        $this->fichetype = 'actualite';
        $this->picture = false;
        
        $this->schema = array(
        'id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du topic'),
        'poster' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Redacteur'),
        'subject' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Sujet'),
        'message' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Message'),
        'posted' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'Timestamp du topic'),
        'first_post_id' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID du premier message')
        );
    }

    public function exists($id, $track = false) {        
        global $pun_user;

        // On teste l'existence en récupérant les informations de la table
        $result = $this->db->query('SELECT t.id, t.poster, t.`subject`, t.posted, p.message, t.first_post_id FROM pun_topics AS t INNER JOIN pun_posts AS p ON t.first_post_id = p.id AND t.id = p.topic_id AND t.id = '.intval($id))or error('Impossible de tester l\'existence dans la table "'.$this->table.'" pour la valeur "'.intval($id).'"', __FILE__, __LINE__, $this->db->error());
        
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

    public function getLast() {
        $sql = 'SELECT t.id, t.poster, t.`subject`, t.posted, p.message FROM pun_topics AS t INNER JOIN pun_posts AS p ON t.first_post_id = p.id AND t.id = p.topic_id AND t.forum_id = 164 ORDER BY t.posted DESC LIMIT 10';
        $result = $this->db->query($sql)or error('Impossible de récupérer les actualités', __FILE__, __LINE__, $this->db->error());
        $actualites = $this->getResults($result);
        return $this->generateCollection($actualites);
    }

    public function getComments() {
        $sql = 'SELECT id, poster, posted, message FROM pun_posts WHERE topic_id = '.$this->infos['id'].' AND id != '.$this->infos['first_post_id'].' ORDER BY posted';
        $result = $this->db->query($sql)or error('Impossible de récupérer les actualités', __FILE__, __LINE__, $this->db->error());
        
        $comment = new \library\ForumPost();
        $comments = $this->getResults($result);
        $this->infos['comments'] = $comment->generateCollection($comments);
    }

    public function formatDate() {
        return '';
    }

    public function getLivres() {
    
        $result = $this->db->query($sql)or error('Impossible de récupérer les livres de ce cycle', __FILE__, __LINE__, $this->db->error());
        $cycles = $this->getResults($result);

        $livreCollection = new \modules\Livre\Livre();
        $this->infos['livre'] = $livreCollection->generateCollection($cycles, $this->auteur);
    }

    public function getSlug() {
        return 'actualite/'.$this->infos['id'].'/'.$this->slug($this->infos['subject']);
    }

    public function getMonths() {
        $sql = 'SELECT FROM_UNIXTIME(posted, \'%Y-%m\') AS periode, FROM_UNIXTIME(posted, \'%Y\') As annee, FROM_UNIXTIME(posted, \'%c\') AS mois FROM pun_topics WHERE forum_id = 164 GROUP BY periode ORDER BY periode DESC';
        $result = $this->db->query($sql)or error('Impossible de récupérer la liste des mois', __FILE__, __LINE__, $this->db->error());
        return $this->getResults($result);
    }

    public function getArchive() {
        $sql = 'SELECT t.id, t.poster, t.`subject`, t.posted, p.message FROM pun_topics AS t INNER JOIN pun_posts AS p ON t.first_post_id = p.id AND t.id = p.topic_id AND t.forum_id = 164 AND FROM_UNIXTIME(t.posted, \'%Y\') = '.intval($this->annee).' AND FROM_UNIXTIME(t.posted, \'%c\') = '.intval($this->mois).'  ORDER BY t.posted';

        $result = $this->db->query($sql)or error('Impossible de récupérer les actualités', __FILE__, __LINE__, $this->db->error());
        $actualites = $this->getResults($result);
        return $this->generateCollection($actualites);
    }

    public function getDate($request) {
        $this->annee = intval($request->getData('annee'));
        $this->mois = intval($request->getData('mois'));

        if($this->annee == 0 || $this->mois == 0) {
            $this->annee = date('Y');
            $this->mois = date('n');
        }
    }

    public function getSlugDate() {
        return date('Y/n', $this->infos['posted']);
    }
}