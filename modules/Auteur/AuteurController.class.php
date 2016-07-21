<?php
namespace modules\Auteur;

class AuteurController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();
        $this->model->getCycles();

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $this->model->infos['fullname']);
        $this->view->sidebarAdd('link', $this->model->sidebar('page'));
        $this->view->sidebarAdd('title', 'Les cycles');
        $this->view->sidebarAdd('link', $this->model->sidebar('cycle'));

        // Génération du nom de la page
        $this->view->setTitle($this->model->infos['fullname']);
    }

	public function showAuteur() {
        $common = $this->getCommon();
        $this->makeView();
	}

	public function showLivres() {
        $common = $this->getCommon();
        $auteur = $common[0];
        $view = $common[1];

        $this->makeView();
	}
}