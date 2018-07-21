<?php

namespace App\Etc;

/**
 * Class Route
 * @package Etc
 */
class Route
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $method;

    /**
     * @var
     */
    private $action;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var array
     */
    private $matches = [];


    /**
     * Route constructor.
     * @param $path
     * @param $method
     * @param $action
     * @param $params
     */
    public function __construct($path, $method, $action, $params)
    {
        $this->path = trim($path, '/');
        $this->method = $method;
        $this->action = $action;
        $this->params = $params;
    }


    /**
     * @param $getPathInfo
     * @return bool
     */
    public function match($getPathInfo)
    {
        $getPathInfo = trim($getPathInfo, '/');
        $path = preg_replace_callback('#{([\w]+)}#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";

        if (!preg_match($regex, $getPathInfo, $matches)) {
            return false;
        }
        array_shift($matches);

        $this->matches = $matches;
        return true;
    }

    /**
     * @param $matche
     * @return string
     */
    public function paramMatch($matche)
    {
        if(isset($this->params[$matche[1]])) {
            return '(' . $this->params[$matche[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * @return mixed
     */
    public function call()
    {
        $controller = new $this->action;
        $params = count($this->matches);

        if($params >= 1 ) {
            return $controller->index($this->matches);
        }
        return $controller->index();
    }
}
