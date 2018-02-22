<?php

namespace Locaty\Application;

use Locaty\SL;

abstract class AbstractHttpApplication extends AbstractApplication {

    protected function _run(): void {
        $match = SL::router()->getMatchingRoute($this->_routes());
        SL::controller()->executeAction($match->action(), $match->params());
    }

    /**
     * @return array
     */
    abstract protected function _routes(): array;
}
