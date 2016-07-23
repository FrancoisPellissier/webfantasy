<?php
namespace modules\Livre;

class LivreController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();
        $this->model->getAuteur();
        $this->model->getCycle();

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $this->model->infos['titre']);
        $this->view->sidebarAdd('link', $this->model->sidebar('main'));
        
        /* ** TO DO **
        ** A paramétrer en fonction cycle oui / non
        ** Si non, afficher "cycle du même auteur" ou "du même auteur"
        ** ** Fin du TO **
        */
        $this->view->sidebarAdd('title', 'Dans le même cycle');
        $this->view->sidebarAdd('link', $this->model->sidebar('livre'));

        // Génération du nom de la page
        $this->view->setTitle($this->model->infos['titre']);

        // Ajout du fil d'Ariane
        $this->addAriane('auteur/'.$this->model->auteur->infos['auteurid'].'/'.$this->model->auteur->slug($this->model->auteur->infos['fullname']), $this->model->auteur->infos['fullname']);
        $this->addAriane('cycle/'.$this->model->auteur->infos['auteurid'].'/'.$this->model->infos['cycle']['cycleid'].'/'.$this->model->slug($this->model->infos['cycle']['titre']), $this->model->infos['cycle']['titre']);
        $this->addAriane('livre/'.$this->model->auteur->infos['auteurid'].'/'.$this->model->infos['livreid'].'/'.$this->model->slug($this->model->infos['titre']), $this->model->infos['titre']);
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