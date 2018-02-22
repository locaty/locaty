<?php

namespace Locaty\Entity;

abstract class AbstractAction {

    /**
     * @param array $params
     */
    abstract public function run(array $params): void;
}
