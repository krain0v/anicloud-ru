<?php

namespace Animelib\lib;

interface Model
{
    public function __set(string $name, $value) : void;
    public function __get(string $name) : mixed;
}