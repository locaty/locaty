<?php

namespace Tests\Mock\Application;

use Locaty\Application\BasicHttp;
use Locaty\Component\Router;
use Locaty\Transfer;

class Http extends BasicHttp {

    /**
     * @var string
     */
    private $_actionName;

    /**
     * @return Transfer\Response\Plain
     */
    public function indexAction(): Transfer\Response\Plain {
        return new Transfer\Response\Plain('ok');
    }

    /**
     * @throws \Exception
     */
    public function badAction(): void {
        throw new \Exception('Some error');
    }

    /**
     * @return Router\Match
     */
    protected function _getMatchingRoute(): Router\Match {
        return new Router\Match([$this, $this->_actionName]);
    }

    /**
     * @param string $name
     */
    public function setActionName(string $name): void {
        $this->_actionName = $name;
    }

    /**
     * @return array
     */
    protected function _routes(): array {
        return [];
    }

    /**
     * @param \Throwable $e
     * @throws \Throwable
     */
    protected function _handleNotFound(\Throwable $e): void {
        die('404');
    }

    /**
     * @param \Throwable $e
     * @throws \Throwable
     */
    protected function _handleError(\Throwable $e): void {
        throw $e;
    }
}
