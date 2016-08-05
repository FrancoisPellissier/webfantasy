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
        $this->view->addTitle($this->model->infos['fullname']);

        // Ajout du fil d'Ariane
        $this->addAriane($this->model->getSlug(), $this->model->infos['fullname']);
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

    public function add() {
        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $this->model = new Auteur();
            $data = $this->request->postData('data');
            $this->model->hydrate($data);
            $this->model->setFullname();
            $auteurid = $this->model->add();
            
            $this->model->exists($auteurid);
            $this->response->redirect($this->model->getSlug());
        }
        // On affiche le formulaire
        else {
            $this->view->addTitle('Ajouter un auteur');
            $form = new \library\Form(array());
            $this->view->with('form', $form);
            $this->makeView();  
        }
    }

    public function edit() {
        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $this->getCommon();
            $data = $this->request->postData('data');
            $this->model->hydrate($data);
            $this->model->setFullname();         
            $this->model->edit();
            $this->response->redirect($this->model->getSlug());
        }
        // On affiche le formulaire
        else {
            $this->getCommon();
            $form = new \library\Form($this->model->infos);
            $this->view->with('form', $form);
            $this->makeView();     
        }
    }
}