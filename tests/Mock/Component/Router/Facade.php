<?php

namespace Tests\Mock\Component\Router;

use Locaty\Component\Router;

class Facade extends Router\Facade {

    /**
     * @param array $routes
     * @param string|null $requestUrl
     * @param string|null $requestMethod
     * @return Router\Match
     */
    public function getMatchingRoute(array $routes, string $requestUrl = null, string $requestMethod = null): Router\Match {
        return new Router\Match(function() {}, [], 'test_action');
    }
}
