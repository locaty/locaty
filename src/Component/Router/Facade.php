<?php

namespace Locaty\Component\Router;

use Locaty\Exception;
use Locaty\Service;

class Facade extends Service\AbstractService {

    /**
     * @param array $routes
     * @param string $requestUrl
     * @param string $requestMethod
     * @return Match
     * @throws Exception\NotFound
     * @throws Exception\UnknownError
     */
    public function getMatchingRoute(array $routes, string $requestUrl, string $requestMethod): Match {
        try {
            $router = $this->_createRouter($routes);
        } catch (\Exception $e) {
            throw new Exception\UnknownError('Error while creating router instance', $e->getCode(), $e);
        }
        $match = $router->match($requestUrl, $requestMethod);
        if ($match === false) {
            throw new Exception\NotFound();
        }
        return new Match($match['target'], $match['params'], $match['name']);
    }

    /**
     * @param array $routes
     * @return \AltoRouter
     * @throws \Exception
     */
    private function _createRouter(array $routes): \AltoRouter {
        $router = new \AltoRouter();
        foreach ($routes as $id => $route) {
            $router->map($route[0], $route[1], $route[2], $id);
        }
        return $router;
    }
}
