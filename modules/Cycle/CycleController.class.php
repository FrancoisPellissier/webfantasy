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
        $this->view->addTitle($this->model->infos['titre']);

        // Ajout du fil d'Ariane
        $this->addAriane($this->model->auteur->getSlug(), $this->model->auteur->infos['fullname']);
        $this->addAriane($this->model->getSlug(), $this->model->infos['titre']);
    }
	
    public function showCycle() {
        $common = $this->getCommon();
        $this->makeView();
	}

	public function showLivres() {

	}

    public function add() {
        $this->checkRight();

        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $this->model = new Cycle();
            $this->model->getAuteur();

            $data = $this->request->postData('data');
            $this->model->hydrate($data);    
            $cycleid = $this->model->add();
            $this->model->exists($cycleid);

            $this->model->auteur->assocCycle($cycleid);
            $this->response->redirect($this->model->getSlug());
        }
        // On affiche le formulaire
        else {
            $this->model = new Cycle();
            $this->model->getAuteur();

            // Génération du nom de la page
            $this->view->addTitle('Ajouter un cycle');

            // Ajout du fil d'Ariane
            $this->addAriane($this->model->auteur->getSlug(), $this->model->auteur->infos['fullname']);

            $form = new \library\Form(array());
            $this->view->with('form', $form);

            // Génération de la page
            $this->makeView();  
        }
    }

    public function edit() {
        $this->checkRight();
        
        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $this->getCommon();
            $data = $this->request->postData('data');
            $this->model->hydrate($data);          
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