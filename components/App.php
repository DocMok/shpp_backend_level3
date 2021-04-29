<?php

class App
{
    /**
     * Main function. Detects the controller and it's action and run it.
     */
    public function run()
    {
        $activeController = null;
        $controller = $this->getController();
        try {
            require_once $controller['path'];
            $activeController = new $controller['name'];
            if (isset($controller['id'])) {
                $activeController->{$controller['action']}($controller['id']);
            } else {
                $activeController->{$controller['action']}();
            }
        } catch (Error $e) {
            require_once 'controllers/NotFoundController.php';

            $activeController = new NotFoundController($e);
        }
    }

    /**
     * Returns controller's data array with fields:
     *  'path' - path to controller class
     *  'name' - controller name
     *  'action' - call function name from controller class
     *  'id' - call function's parameter
     */
    private function getController(): array
    {

        //get wipe uri without get params
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

        //wipe uri for outside slashes '/'
        $uri = trim($uri, '/');

        //cut uri into several parts
        $uriParts = explode('/', $uri);


        $controllerName = $uriParts[0];
        $action = 'show';

        if (sizeof($uriParts) != 1) {
            $action = $uriParts[1];
        }

        if ($controllerName == '') {
            $controllerName = 'Books';
        }

        if ($controllerName == 'book') {
            if (is_numeric($uriParts[1])) {
                $action = 'show';
                $result['id'] = $uriParts[1];
            } else {
                $action = $uriParts[1];
                $result['id'] = $uriParts[2];
            }
        }

        $controllerName = ucfirst(strtolower($controllerName);
        $controllerName .= 'Controller';
        $result['path'] = 'controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';
        $result['name'] = $controllerName;
        $result['action'] = $action;
        return $result;
    }
}