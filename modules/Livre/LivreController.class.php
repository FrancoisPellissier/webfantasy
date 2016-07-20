<?php
namespace modules\Livre;

class LivreController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();
        $auteurid = intval($this->request->getData('auteurid'));
        $this->model->getCycle($auteurid);

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $this->model->infos['titre']);
        $this->view->sidebarAdd('link', $this->model->sidebar('main', $auteurid));
        
        /* ** TO DO **
        ** A paramétrer en fonction cycle oui / non
        ** Si non, afficher "cycle du même auteur" ou "du même auteur"
        ** ** Fin du TO **
        */
        $this->view->sidebarAdd('title', 'Dans le même cycle');
        $this->view->sidebarAdd('link', $this->model->sidebar('livre', $auteurid));

        // Génération du nom de la page
        $this->view->setTitle($this->model->infos['titre']);
    }

    public function showLivre() {
        $this->getCommon();
        $this->makeView();
    }

    public function showEditions() {

    }

    public function showPages() {

    }

    public function showPage() {
        
    }
}