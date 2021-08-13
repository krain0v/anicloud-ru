<?php

namespace Animelib;

class Application
{
    private Routes $routes;
    function __construct(
        public string $name,
        public string $language = 'ru'
    )
    {
        $this->routes = new Routes();
        $this->run();
    }

    private function run() : void
    {
        $this->routes->draw();
    }

    static public function URL() : string
    {
        return "https://".$_SERVER['SERVER_NAME'];
    }
}