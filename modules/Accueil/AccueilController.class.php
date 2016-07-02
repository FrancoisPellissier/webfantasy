<?php
namespace modules\Accueil;

class AccueilController extends \library\BaseController {
    public function showAccueil() {
        $this->titre_page = 'Accueil';
        $this->view->with('news', $array);
        $this->makeView();
    }
}