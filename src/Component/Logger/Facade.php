<?php

namespace Locaty\Component\Logger;

use Locaty\Service;

abstract class Facade extends Service\Basic {

    /**
     * @var NotificationEngine\Basic
     */
    private $_notificationEngine;

    protected function _init(): void {
        $this->_notificationEngine = $this->_getNotificationEngine();
    }

    /**
     * @param \Throwable $exception
     */
    public function notifyException(\Throwable $exception): void {
        $this->logException($exception);
        if ($this->_notificationEngine !== null) {
            $this->_notificationEngine->notifyException($exception);
        }
    }

    /**
     * @param string $message
     * @param array $data
     */
    public function notifyMessage(string $message, array $data = []): void {
        if ($this->_notificationEngine !== null) {
            $this->_notificationEngine->notifyMessage($message, $data);
        }
    }

    /**
     * @param string $name
     * @param string $format
     * @param mixed $args
     * @param mixed $_
     */
    public function log(string $name, string $format, $args = null, $_ = null): void {
        $message = sprintf($format, array_slice(func_get_args(), 2));
        $prefix = '[' . date('Y-m-d H:i:s') . ']';
        $this->_writeText($name, "{$prefix} {$message}\n");
    }

    /**
     * @param \Throwable $exception
     */
    public function logException(\Throwable $exception): void {
        $this->_writeText('exception', $exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
    }

    /**
     * @param string $name
     * @param string $text
     */
    protected function _writeText(string $name, string $text): void {
        $filename = $this->_getLogDir() . '/' . $name . '.log';
        file_put_contents($filename, $text . PHP_EOL, FILE_APPEND);
    }

    /**
     * @return NotificationEngine\Basic|null
     */
    abstract protected function _getNotificationEngine(): ?NotificationEngine\Basic;

    /**
     * @return string
     */
    abstract protected function _getLogDir(): string;
}
