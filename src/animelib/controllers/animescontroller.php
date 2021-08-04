<?php

namespace Animelib\Controllers;

use Animelib\lib\ControllersBase;


class AnimesController extends ControllersBase
{
    public function index() : string
    {
        $this->title = 'Анимелиб - библиотека аниме, манги и ранобэ';
        $this->vars += [
            'a' => ['c', 'd']
        ];
        return $this->render();
    }
}