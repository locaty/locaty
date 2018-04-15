<?php

namespace Locaty\Application;

use DI;
use Locaty\Exception;
use Locaty\Service;
use Psr;

abstract class Basic {

    /**
     * @var Psr\Container\ContainerInterface
     */
    protected $_container;

    /**
     * @return Basic
     * @throws DI\DependencyException
     * @throws DI\NotFoundException
     */
    public static function create(): Basic {
        $container = new DI\Container();
        $errorHandler = $container->get(Service\ErrorHandler::class);
        $errorHandler->registerHandlers();
        $result = $container->get(get_called_class());
        $result->setContainer($container);
        set_exception_handler([$result, 'handleException']);
        $result->_init();
        return $result;
    }

    final public function run(): void {
        $this->_beforeRun();
        try {
            $this->_run();
        } finally {
            $this->_afterRun();
        }
    }

    /**
     * @param Psr\Container\ContainerInterface $container
     */
    public function setContainer(Psr\Container\ContainerInterface $container): void {
        $this->_container = $container;
    }

    /**
     * @param \Throwable $exception
     */
    public function handleException(\Throwable $exception): void {
        if ($exception instanceof Exception\NotFound) {
            $this->_handleNotFound($exception);
            return;
        }
        $this->_handleError($exception);
    }

    protected function _init(): void {}

    /**
     * @param \Throwable $exception
     */
    abstract protected function _handleNotFound(\Throwable $exception): void;

    /**
     * @param \Throwable $exception
     */
    abstract protected function _handleError(\Throwable $exception): void;

    protected function _beforeRun(): void {}

    protected function _afterRun(): void {}

    abstract protected function _run(): void;
}
