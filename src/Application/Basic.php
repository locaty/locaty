<?php

namespace Locaty\Application;

use Locaty\Exception;

abstract class Basic {

    final public function __construct() {
        register_shutdown_function([$this, '_handleShutdown']);
        set_error_handler([$this, '_throwErrorException']);
        set_exception_handler([$this, '_handleException']);
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
    protected function _throwErrorException(?int $code, string $text, string $file, string $line): void {
        throw new \Exception("{$text} in file {$file}:{$line}", $code);
    }

    /**
     * @param \Throwable $e
     */
    protected function _handleException(\Throwable $e): void {
        if ($e instanceof Exception\NotFound) {
            $this->_handleNotFound($e);
            return;
        }
        $this->_handleError($e);
    }

    public function _handleShutdown(): void {
        $error = error_get_last();
        if ($error === null) {
            return;
        }
        $type = array_key_exists('type', $error) ? $error['type'] : 0;
        if ($type === E_DEPRECATED) {
            return;
        }
        $this->_throwErrorException($type, $error['message'], $error['file'], $error['line']);
    }

    /**
     * @param \Throwable $e
     */
    abstract protected function _handleNotFound(\Throwable $e): void;

    /**
     * @param \Throwable $e
     */
    abstract protected function _handleError(\Throwable $e): void;

    protected function _beforeRun(): void {}

    protected function _afterRun(): void {}

    abstract protected function _run(): void;
}
