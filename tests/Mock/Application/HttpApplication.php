<?php

namespace Tests\Mock\Application;

use Locaty\Application\AbstractHttpApplication;
use Locaty\Component\Router;
use Locaty\Transfer;

class HttpApplication extends AbstractHttpApplication {
    /**
     * @return Transfer\Response\Plain
     */
    public function indexAction(): Transfer\Response\Plain {
        return new Transfer\Response\Plain('ok');
    }

    /**
     * @return Router\Match
     */
    protected function _getMatchingRoute(): Router\Match {
        return new Router\Match([$this, 'indexAction']);
    }

    /**
     * @return array
     */
    protected function _routes(): array {
        return [];
    }
}
