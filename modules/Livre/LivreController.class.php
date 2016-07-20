<?php
namespace modules\Livre;

class LivreController extends \library\BaseController {
    public function getCommon() {
        $model = $this->exists();
        $auteurid = intval($this->request->getData('auteurid'));
        $model->getCycle($auteurid);

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $model->infos['titre']);
        $this->view->sidebarAdd('link', $model->sidebar('main', $auteurid));
        
        /* ** TO DO **
        ** A paramétrer en fonction cycle oui / non
        ** Si non, afficher "cycle du même auteur" ou "du même auteur"
        ** ** Fin du TO **
        */
        $this->view->sidebarAdd('title', 'Dans le même cycle');
        $this->view->sidebarAdd('link', $model->sidebar('livre', $auteurid));

        // Génération du nom de la page
        $this->view->setTitle($model->infos['titre']);

        return array($model, $view);
    }

    public function showLivre() {
        $common = $this->getCommon();
        $model = $common[0];
        $view = $common[1];

        $this->makeView();
    }

    public function showEditions() {

    }

    public function showPages() {

    }

    public function showPage() {
        
    }
}