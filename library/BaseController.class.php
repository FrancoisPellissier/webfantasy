<?php
namespace library;

abstract class BaseController {
    protected $action = '';
    protected $module = '';
    protected $view = '';
    protected $request;
    protected $response;
    protected $jsfile;
    protected $model;
    protected $fil_ariane;
    protected $domaine;

    public function __construct(\library\HTTPRequest $request, $module, $action, $domaine) {
        $this->setModule($module);
        $this->setAction($action);
        $this->request = $request;
        $this->response = new \library\HTTPResponse();
        $this->fil_ariane = array();
        $this->domaine = $domaine;

        $this->view = new \library\View($module, $action);
    }

    public function execute() {
        $method = $this->action;
         
        if (!is_callable(array($this, $method))) {
            throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
        }
        
        $this->$method($this->request);
    }

    public function setModule($module) {
        $this->module = $module;
    }
     
    public function setAction($action) {
        $this->action = $action;
    }

    public function makeView() {        
        // Valeurs génériques à transmettre
        $this->view->with('model', $this->model);
        $this->view->with('fil_ariane', $this->fil_ariane);
        $this->view->with('user', $this->user->infos);
        $this->view->with('jsfile', $this->jsfile);
        $this->view->with('domaine', $this->domaine);

        // Génération de la vue
        $this->view->make();
    }

    public function exists($redirect = '') {
        $id = intval($this->request->getData('id'));

        $modelClass = '\modules\\'.$this->module.'\\'.$this->module;

        $model = new $modelClass();
        $model->exists($id);
        
        // S'il n'existe pas, on redirige vers l'adresse fournie
        if(!$model->exists)
            $this->response->redirect($redirect);
        // S'il existe, on le passe dans la vue et on le renvoie
        else {
            $model->getPages();
            return $model;
        }
    }

    public function getCommon() {

    }

    public function showPages() {
        $common = $this->getCommon();

        $this->makeView();
    }

    public function showPage() {
        $common = $this->getCommon();

        $id = intval($this->request->getData('pageid'));
        $model = new \modules\Page\Page();
        $model->exists($id);
        
        // S'il n'existe pas, on redirige vers l'adresse fournie
        if(!$model->exists) {
            $this->response->redirect($redirect);
        }
        else {
            $this->view->with('page', $model);
            // Une page parente existe ?
            if($model->infos['page_parent_id'] != 0) {
                $parent = new \modules\Page\Page();
                $parent->exists($model->infos['page_parent_id']);

                if($parent->exists) {
                    $this->addAriane($this->model->getSlug().$parent->getSlug(), $parent->infos['titre']);                    
                }
            }

            $this->addAriane($this->model->getSlug().$model->getSlug(), $model->infos['titre']);
            $this->makeView();
        }
    }

    public function addPage() {
        $this->getCommon();

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

            $this->response->redirect($this->model->getSlug().$page->getSlug());
            
        }
        // On affiche le formulaire
        else {
            $this->view->addTitle('Ajouter une page');
            $this->makeView();  
        }
    }

    public function editPage() {
        $this->getCommon();

        $id = intval($this->request->getData('pageid'));
        $model = new \modules\Page\Page();
        $model->exists($id);
        
        // S'il n'existe pas, on redirige
        if(!$model->exists) {
            $this->response->redirect($redirect);
        }
        else {
            // On traite le formulaire
            if($this->request->method() == 'POST') {
                $data = $this->request->postData('data');

                $page = new \modules\Page\Page();
                $model->hydrate($data);
                $model->edit();

                $this->response->redirect($this->model->getSlug().$model->getSlug());    
            }
            // On affiche le formulaire
            else {
                $this->view->addTitle('Modifier la page '.$model->infos['titre']);
                $this->view->with('page', $model);
                $this->makeView();  
            }

        }
    }

    protected function addAriane($url, $title) {
        $this->fil_ariane[] = array(
            'url' => $url,
            'title' => $title
            );
    }
}
