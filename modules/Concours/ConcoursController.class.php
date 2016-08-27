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

    public function errorConcours() {
        $common = $this->getCommon();
        $this->view->with('error', $this->request->getData('error'));
        $this->makeView();
    }

    public function participeConcours() {
        $common = $this->getCommon();

        // On traite le formulaire
        if($this->request->method() == 'POST') {
            $data = $this->request->postData('data');

            $data['all_right'] = $this->model->checkAnswer($data['question']);
            $data['user_ip'] = get_remote_address();
            $data['formid'] = $this->model->infos['formid'];

            $participate = new ConcoursParticipant();
            $participate->hydrate($data);
            $participate->verif($this->model, $this->request, $this->response);
            $participate->clean();
            $userid = $participate->add();
            $this->model->saveAnswer($userid, $data['question']);
            $this->model->increment();
            $participate->sendEmail();

            // Newsletter
            if($this->request->postExists('newsletter')) {
                $newsletter = new \modules\Newsletter\Newsletter();
                $newsletter->hydrate(array('domaine' => '0', 'email' => $data['email']));
                $newsletter->subscribe();
            }

            $this->response->redirect($this->model->getSlug().'/done');
        }
        // On affiche le formulaire
        else {
            $this->model->getQuestions();
            $this->makeView();
        }
    }

    public function participeDone() {
        $common = $this->getCommon();
        $this->makeView();   
    }
}