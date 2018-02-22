<?php

namespace Locaty\Component\Router;

use Locaty\Entity;
use Locaty\Exception;

class Facade extends Entity\AbstractService {

    /**
     * @param array $routes
     * @param string $uri
     * @param string $method
     * @return Match
     * @throws Exception\BadUsage
     * @throws Exception\NotFound
     */
    public function getMatchingRoute(array $routes, string $uri = null, string $method = null): Match {
        $router = $this->_createRouter($routes);
        $match = $router->match($uri, $method);
        if ($match === false) {
            throw new Exception\NotFound();
        }
        if (!($match['target'] instanceof Entity\AbstractAction)) {
            throw new Exception\BadUsage('Route target must be instance of ' . Entity\AbstractAction::class);
        }
        return new Match($match['target'], $match['params'], $match['name']);
    }

    /**
     * @param array $routes
     * @return \AltoRouter
     */
    private function _createRouter(array $routes): \AltoRouter {
        $router = new \AltoRouter();
        foreach ($routes as $id => $route) {
            $router->map($route[0], $route[1], $route[2], $id);
        }
        return $router;
    }
}
