<?php

namespace Animelib\lib;

use JetBrains\PhpStorm\Language;

abstract class RoutesBase
{
    private string $uri;
    private string $method;
    private string $controller;
    private string $action;
    private array $query;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->query = $_REQUEST;
    }

    protected function get(#[Language("PhpRegExp")]$pattern, $controller = '', $action = '') : void
    {
        if (empty($this->controller)){
            $this->controller = $controller;
        }
        if (empty($this->action)){
            $this->action = $action;
        }
        if (preg_match($pattern, $this->uri, $matches) && $this->method == 'GET')
        {
            echo $this->draw($this->controller, $this->action, $matches);
        }
    }

    private function draw(string $controller, string $action, mixed $option = null) : string
    {
        $controller = $this->controllerName();
        $controller = new $controller($this->query, $this->controller, $this->action);
        return $option ? $controller->$action($option) : $controller->$action();
    }

    private function controllerName() : string
    {
        return '\Animelib\Controllers\\'.ucfirst($this->controller).'Controller';
    }

    public function action(string $action) : RoutesBase
    {
        $this->action = $action;
        return $this;
    }

    public function controller(string $controller) : RoutesBase
    {
        $this->controller = $controller;
        return $this;
    }

}