<?php
namespace modules\Cycle;

class CycleController extends \library\BaseController {
     public function getCommon() {
        $this->model = $this->exists();
        $this->model->getAuteur();
        $this->model->getLivres();

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $this->model->infos['titre']);
        $this->view->sidebarAdd('link', $this->model->sidebar('main'));
        $this->view->sidebarAdd('title', 'Les livres');
        $this->view->sidebarAdd('link', $this->model->sidebar('livre'));

        // Génération du nom de la page
        $this->view->setTitle($this->model->infos['titre']);

        // Ajout du fil d'Ariane
        $this->addAriane('auteur/'.$this->model->auteur->infos['auteurid'].'/'.$this->model->slug($this->model->auteur->infos['fullname']), $this->model->auteur->infos['fullname']);
        $this->addAriane('cycle/'.$this->model->auteur->infos['auteurid'].'/'.$this->model->infos['cycleid'].'/'.$this->model->slug($this->model->infos['titre']), $this->model->infos['titre']);
    }
	
    public function showCycle() {
        $common = $this->getCommon();
        $this->makeView();
	}

	public function showLivres() {

	}
}