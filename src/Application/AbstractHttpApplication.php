<?php

namespace Locaty\Application;

use Locaty\Component\Router;
use Locaty\Exception;
use Locaty\Transfer;

abstract class AbstractHttpApplication extends Basic {

    /**
     * @var Router\Facade
     */
    private $_router;

    /**
     * @param Router\Facade $router
     */
    public function __construct(Router\Facade $router) {
        $this->_router = $router;
    }

    /**
     * @throws Exception\NotFound
     * @throws \ReflectionException
     * @throws Exception\UnknownError
     */
    protected function _run(): void {
        $match = $this->_getMatchingRoute();
        $response = $this->_getResponse($match);
        if ($response === null) {
            return;
        }
        $this->_outputResponse($response);
    }

    /**
     * @return array
     */
    abstract protected function _routes(): array;

    /**
     * @return Router\Match
     * @throws Exception\NotFound
     * @throws Exception\UnknownError
     */
    protected function _getMatchingRoute(): Router\Match {
        return $this->_router->getMatchingRoute(
            $this->_routes(),
            $this->_getRequestUrl(),
            $this->_getRequestMethod()
        );
    }

    /**
     * @param Router\Match $match
     * @return Transfer\Response\Basic
     * @throws \ReflectionException
     */
    protected function _getResponse(Router\Match $match): ?Transfer\Response\Basic {
        $action = $match->action();
        if (is_array($action) && is_string($action[0])) {
            $action[0] = $this->_container->get($action[0]);
        }
        if ($this->_numberOfActionParams($action) === 0) {
            return $action();
        }
        $request = $this->_createRequest($match->params());
        return $action($request);
    }

    /**
     * @param callable|array $action
     * @return int
     * @throws \ReflectionException
     */
    private function _numberOfActionParams($action): int {
        $reflection = is_array($action) ?
            new \ReflectionMethod($action[0], $action[1]) :
            new \ReflectionFunction($action);
        return $reflection->getNumberOfParameters();
    }

    /**
     * @return string
     */
    protected function _getRequestUrl(): string {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return string
     */
    protected function _getRequestMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param array $params
     * @return \Locaty\Transfer\Request
     */
    protected function _createRequest(array $params = []): Transfer\Request {
        $body = file_get_contents('php://input');
        $uriParams = array_merge($_GET, $params);
        return new Transfer\Request($uriParams, $_POST, $body, $_SERVER);
    }

    /**
     * @param Transfer\Response\Basic $response
     */
    protected function _outputResponse(Transfer\Response\Basic $response): void {
        foreach ($response->headers() as $header => $value) {
            header("{$header}: {$value}");
        }
        echo $response->content();
    }
}
