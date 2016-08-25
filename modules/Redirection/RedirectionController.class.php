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
        if($this->request->getExists('id')) {
            $livreid = intval($this->request->getData('id'));
            $section = $this->request->getData('partie');
        }
        else {
            $livreid = intval($this->request->getData('livreid'));
            $section = $this->request->getData('section');
        }
        
        $livre = new \modules\Livre\Livre();
        $livre->exists($livreid);
        $livre->auteur->infos['auteurid'] = $this->configLivreAuteur($livre->infos['livreid']);

        // Redirection
        $this->response->permanentRedirect($livre->getSlug().$this->cleanSection($section));

    }

    public function livrePage() {
        if($this->request->getExists('id')) {
            $livreid = intval($this->request->getData('id'));
            $pageid = $this->request->getData('pageid');
        }
        else {
            $livreid = intval($this->request->getData('livreid'));
            $pageid = $this->request->getData('pageid');
        }
        
        $livre = new \modules\Livre\Livre();
        $livre->exists($livreid);
        $livre->auteur->infos['auteurid'] = $this->configLivreAuteur($livre->infos['livreid']);

        $page = new \modules\Page\Page();
        $page->exists($pageid);

        // Redirection
        $this->response->permanentRedirect($livre->getSlug().$page->getSlug());
    }

    public function configLivreAuteur($livreid) {
        $convert = array(1 => 1, 2 => 1, 3 => 1, 4 => 1, 5 => 1, 6 => 1, 7 => 1, 8 => 1, 9 => 1, 10 => 1, 11 => 1, 12 => 1, 13 => 1, 14 => 1, 15 => 1, 16 => 2, 17 => 2, 18 => 2, 19 => 2, 20 => 2, 21 => 3, 22 => 3, 23 => 3, 24 => 3, 25 => 3, 26 => 3, 27 => 3, 28 => 3, 29 => 3, 30 => 3, 31 => 3, 32 => 3, 33 => 3, 34 => 3, 35 => 3, 36 => 3, 37 => 3, 38 => 3, 39 => 1, 40 => 1, 41 => 3, 42 => 3, 43 => 3, 44 => 3, 45 => 3, 46 => 3, 47 => 3, 48 => 1, 49 => 3, 50 => 2, 51 => 3, 52 => 3, 53 => 1, 54 => 3, 55 => 3, 56 => 3, 57 => 3, 58 => 1, 59 => 3, 60 => 3);

        return intval($convert[$livreid]);
    }

}