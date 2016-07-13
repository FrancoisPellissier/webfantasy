<?php
namespace modules\Cycle;

class CycleController extends \library\BaseController {
     public function getCommon() {
        $model = $this->exists();
        $auteurid = intval($this->request->getData('auteurid'));

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $model->infos['titre']);
        $this->view->sidebarAdd('link', $model->sidebar('main', $auteurid));
        $this->view->sidebarAdd('title', 'Les livres');
        $this->view->sidebarAdd('link', $model->sidebar('livre'));

        // Génération du nom de la page
        $this->view->setTitle($model->infos['titre']);

        return array($model, $view);
    }
	
    public function showCycle() {
        $common = $this->getCommon();
        $model = $common[0];
        $view = $common[1];

        $this->makeView();
	}

	public function showLivres() {

	}

	public function showPages() {

	}

	public function showPage() {
		
	}
}