<?php
namespace library;

class Application {
    protected $httpRequest;
    protected $domaine;
    protected $user;

    public function __construct($domaine, $user) {
         $this->httpRequest = new HTTPRequest();
         $this->domaine = $domaine;
         $this->user = $user;
    }

    public function run() {
        $controller = $this->getController();
        $controller->setUser($this->user);
        $controller->execute();
    }

    public function getController() {
        $router = new \library\Router;

        // Le mod maintenance est actif ?
        if(MAINTENANCE_MOD) {
            $matchedRoute = new Route($url, 'Error', 'maintenance', array());
        }
        else {
            $xml = new \DOMDocument;
            $xml->load(__DIR__.'/../assets/config/routes.xml');
             
            $routes = $xml->getElementsByTagName('route');
             
            // On parcourt les routes du fichier XML.
            foreach ($routes as $route) {
                $vars = array();

                // On regarde si des variables sont présentes dans l'URL.
                if ($route->hasAttribute('vars')) {
                    $vars = explode(',', $route->getAttribute('vars'));
                }

                // On ajoute la route au routeur.
                $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
            }
             
            try {
                // On récupère la route correspondante à l'URL.
                $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
            }
            catch (\RuntimeException $e) {
                if ($e->getCode() == \Library\Router::NO_ROUTE) {
                    // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                    $matchedRoute = new Route($url, 'Error', 'error_404', array());
                }
            }
             
            // On ajoute les variables de l'URL au tableau $_GET.
            $_GET = array_merge($_GET, $matchedRoute->vars());
        }

        // On instancie le contrôleur.
        $controllerClass = '\modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';

        return new $controllerClass($this->httpRequest, $matchedRoute->module(), $matchedRoute->action(), $this->domaine);
    }

    public function httpRequest() {
        return $this->httpRequest;
    }
       
    public function httpResponse() {
        return $this->httpResponse;
    }
}