<?php

namespace App\Etc;

use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class Router
 * @package Etc
 */
class Router
{
    /**
     * @var array
     */
    private $request;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->loadRoute();
        $this->request = $request;
    }


    public function loadRoute()
    {
        $routes = require __DIR__ . './../../config/routes/routes.php';
        foreach ($routes as $route) {
            $this->routes[$route['method']][] = new Route($route['path'], $route['method'], $route['action'], $route['params']);
        }

    }

    /**
     * @return mixed
     */
    public function runApp()
    {

        if(!isset($this->routes[$this->request->getMethod()])) {
            $response = new RedirectResponse('/404');
            return $response->send();
        }
        foreach($this->routes[$this->request->getMethod()] as $route ) {
            if($route->match($this->request->getPathInfo())) {
                return $route->call();
            }
        }
        $response = new RedirectResponse('/404');
        return $response->send();
    }

}