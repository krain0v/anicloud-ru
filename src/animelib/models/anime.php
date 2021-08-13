<?php

namespace Animelib\Models;

use Animelib\lib\Model;
use Animelib\lib\ModelsBase;

class Anime extends ModelsBase implements Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __set(string $name, mixed $value) : void
    {
        $this->$name = $value;
        if ($name == 'genres')
            $this->genres();
    }

    public function __get(string $name) : mixed
    {
        return $this->$name;
    }

    private function genres()
    {
        $genre = new Genre();
        $this->genres_list = $genre->where("id IN (".$this->genres.")");
    }
}