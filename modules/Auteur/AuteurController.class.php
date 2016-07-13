<?php
namespace modules\Auteur;

class AuteurController extends \library\BaseController {
    public function getCommon() {
        $auteur = $this->exists();
        $auteur->getCycles();

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $auteur->infos['fullname']);
        $this->view->sidebarAdd('link', $auteur->sidebar('page'));
        $this->view->sidebarAdd('title', 'Les cycles');
        $this->view->sidebarAdd('link', $auteur->sidebar('cycle'));

        return array($auteur, $view);
    }

	public function showAuteur() {
        $common = $this->getCommon();
        $auteur = $common[0];
        $view = $common[1];

        // Génération du nom de la page
        $this->view->setTitle($auteur->infos['fullname']);

        $this->makeView();
	}

	public function showLivres() {
        $this->makeView();
	}

	public function showPages() {
        $this->makeView();
	}

	public function showPage() {
        $this->makeView();
	}
}