<?php
namespace modules\Image;

class Image extends \library\BaseModel {
    public $sizes;

    public function __construct() {
        parent::__construct();
        $this->table = 'site_image';
        $this->key = 'imageid';
        $this->time = true;
        $this->fichetype = 'image';
        
        $this->schema = array(
            'imageid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '', 'publicname' => 'ID de l image'),
            'categoryid' => array('fieldtype' => 'INT', 'required' => false, 'default' => '0', 'publicname' => 'Categorie principale associée'),
            'title' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Titre de l image'),
            'commentaire' => array('fieldtype' => 'TEXT', 'required' => false, 'default' => '', 'publicname' => 'Description de l image'),
            'folder' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Dossier de stockage'),
            'filename' => array('fieldtype' => 'VARCHAR', 'required' => false, 'default' => '', 'publicname' => 'Nom du fichier')
        );

        $this->sizes['thumbnail'] = array('width' => 130, 'height' => 130);
        $this->sizes['small'] = array('width' => 200, 'height' => 300);
        $this->sizes['medium'] = array('width' => 600, 'height' => 800);
        $this->sizes['large'] = array('width' => 1000, 'height' => 1333);
    }

    // Génération du lien
    public function getUrl($size) {
        $url = $this->infos['folder'].'/'.$size.'/'.$this->infos['filename'];
        if(file_exists($url)) {
            return $url;
        }
        else {
            return 'img/default_'.$size.'.jpg';
        }
    }

    // Migration temporaire
    public function migrate() {
        if(substr($this->infos['folder'], 0, 2) == './') {
            if(substr($this->infos['folder'], -4) != '.jpg')
                $url = str_replace('/./', '/', 'http://www.terrygoodkind.fr/galerie/'.$this->infos['folder'].$this->infos['filename']);
            else
                $url = str_replace('/./', '/', 'http://www.terrygoodkind.fr/galerie/'.$this->infos['folder']);

            $source = $this->infos['filename'];
            copy($url, 'img/upload/'.$source);

            $this->infos['folder'] = 'img/'.$this->infos['categoryid'];
            $this->infos['filename'] =  $this->infos['imageid'].'_'.$source;
            $this->edit();

            $this->generateFolders($this->infos['folder'] );
            $this->imageResize('img/upload/'.$source, $this->infos['folder'] .'/original/', $this->infos['filename'], 0, 0, true);
            foreach($this->sizes AS $name => $size) {
                $this->imageResize('img/upload/'.$source, $this->infos['folder'] .'/'.$name, $this->infos['filename'], $size['width'], $size['height']);
            }
            $this->cleanUpload('img/upload/'.$source);
        }
    }

    // Hydratation temporaire
    public function hydrate($data) {
        parent::hydrate($data);
        $this->migrate();
    }

    // Ajout d'une image
    public function addImage($files, \modules\Category\Category $category) {
        $filename = $this->slug($this->infos['titre']).'.jpg';
        $source = 'img/upload/'. $filename;
        $error = $this->imageUpload($files, $filename);

        // L'image est bien téléchargée ? On la traite
        if(!$error) {
            // Création de l'image en base
            $this->infos['folder'] = $category->infos['folder'];
            $this->infos['categoryid'] = $category->infos['categoryid'];
            $this->infos['filename'] = $filename;

            $imageid = $this->add();
            $this->infos['imageid'] = $imageid;
            $this->infos['filename'] = $imageid.'_'.$this->infos['filename'];
            $this->edit();

            // Gestion des dossiers
            $this->generateFolders($category->infos['folder']);
            // Taille originale
            $this->imageResize($source, $category->infos['folder'].'/original/', $this->infos['filename'], 0, 0, true);

            // Formats pré-définis
            foreach($this->sizes AS $name => $size) {
                $this->imageResize($source, $category->infos['folder'].'/'.$name, $this->infos['filename'], $size['width'], $size['height']);
            }

            // Association image/catégorie
            $this->assocCategory($category->infos['categoryid']);
        }
        $this->cleanUpload($source);
    }

