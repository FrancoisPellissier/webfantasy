<?php
namespace modules\Livre;

class LivreController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();
        $auteurid = intval($this->request->getData('auteurid'));
        $this->model->getCycle($auteurid);

        // Information de l'auteur
        $auteur = new \modules\Auteur\Auteur();
        $auteur->exists($auteurid);

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

        // Ajout du fil d'Ariane
        $this->addAriane('auteur/'.$auteur->infos['auteurid'].'/'.$auteur->slug($auteur->infos['fullname']), $auteur->infos['fullname']);
        $this->addAriane('cycle/'.$auteurid.'/'.$this->model->infos['cycle']['cycleid'].'/'.$this->model->slug($this->model->infos['cycle']['titre']), $this->model->infos['cycle']['titre']);
        $this->addAriane('livre/'.$auteurid.'/'.$this->model->infos['livreid'].'/'.$this->model->slug($this->model->infos['titre']), $this->model->infos['titre']);
    }

    public function showLivre() {
        $this->getCommon();
        $this->makeView();
    }

    public function showEditions() {
        $this->getCommon();
        $this->addAriane('livre/'.intval($auteurid).'/'.$this->model->infos['livreid'].'/'.$this->model->slug($this->model->infos['titre']).'/edition', 'Éditions');
        $this->view->with('editions', $this->model->getEditions());
        $this->makeView();
    }
}