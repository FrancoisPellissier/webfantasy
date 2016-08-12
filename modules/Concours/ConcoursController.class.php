<?php
namespace modules\Concours;

class ConcoursController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();
        
        // Génération du nom de la page
        $this->view->addTitle($this->model->infos['titre']);

        // Ajout du fil d'Ariane
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
}