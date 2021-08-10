<?php

namespace Animelib\Controllers;

use Animelib\lib\ControllersBase;
use Animelib\Models\Anime;


class AnimesController extends ControllersBase
{
    public function index() : string
    {
        $animes = (new Anime())->all(limit: 12);
        $this->title = 'Анимелиб - библиотека аниме, манги и ранобэ';
        $this->vars = [
            'animes' => json_decode(json_encode($animes), true)
        ];
        return $this->render();
    }
}