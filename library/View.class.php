<?php
namespace library;

class View {
    private $data;
    private $layout;
    private $view;

    private $titre_page;
    private $sidebar;
    
    /**
     * View::__construct()
     * 
     * @param string $module
     * @param string $view
     * @return void
     */
    public function __construct($module, $view) {
        $this->view = 'modules/'.ucwords($module).'/view/'.$view.'.tpl.php';
        $this->sidebar = array();

        /*
        if(!file_exists($this->view)) {
            header('Location: index.php');
            exit;
        }
        */   
        $this->layout();
    }
         
    /**
     * View::layout()
     * 
     * @return void
     */
    private function layout() {
        $this->layout = 'assets/layouts/layout.tpl.php';    
    }
    
    /**
     * View::with()
     * 
     * @param string $var
     * @param string $value
     * @return void
     */
    public function with($var, $value) {
        $this->data[$var] = $value;
    }

    /**
     * View::sidebarAdd()
     * 
     * @param array $type
     * @param stack $value
     * @return void
     */
    public function sidebarAdd($type, $value) {
        $this->sidebar[] = array(
            'type' => $type,
            'value' => $value);
    }

    /**
     * View::setTitle()
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
        $this->titre_page = $title;
    }

    /**
     * View::addTitle()
     * 
     * @param string $title
     * @return void
     */
    public function addTitle($title) {
        $this->titre_page = $title.' - '.$this->titre_page;
    }
   
    /**
     * View::make()
     * 
     * @return void
     */
    public function make() { 
        if(!empty($this->data)) {
            foreach($this->data AS $var => $value) {
                ${$var} = $value;
            }
        }
        $view = $this->view;
        $sidebar = $this->sidebar;
        $titre_page = $this->titre_page;

        include($this->layout);
    }

    public function addHeader($header) {
        header($header);
    }
}
?>