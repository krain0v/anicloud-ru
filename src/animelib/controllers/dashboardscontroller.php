<?php

namespace Animelib\Controllers;

use Animelib\lib\ControllersBase;
use Animelib\Models\Anime;


class DashboardsController extends ControllersBase
{
    public function index() : string
    {
        $this->title = 'Анимелиб - библиотека аниме, манги и ранобэ';
        $this->vars = [

        ];
        $animel = (new Anime())->find(1);
        var_dump($animel->url());
        return '';
        //return $this->render();
    }
}