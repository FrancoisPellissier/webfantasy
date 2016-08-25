<?php
namespace modules\Redirection;

class RedirectionController extends \library\BaseController {

    public function cleanSection($section) {
        switch($section) {
            case 'fiche':
                return '';
                break;
            case 'editions':
                return '/edition';
                break;
            default:
                return '/'.$section;
        }
    }

    /*
    ([a-z]+)-([0-9]+)-[A-Za-z_]+-tome_([0-9]+)-[A-Za-z_]+.html
    ivres.php?cid=$2&tid=$3&partie=$1
    */
    public function livreTome() {
        if($this->request->getExists('cid')) {
            $cycleid = intval($this->request->getData('cid'));
            $tome = intval($this->request->getData('tid'));
            $section = $this->request->getData('partie');
        }
        else {
            $cycleid = intval($this->request->getData('cycleid'));
            $tome = intval($this->request->getData('tome'));
            $section = $this->request->getData('section');
        }
        
        $livre = new \modules\Livre\Livre();
        $livre->getRedirectTome($cycleid, $tome);
        $livre->auteur->infos['auteurid'] = $this->configLivreAuteur($livre->infos['livreid']);

        // Redirection
        $this->response->permanentRedirect($livre->getSlug().$this->cleanSection($section));
    }

    public function livreId() {

    }

    public function configLivreAuteur($livreid) {
        $convert = array(1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1); // ....

        return intval($convert[$livreid]);
    }

}