<?php
namespace modules\Accueil;

class AccueilController extends \library\BaseController {
    public function showAccueil() {
        $this->view->addTitle('Accueil');
        $this->view->with('news', $array);
        $this->makeView();
    }
}