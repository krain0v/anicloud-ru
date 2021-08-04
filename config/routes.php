<?php

namespace Animelib;

use Animelib\lib\RoutesBase;

class Routes extends RoutesBase
{
    public function draw()
    {
        # ./
        $this->controller('dashboards')->action('index')->get('/^\/(\?.+|$)$/i');
        # ./animes
        $this->controller('animes')->action('index')->get('/^\/animes(\?.+|$)$/i');
    }
}