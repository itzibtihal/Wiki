<?php
 

require_once '../../vendor/autoload.php';

use App\routes\Router;

$router = new Router();

$router->setRoutes([
    'GET' => [

        'home' => ['HomeController', 'index'],
        

        
    ],



    'POST' => [
        '' => ['', ''],
    ]
]);

if (isset($_GET['url'])) {
    $uri = trim($_GET['url'], '/');
    
    $methode = $_SERVER['REQUEST_METHOD'];

    try {
        $route = $router->getRoute($methode, $uri);

        if ($route) {
            list($controllerName, $methodName) = $route;

            $controllerClass = 'App\\Controllers\\' . ucfirst($controllerName);

            $controller = new $controllerClass();

            if ($methodName) {
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    throw new Exception('Method not found in controller.');
                }
            } else {
                $controller->index();
            }
        } else {
            throw new Exception('Route not found.');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }

}