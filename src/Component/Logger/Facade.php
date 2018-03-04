<?php

namespace Locaty\Component\Logger;

use Locaty\Service;

abstract class Facade extends Service\Basic {

    /**
     * @param \Throwable $e
     */
    public function notifyException(\Throwable $e): void {
        $this->logException($e);
        // @todo: get abstract engine and send notification
    }

    /**
     * @param \Throwable $e
     */
    public function logException(\Throwable $e): void {
        $this->_writeText('exception', $e->getMessage());
    }

    /**
     * @param string $name
     * @param string $format
     * @param mixed $_
     */
    public function log(string $name, string $format, $_ = null): void {
        $message = sprintf($format, array_slice(func_get_args(), 2));
        $prefix = '[' . date('Y-m-d H:i:s') . ']';
        $this->_writeText($name, "{$prefix} {$message}\n");
    }

    /**
     * @param string $name
     * @param string $text
     */
    protected function _writeText(string $name, string $text): void {
        $filename = $this->_getLogDir() . '/' . $name . '.log';
        file_put_contents($filename, $text, FILE_APPEND);
    }

    /**
     * @return string
     */
    abstract protected function _getLogDir(): string;
}
