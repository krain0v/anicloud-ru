<?php

namespace Animelib\lib;

use Phug\Phug;

abstract class ControllersBase
{
    public function __construct(
        protected array $query,
        private string $controller,
        private string $action,
        protected array $vars = [],
        protected string $title = ''
    )
    {}

    protected function render() : string
    {
        $yield = [
            'yield' => Phug::renderFile(
                path: "src/animelib/views/$this->controller/$this->action.pug",
                parameters: $this->vars,
                options: ['cache_dir' => 'temp/cache/pug']
            ),
            'title' => $this->title
        ];
        return Phug::renderFile(
            path: "src/animelib/views/layouts/application.pug",
            parameters: $yield,
            options: ['cache_dir' => 'temp/cache/pug']
        );
    }
}