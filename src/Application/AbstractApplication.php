<?php

namespace Locaty\Application;

abstract class AbstractApplication {

    final public function run(): void {
        $this->_beforeRun();
        try {
            $this->_run();
        } finally {
            $this->_afterRun();
        }
    }

    protected function _beforeRun(): void {}

    protected function _afterRun(): void {}

    abstract protected function _run(): void;
}
