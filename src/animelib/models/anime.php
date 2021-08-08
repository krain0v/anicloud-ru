<?php

namespace Animelib\Models;

use Animelib\lib\Model;
use Animelib\lib\ModelsBase;

class Anime extends ModelsBase implements Model
{
    public function __construct(
        public int $id = 0,
        public string $canonical = '',
        public string $russian = '',
        public string $optionally = ''
    )
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