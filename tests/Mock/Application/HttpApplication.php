<?php

namespace Tests\Mock\Application;

use Locaty\Application\AbstractHttpApplication;
use Locaty\Component\Router;
use Locaty\Transfer;

class Http extends AbstractHttpApplication {

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
     * @param \Throwable $exception
     * @throws \Throwable
     */
    protected function _handleNotFound(\Throwable $exception): void {
        echo '404';
    }

    /**
     * @param \Throwable $exception
     * @throws \Throwable
     */
    protected function _handleError(\Throwable $exception): void {
        throw $exception;
    }
}
