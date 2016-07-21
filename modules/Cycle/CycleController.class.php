<?php
namespace modules\Cycle;

class CycleController extends \library\BaseController {
     public function getCommon() {
        $this->model = $this->exists();
        $auteurid = intval($this->request->getData('auteurid'));
        $this->model->getLivres($auteurid);

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $this->model->infos['titre']);
        $this->view->sidebarAdd('link', $this->model->sidebar('main', $auteurid));
        $this->view->sidebarAdd('title', 'Les livres');
        $this->view->sidebarAdd('link', $this->model->sidebar('livre', $auteurid));

        // Génération du nom de la page
        $this->view->setTitle($this->model->infos['titre']);
    }
	
    public function showCycle() {
        $common = $this->getCommon();
        $this->makeView();
	}

	public function showLivres() {

	}
}