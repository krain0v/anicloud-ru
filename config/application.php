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

    private function run()
    {
        $this->routes->draw();
    }
}