    // Gestion des images uploadées
    public function imageUpload($files, $filename) {
        $error = false;

        if(isset($files['req_file']) AND $files['req_file']['error'] == 0) {
            $infosfichier = pathinfo($files['req_file']['name']);
            $extension_upload = $infosfichier['extension'];

            $extensions_autorisees = array('jpg', 'jpeg', 'JPG', 'JPEG');
            
            if (!in_array($extension_upload, $extensions_autorisees)) {
                $error = 1;
            }
            else {
                if(file_exists('img/upload'.$filename)) {
                    unlink('img/upload/'.$filename);
                }

                if(!move_uploaded_file($files['req_file']['tmp_name'], 'img/upload/'.$filename)) {
                    $error = 2;
                }
            }
        }
        else
            $error = 3;

        return $error;
    }

    // Gestion des dossiers par taille
    public function generateFolders($folder) {
        // Le dossier n'existe pas ?
        if(!file_exists($folder.'/index.html')) {
            // Création du dossier racine 
            mkdir($folder, 0777, true);
            $this->copyIndex($folder);

            // Création du dossier 'taille originale'
            mkdir($folder.'/original', 0777, true);
            $this->copyIndex($folder.'/original');

            // Création des dossiers par dimension
            foreach($this->sizes AS $size => $dim) {
                mkdir($folder.'/'.$size, 0777, true);
                $this->copyIndex($folder.'/'.$size);
            }
        }
    }

    // Définion des dimensions pour le redimensionnement
    public function defineSize($width, $height, $max_width, $max_height) {
        if(($width > $max_width && $max_width != 0) || ($height > $max_height && $max_height != 0)) {
            // Définition des ratios
            $ratio = $width / $height;
            $ratio_dest = $max_width / $max_height;
            
            // Calcul des dimensions
            $size = array();

            if($ratio > $ratio_dest) {
                $size['width'] = $max_width;
                $size['height'] = intval($max_width / $ratio);
            }
            else {
                $size['width'] = intval($max_height * $ratio);
                $size['height'] = $max_height;
            }
        }
        else {
            $size['width'] = $width;
            $size['height'] = $height;
        }

        return $size;
    }

    // Redimensionnement physique de l'image
    public function imageResize($source, $folder, $filename, $width, $height, $iso = false) {
        $source = imagecreatefromjpeg($source);

        $width_source = imagesx($source);
        $height_source = imagesy($source);

        // Sans redimensionnement
        if($iso) {
            $width = $width_source;
            $height = $height_source;
        }

        // Définition des dimensions
        $size = $this->defineSize($width_source, $height_source, $width, $height);

        $image = imagecreatetruecolor($size['width'], $size['height']);
        imagecopyresampled($image, $source, 0, 0, 0, 0, $size['width'], $size['height'], $width_source, $height_source);
        
        imagedestroy($source);

        // Suppression l'image de destination si elle existe
        if(file_exists($folder.'/'.$filename))
            unlink($folder.'/'.$filename);

        // Enregistrement de l'image redimensionnée
        imagejpeg($image, $folder.'/'.$filename, 100);

        imagedestroy($image);
    }

    // Suppression de l'image du dossier Uploads
    public function cleanUpload($filename) {
        if(file_exists($filename)) {
            unlink($filename);
        }
    }

    public function copyIndex($folder){
        if(!file_exists($folder.'/index.html'))
            copy('img/index.html', $folder.'/index.html');  
    }

    public function assocCategory($categoryid) {
        $result = $this->db->query('INSERT IGNORE INTO site_image_category (categoryid, imageid) VALUES('.intval($categoryid).', '.$this->infos['imageid'].') ')or error('Impossible de lier image et catégorie', __FILE__, __LINE__, $this->db->error());
    }
}