<?php

namespace Locaty\Application;

use Locaty\Exception;

abstract class Basic {

    final public function __construct() {
        register_shutdown_function([$this, 'handleShutdown']);
        set_error_handler([$this, 'throwErrorException']);
        set_exception_handler([$this, 'handleException']);
        $this->init();
    }

    public function init(): void {}

    final public function run(): void {
        $this->_beforeRun();
        try {
            $this->_run();
        } finally {
            $this->_afterRun();
        }
    }

    /**
     * @param int $code
     * @param string $text
     * @param string $file
     * @param string $line
     * @throws \Exception
     */
    public function throwErrorException(?int $code, string $text, string $file, string $line): void {
        throw new \Exception("{$text} in file {$file}:{$line}", $code);
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

    public function handleShutdown(): void {
        $error = error_get_last();
        if ($error === null) {
            return;
        }
        $type = array_key_exists('type', $error) ? $error['type'] : 0;
        if ($type === E_DEPRECATED || $type === E_WARNING) {
            return;
        }
        $this->throwErrorException($type, $error['message'], $error['file'], $error['line']);
    }

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
