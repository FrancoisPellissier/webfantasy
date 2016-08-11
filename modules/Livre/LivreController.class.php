<?php
namespace modules\Livre;

class LivreController extends \library\BaseController {
    public function getCommon($getAuteur = true) {
        $this->model = $this->exists();

        if($getAuteur) {
            $this->model->getAuteur();
        }
        $this->model->getCycle();

        // Ajout des éléments dans la Sidebar
        $this->view->sidebarAdd('title', $this->model->infos['titre']);
        $this->view->sidebarAdd('link', $this->model->sidebar('main'));
        
        /* ** TO DO **
        ** A paramétrer en fonction cycle oui / non
        ** Si non, afficher "cycle du même auteur" ou "du même auteur"
        ** ** Fin du TO **
        */
        $this->view->sidebarAdd('title', 'Dans le même cycle');
        $this->view->sidebarAdd('link', $this->model->sidebar('livre'));

        // Génération du nom de la page
        $this->view->addTitle($this->model->infos['titre']);

        // Ajout du fil d'Ariane
        $this->addAriane($this->model->auteur->getSlug(), $this->model->auteur->infos['fullname']);
        $this->addAriane($this->model->infos['cycle']->getSlug(), $this->model->infos['cycle']->infos['titre']);
        $this->addAriane($this->model->getSlug(), $this->model->infos['titre']);
    }

    public function showLivre() {
        $this->getCommon();
        $this->makeView();
    }

    public function showEditions() {
        $this->getCommon();
        $this->model->getEditions();
        $this->addAriane($this->model->getSlug().'/edition', 'Éditions');
        $this->makeView();
    }

    public function add() {
        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $this->model = new Livre();
            $this->model->getAuteur();

            $data = $this->request->postData('data');
            $data['auteurid'] = $this->model->auteur->infos['auteurid'];
            $this->model->hydrate($data);    

            $livreid = $this->model->add();
            $this->model->exists($livreid);

            $this->model->auteur->assocLivre($livreid);
            $this->response->redirect($this->model->getSlug());
        }
        // On affiche le formulaire
        else {
            $this->model = new Livre();
            $this->model->getAuteur();

            // Génération du nom de la page
            $this->view->addTitle('Ajouter un livre');

            // Ajout du fil d'Ariane
            $this->addAriane($this->model->auteur->getSlug(), $this->model->auteur->infos['fullname']);

            $cycle = new \modules\Cycle\Cycle();
            $this->view->with('cycles', $cycle->getCycles($this->model->auteur->infos['auteurid']));

            $form = new \library\Form(array());
            $this->view->with('form', $form);

            // Génération de la page
            $this->makeView();  
        }
    }

    public function edit() {
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
            $cycle = new \modules\Cycle\Cycle();
            $this->view->with('cycles', $cycle->getCycles($this->model->auteur->infos['auteurid']));

            $form = new \library\Form($this->model->infos);
            $this->view->with('form', $form);

            $this->makeView();     
        }
    }

    public function addEdition() {
        $this->view->addTitle('Ajouter une édition');
        $this->getCommon();
        $this->addAriane($this->model->getSlug().'/edition', 'Éditions');
        $edition = new \modules\Edition\Edition();

        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $data = $this->request->postData('data');
            $edition->hydrate($data);
            $editionid = $edition->add();
            $this->model->assocEdition($editionid);
            $this->response->redirect($this->model->getSlug().'/edition');
        }
        // On affiche le formulaire
        else {
            $edition->getLangs();
            $edition->getFormats();
            $this->view->with('edition', $edition);
            $form = new \library\Form(array('titre' => $this->model->infos['titre']));
            $this->view->with('form', $form);
            $this->makeView();  
        }
    }

    public function editEdition() {
        $this->view->addTitle('Modifier une édition');
        $this->getCommon();
        $this->addAriane($this->model->getSlug().'/edition', 'Éditions');
        $edition = new \modules\Edition\Edition();
        $edition->exists($this->request->getData('editionid'));

        if($edition->exists) {
            // On traite le formulaire
            if($this->request->method() == 'POST') {
                $data = $this->request->postData('data');
                $edition->hydrate($data);
                $edition->edit();
                $this->response->redirect($this->model->getSlug().'/edition');
            }
            // On affiche le formulaire
            else {
                $edition->getLangs();
                $edition->getFormats();
                $this->view->with('edition', $edition);
                $form = new \library\Form($edition->infos);
                $this->view->with('form', $form);
                $this->makeView();  
            }

        }
        else {
             $this->response->redirect($this->model->getSlug().'/edition');
        }
    }

    public function editEditionImage() {
        $this->view->addTitle('Choisir une image');
        $this->getCommon();
        $this->addAriane($this->model->getSlug().'/edition', 'Éditions');
        $edition = new \modules\Edition\Edition();
        $edition->exists($this->request->getData('editionid'));

        if($edition->exists) {
            // On traite le formulaire
            if($this->request->method() == 'POST') {
                $data = $this->request->postData('data');
                $image = new \modules\Image\Image();
                $image->exists($data['pictureid']);

                if($image->exists) {
                    $edition->hydrate($data);
                    $edition->edit();
                }
                $this->response->redirect($this->model->getSlug().'/edition');
            }
            // On affiche le formulaire
            else {
                $this->model->getImages();

                $images = array();
                foreach($this->model->infos['images'] AS $image) {
                    $images[$image->infos['imageid']] = '<img src="'.$image->getUrl('thumbnail').'" />';
                }
                $this->view->with('images', $images);

                $this->view->addTitle('Choisir une image');
                $form = new \library\Form($edition->infos);
                $this->view->with('form', $form);
                $this->makeView();  
            }
        }
        else {
             $this->response->redirect($this->model->getSlug().'/edition');
        }
    }
}