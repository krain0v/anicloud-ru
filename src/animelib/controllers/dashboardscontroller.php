<?php

namespace Animelib\Controllers;

use Animelib\lib\ControllersBase;


class DashboardsController extends ControllersBase
{
    public function index() : string
    {
        $this->title = 'Анимелиб - библиотека аниме, манги и ранобэ';
        $this->vars = [

        ];
        return $this->render();
    }
}