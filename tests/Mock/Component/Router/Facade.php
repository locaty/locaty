<?php

namespace Tests\Mock\Component\Router;

use Locaty\Component\Router;
use Locaty\Component\Controller;

class Facade extends Router\Facade {

    /**
     * @param array $routes
     * @param string|null $uri
     * @param string|null $method
     * @return Router\Match
     */
    public function getMatchingRoute(array $routes, string $uri = null, string $method = null): Router\Match {
        $action = new Controller\ControllerMethodAction('testClass', 'testAction');
        return new Router\Match($action, [], 'testAction');
    }
}
