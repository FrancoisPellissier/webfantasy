<?php
namespace modules\Actualite;

class ActualiteController extends \library\BaseController {
    public function showLast() {
        $actualite = new Actualite();
        $this->view->addTitle('Accueil');
        $this->addAriane('actualite', 'Actualités');
        $this->jsfile = 'actualite';
        $this->view->with('actualites', $actualite->getLast());
        $this->view->with('list_months', $actualite->getMonths());
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

    public function showArchive() {
        $actualite = new Actualite();
        $actualite->getDate($this->request);

        $this->view->addTitle('Archives');
        $this->addAriane('actualite', 'Actualités');
        $this->jsfile = 'actualite';
        $this->view->with('actualite', $actualite);
        $this->view->with('actualites', $actualite->getArchive());
        $this->view->with('list_months', $actualite->getMonths());
        $this->makeView();   
    }
}