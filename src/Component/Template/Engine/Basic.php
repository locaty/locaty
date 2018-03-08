<?php

namespace Locaty\Component\Template\Engine;

abstract class Basic {

    /**
     * @param string $template
     * @param array $params
     * @return string
     */
    abstract public function render(string $template, array $params = []): string;
}
