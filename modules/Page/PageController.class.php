<?php
namespace modules\Page;

class PageController extends \library\BaseController {
    public function getCommon() {
        $this->model = $this->exists();

        // Génération du nom de la page
        $this->view->addTitle($this->model->infos['titre']);
    }

    public function showPage() {
        $this->getCommon();
        $this->view->with('page', $this->model);
        $this->view->with('isPage', true);

        // Une page parente existe ?
        if($this->model->infos['page_parent_id'] != 0) {
            $parent = new \modules\Page\Page();
            $parent->exists($this->model->infos['page_parent_id']);

            if($parent->exists) {
                $this->addAriane($parent->getSlug(true), $parent->infos['titre']);
                $parent->getPrevNext($this->model->infos['pageid']);
                $this->view->with('parent', $parent);
            }
        }

        // Ajout du fil d'Ariane
        $this->addAriane($this->model->getSlug(true), $this->model->infos['titre']);
        $this->makeView();
    }

    public function addPage() {
        $this->checkRight();

        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $data = $this->request->postData('data');

            $data['typepage'] = 'domaine';
            $data['ficheid'] = $this->domaine;

            $page = new \modules\Page\Page();
            $page->hydrate($data);
            $page->setDefaultOrder();

            $pageid = $page->add();
            $page->exists($pageid);

            $this->response->redirect($page->getSlug(true));
        }
        // On affiche le formulaire
        else {
            $this->model = new \modules\Domaine\Domaine();
            $this->model->exists($this->domaine);
            $this->model->getPages();

            $this->view->addTitle('Ajouter une page');
            $form = new \library\Form($this->model->infos);
            $this->view->with('form', $form);

            // Ajout du fil d'Ariane
            $this->addAriane('page/add', 'Ajouter une page');
            $this->makeView();
        }
    }

    public function editPage() {
        $this->checkRight();
        
        $this->getCommon();

        $domaine = new \modules\Domaine\Domaine();
        $domaine->exists($this->domaine);
        $domaine->getPages();
        $this->model->infos['pages'] = $domaine->infos['pages'];

        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $data = $this->request->postData('data');

            $this->model->hydrate($data);
            $this->model->edit();

            $this->response->redirect($this->model->getSlug(true));    
        }
        // On affiche le formulaire
        else {
            $this->view->addTitle('Modifier la page '.$this->model->infos['titre']);
            $this->view->with('page', $this->model);
            $form = new \library\Form($this->model->infos);
            $this->view->with('form', $form);
            
            // Ajout du fil d'Ariane
            $this->addAriane($this->model->getSlug(true), $this->model->infos['titre']);
            $this->makeView();
        }
    }
}