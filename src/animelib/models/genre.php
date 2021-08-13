<?php

namespace Animelib\Models;

use Animelib\lib\Model;
use Animelib\lib\ModelsBase;

class Genre extends ModelsBase implements Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __set(string $name, $value) : void
    {
        $this->$name = $value;
    }

    public function __get(string $name) : mixed
    {
        return $this->$name;
    }
}