<?php

namespace Locaty\Service;

abstract class Basic {

    public function __construct() {
        $this->_init();
    }

    protected function _init(): void {}
}
