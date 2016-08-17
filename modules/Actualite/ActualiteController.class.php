<?php
namespace modules\Actualite;

class ActualiteController extends \library\BaseController {
    public function showLast() {
        $actualite = new Actualite();
        $this->view->addTitle('Accueil');
        $this->addAriane('actualite', 'Actualités');
        $this->view->with('actualites', $actualite->getLast());
        $this->makeView();
    }

    public function showActualite() {
        $this->model = $this->exists('actualite');
        $this->model->getComments();
        $this->view->addTitle($this->model->infos['subject']);
        $this->addAriane('actualite', 'Actualités');
        $this->addAriane($this->model->getSlug(), $this->model->infos['subject']);
        $this->makeView();
    }
}