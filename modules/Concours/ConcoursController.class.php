<?php
namespace modules\Concours;

class ConcoursController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();
        
        // Génération du nom de la page
        $this->view->addTitle('Concours : '.$this->model->infos['titre']);

        // Ajout du fil d'Ariane
        $this->addAriane('concours', 'Concours');
        $this->addAriane($this->model->getSlug(), $this->model->infos['titre']);
    }

    public function listConcours() {
        $concours = new Concours();
        $this->view->with('concoursList', $concours->listAll());
        $this->addAriane('concours', 'Concours');
        $this->makeView();
    }

    public function showConcours() {
        $common = $this->getCommon();
        $this->makeView();
    }

    public function participeConcours() {
        $common = $this->getCommon();

        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $data = $this->request->postData('data');

            $data['typepage'] = $this->model->fichetype;
            $data['ficheid'] = $this->model->infos[$this->model->key];

            $page = new \modules\Page\Page();
            $page->hydrate($data);
            $page->setDefaultOrder();

            $pageid = $page->add();
            $page->exists($pageid);

            $this->response->redirect($this->model->getSlug());
        }
        // On affiche le formulaire
        else {
            $this->model->getQuestions();
            $this->makeView();
        }
    }
}